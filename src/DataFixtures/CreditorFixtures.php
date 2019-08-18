<?php
declare(strict_types=1);

namespace App\DataFixtures;

use App\Model\Contractor\Entity\Contractor\Id;
use App\Model\Contractor\Entity\Creditor\Creditor;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class CreditorFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {
        // create 20 products! Bam!
        for ($i = 0; $i < 20; $i++) {
            $creditor = new Creditor(
                Id::next(),
                'Test' . $i,
                'some' . $i
            );
            $manager->persist($creditor);
        }

        $manager->flush();
    }
}