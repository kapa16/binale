<?php

declare(strict_types=1);

namespace App\Model\Contractor\UseCase\Create;

use App\Model\Contractor\Entity\Contractor\Contractor;
use App\Model\Contractor\Entity\Contractor\ContractorRepository;
use App\Model\Contractor\Entity\Contractor\Id;
use App\Model\Flusher;

class Handler
{
    private $contractors;
    private $flusher;

    /**
     * Handler constructor.
     * @param $contractors
     * @param $flusher
     */
    public function __construct(ContractorRepository $contractors, Flusher $flusher)
    {
        $this->contractors = $contractors;
        $this->flusher = $flusher;
    }

    public function handle(Command $command)
    {
        if ($this->contractors->findByFullName($command->name1, $command->name2)) {
            throw new \DomainException('Contractor already exist.');
        }

        $contractor = new Contractor(
            Id::next(),
            $command->name1,
            $command->name2
        );

        $this->contractors->add($contractor);

        $this->flusher->flush();
    }
}