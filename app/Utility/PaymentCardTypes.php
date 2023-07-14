<?php


namespace App\Utility;


class PaymentCardTypes
{
    const VISA = 'Visa';
    const MASTERCARD = 'MasterCard';

    public static function getPaymentCardTypes()
    {
        return [
            self::VISA,
            self::MASTERCARD
        ];
    }
}
