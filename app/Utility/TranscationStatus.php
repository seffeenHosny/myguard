<?php

namespace App\Utility;

class TranscationStatus
{
    const APPROVED = "approved";
    const FAIL = "failed";
    const PENDING = "pending";

    public static function getTypes()
    {
        return [
            self::APPROVED,
            self::FAIL,
            self::PENDING,
        ];
    }
}
