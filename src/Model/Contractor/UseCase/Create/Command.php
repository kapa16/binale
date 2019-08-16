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
    public $nameOne;

    /**
     * @Assert\Length(
     *     min="2",
     *     max="60"
     * )
     */
    public $nameTwo;

    /**
     * @Assert\Length(
     *     max="10"
     * )
     */
    public $number;

    /**
     * @Assert\Length(
    *     max="10"
     * )
     * @Assert\Positive()
     */
    public $creditorNumber;

    /**
     * @Assert\Length(
     *     min="2",
     *     max="60"
     * )
     */
    public $creditorName;
}