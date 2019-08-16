<?php

declare(strict_types=1);

namespace App\Model\Contractor\Entity\Creditor;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;

class CreditorType extends StringType
{
    public const NAME = 'contractor_creditor';

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return $value instanceof Creditor ? $value->getName() : $value;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return !empty($value) ? new Creditor($value) : null;
    }

    public function getName(): string
    {
        return self::NAME;
    }

    public function requiresSQLCommentHint(AbstractPlatform $platform) : bool
    {
        return true;
    }
}
