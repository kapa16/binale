up: docker-up
down: docker-down
restart: docker-down docker-up
init: docker-down-clear binale-clear docker-pull docker-build docker-up binale-init
test: binale-test
test-unit: binale-test-unit

docker-up:
	docker-compose up -d

docker-down:
	docker-compose down --remove-orphans

docker-down-clear:
	docker-compose down -v --remove-orphans

docker-pull:
	docker-compose pull

docker-build:
	docker-compose build

binale-init: binale-composer-install binale-assets-install binale-oauth-keys binale-wait-db binale-migrations binale-fixtures binale-ready

binale-clear:
	docker run --rm -v ${PWD}:/app --workdir=/app alpine rm -f .ready

binale-composer-install:
	docker-compose run --rm binale-php-cli composer install

binale-assets-install:
	docker-compose run --rm binale-node yarn install
	docker-compose run --rm binale-node npm rebuild node-sass

binale-oauth-keys:
	docker-compose run --rm binale-php-cli mkdir -p var/oauth
	docker-compose run --rm binale-php-cli openssl genrsa -out var/oauth/private.key 2048
	docker-compose run --rm binale-php-cli openssl rsa -in var/oauth/private.key -pubout -out var/oauth/public.key
	docker-compose run --rm binale-php-cli chmod 644 var/oauth/private.key var/oauth/public.key

binale-wait-db:
	until docker-compose exec -T binale-postgres pg_isready --timeout=0 --dbname=app ; do sleep 1 ; done

binale-migrations:
	docker-compose run --rm binale-php-cli php bin/console doctrine:migrations:migrate --no-interaction

binale-fixtures:
	docker-compose run --rm binale-php-cli php bin/console doctrine:fixtures:load --no-interaction

binale-ready:
	docker run --rm -v ${PWD}:/app --workdir=/app alpine touch .ready

binale-assets-dev:
	docker-compose run --rm binale-node npm run dev

binale-test:
	docker-compose run --rm binale-php-cli php bin/phpunit

binale-test-unit:
	docker-compose run --rm binale-php-cli php bin/phpunit --testsuite=unit

build-production:
	docker build --pull --file=docker/production/nginx.docker --tag ${REGISTRY_ADDRESS}/binale-nginx:${IMAGE_TAG} manager
	docker build --pull --file=docker/production/php-fpm.docker --tag ${REGISTRY_ADDRESS}/binale-php-fpm:${IMAGE_TAG} manager
	docker build --pull --file=docker/production/php-cli.docker --tag ${REGISTRY_ADDRESS}/binale-php-cli:${IMAGE_TAG} manager
	docker build --pull --file=docker/production/postgres.docker --tag ${REGISTRY_ADDRESS}/binale-postgres:${IMAGE_TAG} manager
	docker build --pull --file=docker/production/redis.docker --tag ${REGISTRY_ADDRESS}/binale-redis:${IMAGE_TAG} manager

push-production:
	docker push ${REGISTRY_ADDRESS}/binale-nginx:${IMAGE_TAG}
	docker push ${REGISTRY_ADDRESS}/binale-php-fpm:${IMAGE_TAG}
	docker push ${REGISTRY_ADDRESS}/binale-php-cli:${IMAGE_TAG}
	docker push ${REGISTRY_ADDRESS}/binale-postgres:${IMAGE_TAG}
	docker push ${REGISTRY_ADDRESS}/binale-redis:${IMAGE_TAG}

deploy-production:
	ssh -o StrictHostKeyChecking=no ${PRODUCTION_HOST} -p ${PRODUCTION_PORT} 'rm -rf docker-compose.yml .env'
	scp -o StrictHostKeyChecking=no -P ${PRODUCTION_PORT} docker-compose-production.yml ${PRODUCTION_HOST}:docker-compose.yml
	ssh -o StrictHostKeyChecking=no ${PRODUCTION_HOST} -p ${PRODUCTION_PORT} 'echo "REGISTRY_ADDRESS=${REGISTRY_ADDRESS}" >> .env'
	ssh -o StrictHostKeyChecking=no ${PRODUCTION_HOST} -p ${PRODUCTION_PORT} 'echo "IMAGE_TAG=${IMAGE_TAG}" >> .env'
	ssh -o StrictHostKeyChecking=no ${PRODUCTION_HOST} -p ${PRODUCTION_PORT} 'echo "BINALE_APP_SECRET=${BINALE_APP_SECRET}" >> .env'
	ssh -o StrictHostKeyChecking=no ${PRODUCTION_HOST} -p ${PRODUCTION_PORT} 'echo "BINALE_DB_PASSWORD=${BINALE_DB_PASSWORD}" >> .env'
	ssh -o StrictHostKeyChecking=no ${PRODUCTION_HOST} -p ${PRODUCTION_PORT} 'echo "BINALE_REDIS_PASSWORD=${BINALE_REDIS_PASSWORD}" >> .env'
	ssh -o StrictHostKeyChecking=no ${PRODUCTION_HOST} -p ${PRODUCTION_PORT} 'echo "BINALE_MAILER_URL=${BINALE_MAILER_URL}" >> .env'
	ssh -o StrictHostKeyChecking=no ${PRODUCTION_HOST} -p ${PRODUCTION_PORT} 'echo "BINALE_OAUTH_FACEBOOK_SECRET=${BINALE_OAUTH_FACEBOOK_SECRET}" >> .env'
	ssh -o StrictHostKeyChecking=no ${PRODUCTION_HOST} -p ${PRODUCTION_PORT} 'docker-compose pull'
	ssh -o StrictHostKeyChecking=no ${PRODUCTION_HOST} -p ${PRODUCTION_PORT} 'docker-compose up --build -d'
	ssh -o StrictHostKeyChecking=no ${PRODUCTION_HOST} -p ${PRODUCTION_PORT} 'until docker-compose exec -T binale-postgres pg_isready --timeout=0 --dbname=app ; do sleep 1 ; done'
	ssh -o StrictHostKeyChecking=no ${PRODUCTION_HOST} -p ${PRODUCTION_PORT} 'docker-compose run --rm binale-php-cli php bin/console doctrine:migrations:migrate --no-interaction'