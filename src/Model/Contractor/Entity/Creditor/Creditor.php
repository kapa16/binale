<?php

declare(strict_types=1);

namespace App\Model\Contractor\Entity\Creditor;

use App\Model\Contractor\Entity\Contractor\Contractor;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="contractor_creditors", uniqueConstraints={
 *     @ORM\UniqueConstraint(columns={"name"})
 * })
 */
class Creditor
{
    /**
     * @ORM\Column(type="contractor_creditor_id")
     * @ORM\Id
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string", name="name", length=60, nullable=false)
     */
    private $name;

    /**
     * @var string|null
     * @ORM\Column(type="string", name="number", nullable=true)
     */
    private $number;

    /**
     * @var ArrayCollection|Contractor[]
     * @ORM\OneToMany(
     *     targetEntity="App\Model\Contractor\Entity\Contractor\Contractor",
     *     mappedBy="creditor")
     */
    private $contractors;

    public function getContractors()
    {
        return $this->contractors->toArray();
    }

}