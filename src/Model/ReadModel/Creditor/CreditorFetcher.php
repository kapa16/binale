<?php

declare(strict_types=1);

namespace App\Model\ReadModel\Creditor;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\FetchMode;

class CreditorFetcher
{
    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function List(): array
    {
        $stmt = $this->connection->createQueryBuilder()
            ->select(
                'id',
                'name'
            )
            ->from('contractor_creditors')
            ->orderBy('name')
            ->execute();

        return $stmt->fetchAll( \Doctrine\DBAL\FetchMode::ASSOCIATIVE);

    }
}