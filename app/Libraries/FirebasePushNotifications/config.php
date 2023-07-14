<?php
/**
 * Created by PhpStorm.
 * User: Hassan Saeed
 * Date: 2/22/2018
 * Time: 4:14 PM
 */

namespace App\Libraries\FirebasePushNotifications;


class config
{
    public function __construct()
    {
        $this->key = "AAAAZOVQTms:APA91bFUP3xVPlWZkGS7V3MCy8ujVKBaOZ-P0bG8LbDxob0XZ9hwNJXBygFVMMZbtSVcEgGA3juCGJ0E1KpjudKvNeFJxE8BqGpvrT38v_deKy6Devv6qdIbles5FVuwQKtULFPAv7GM";
        $this->senderID = "433343975019";
    }

    public function getKey()
    {
        return $this->key;
    }

    public $key,$senderID;
    public function getSenderID()
    {
        return $this->key;
    }

}
