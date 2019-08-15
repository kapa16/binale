<?php

declare(strict_types=1);

namespace App\Model\Contractor\UseCase\Create;

use Symfony\Component\Validator\Constraints as Assert;

class Command
{
    /**
     * @Assert\NotBlank()
     * @Assert\Length(
     *     min="2",
     *     max="60"
     * )
     */
    public $name1;

    /**
     * @Assert\Length(60)
     *     min="2",
     *     max="60"
     */
    public $name2;
}