<?php

namespace Easybill\ZUGFeRD\Helper;

use Easybill\ZUGFeRD\Model\UnitCode;

class UnitCodeHelper
{
    public static function getUnitCode(string $rawString = ''): string
    {
        switch (strtolower($rawString)) {
            case 'box':
            case 'kiste':
                $unit = UnitCode::BOX;
                break;
            case 'metre':
            case 'meter':
            case 'm':
                $unit = UnitCode::METER;
                break;
            case 'kg':
                $unit = UnitCode::KILOGRAM;
                break;
            case 'km':
                $unit = UnitCode::KILOMETER;
                break;
            case 'liter':
                $unit = UnitCode::LITER;
                break;
            case 'm²':
            case 'm2':
                $unit = UnitCode::SQUARE_METER;
                break;
            case 'm³':
            case 'm3':
                $unit = UnitCode::CUBIC_METER;
                break;
            case 'stück':
            case 'piece':
            default:
                $unit = UnitCode::PIECE;
        }

        return $unit;
    }
}
