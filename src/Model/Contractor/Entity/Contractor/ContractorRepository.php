<?php

declare(strict_types=1);

namespace App\Model\Contractor\Entity\Contractor;

use Doctrine\ORM\EntityManagerInterface;

class ContractorRepository
{
    private $em;
    /**
     * @var \Doctrine\ORM\EntityRepository
     */
    private $repo;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
        $this->repo = $em->getRepository(Contractor::class);
    }

    public function findByFullName(string $name1, string $name2)
    {
        return $this->repo->findOneBy([
            'name1' => $name1,
            'name2' => $name2,
        ]);
    }

    public function add(Contractor $contractor)
    {
        $this->em->persist($contractor);
    }

}