<?php

declare(strict_types=1);

namespace App\Model\Contractor\UseCase\Create;

use App\Model\Contractor\Entity\Contractor\ContractorRepository;
use App\Model\Flusher;

class Handler
{
    private $contractor;
    private $flusher;

    /**
     * Handler constructor.
     * @param $contractor
     * @param $flusher
     */
    public function __construct(ContractorRepository $contractor, Flusher $flusher)
    {
        $this->contractor = $contractor;
        $this->flusher = $flusher;
    }

    public function handle(Command $command)
    {
        if ()
    }
}