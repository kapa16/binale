<?php

declare(strict_types=1);

namespace App\Model\Contractor\Entity\Contractor;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="contractor_contractors")
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
    private $name1;

    /**
     * @var string|null
     * @ORM\Column(type="string", name="name_two", length=60, nullable=true)
     */
    private $name2;

    /**
     * Contractor constructor.
     * @param $id
     * @param string $name1
     * @param string|null $name2
     */
    public function __construct(Id $id, string $name1, ?string $name2)
    {
        $this->id = $id;
        $this->name1 = $name1;
        $this->name2 = $name2;
    }


}