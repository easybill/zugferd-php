<?php

namespace Easybill\ZUGFeRD\Model;

class UnitCode
{
    // area units
    public const HECTARE = 'HAR';
    public const METER = 'MTR';
    public const MILLIMETER = 'MMT';
    public const SQUARE_MILLIMETER = 'MMK';

    public const SQUARE_METER = 'MTK';
    public const CUBIC_METER = 'MTQ';

    // weight units
    public const KILOGRAM = 'KGM';
    public const KILOMETER = 'KTM';
    public const TONNE = 'TNE';

    // time units
    public const WEEK = 'WEE';
    public const DAY = 'DAY';
    public const HOUR = 'HUR';
    public const MINUTE = 'MIN';

    // Misc.
    public const PIECE = 'C62';
    public const BOX = 'CT';
    public const NUMBER_OF_ITEM = 'NAR';
    public const NUMBER_OF_PAIRS = 'NPR';
    public const SET = 'SET';
    public const KWH = 'KWH';
    public const FLAT_RATE = 'LS';
    public const LITER = 'LTR';
    public const PERCENT = 'P1';
}
