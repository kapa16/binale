<?php

declare(strict_types=1);

namespace App\Model\Contractor\Entity\Contractor;

use App\Model\Contractor\Entity\Creditor\Creditor;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="contractor_contractors", uniqueConstraints={
 *     @ORM\UniqueConstraint(columns={"name_one", "name_two"})
 * })
 */
class Contractor
{
    /**
     * @ORM\Column(type="contractor_contractor_id")
     * @ORM\Id
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string", name="name_one", length=60, nullable=false)
     */
    private $nameOne;

    /**
     * @var string|null
     * @ORM\Column(type="string", name="name_two", length=60, nullable=true)
     */
    private $nameTwo;

    /**
     * @var string|null
     * @ORM\Column(type="string", name="number", nullable=true)
     */
    private $number;

    /**
     * @ORM\ManyToOne(
     *     targetEntity="App\Model\Contractor\Entity\Creditor\Creditor",
     *     inversedBy="contractors")
     * @ORM\JoinColumn(name="creditor_id", referencedColumnName="id", nullable=true)
     */
    private $creditor;

    public function __construct(Id $id, string $nameOne, ?string $nameTwo, string $number, Creditor $creditor)
    {
        $this->id = $id;
        $this->nameOne = $nameOne;
        $this->nameTwo = $nameTwo;
        $this->number = $number;
        $this->creditor = $creditor;
    }


}