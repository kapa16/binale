<?php

declare(strict_types=1);

namespace App\Model\Contractor\Entity\Creditor;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="contractor_creditors", uniqueConstraints={
 *     @ORM\UniqueConstraint(columns={"$name"})
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
     * @ORM\Column(type="string", name="name_one", length=60, nullable=false)
     */
    private $name;

    /**
     * @var string|null
     * @ORM\Column(type="string", name="number", nullable=true)
     */
    private $number;

}