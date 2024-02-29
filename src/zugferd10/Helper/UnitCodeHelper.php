<?php

declare(strict_types=1);

namespace Easybill\ZUGFeRD\Helper;

use Easybill\ZUGFeRD\Model\UnitCode;

class UnitCodeHelper
{
    public static function getUnitCode(string $rawString = ''): string
    {
        return match (strtolower($rawString)) {
            'box', 'kiste' => UnitCode::BOX,
            'metre', 'meter', 'm' => UnitCode::METER,
            'kg' => UnitCode::KILOGRAM,
            'km' => UnitCode::KILOMETER,
            'liter' => UnitCode::LITER,
            'm²', 'm2' => UnitCode::SQUARE_METER,
            'm³', 'm3' => UnitCode::CUBIC_METER,
            default => UnitCode::PIECE,
        };
    }
}
