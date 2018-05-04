<?php declare(strict_types = 1);
/**
 * This file is part of the Dogma library (https://github.com/paranoiq/dogma)
 *
 * Copyright (c) 2012 Vlasta Neubauer (@paranoiq)
 *
 * For the full copyright and license information read the file 'license.md', distributed with this source code
 */

namespace Dogma\Doctrine\Time;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\DateType as DoctrineDateType;
use Doctrine\DBAL\Types\Type;
use Dogma\Time\Date;

class DateType extends DoctrineDateType
{

    public const NAME = Type::DATE;

    public function getName(): string
    {
        return self::NAME;
    }

    /**
     * @param mixed $value
     * @param \Doctrine\DBAL\Platforms\AbstractPlatform $platform
     * @return \Dogma\Time\Date|null
     */
    public function convertToPHPValue($value, AbstractPlatform $platform): ?Date
    {
        if ($value === null || $value instanceof Date) {
            return $value;
        }

        return new Date($value);
    }

    public function requiresSQLCommentHint(AbstractPlatform $platform): bool
    {
        return true;
    }

}