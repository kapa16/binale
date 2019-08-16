<?php

declare(strict_types=1);

namespace App\Model\Contractor\Entity\Contractor;

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
     * @ORM\Column(type="contractor_creditor")
     */
    private $creditor;

    /**
     * Contractor constructor.
     * @param $id
     * @param string $nameOne
     * @param string|null $nameTwo
     */
    public function __construct(Id $id, string $nameOne, ?string $nameTwo)
    {
        $this->id = $id;
        $this->nameOne = $nameOne;
        $this->nameTwo = $nameTwo;
    }


}