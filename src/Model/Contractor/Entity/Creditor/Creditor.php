<?php

declare(strict_types=1);

namespace App\Model\Contractor\Entity\Creditor;

use App\Model\Contractor\Entity\Contractor\Contractor;
use App\Model\Contractor\Entity\Contractor\Id;
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

    /**
     * Creditor constructor.
     * @param $id
     * @param string $name
     * @param string|null $number
     */
    public function __construct(Id $id, string $name, ?string $number)
    {
        $this->id = $id;
        $this->name = $name;
        $this->number = $number;
    }


    public function getContractors()
    {
        return $this->contractors->toArray();
    }

    public function __toString()
    {
        return $this->name;
    }


}