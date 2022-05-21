<?php

namespace App\Helpers;

class EmailHelper
{
    public static function sendBulkEmail($title, $body, $targets)
    {
        $email = \Config\Services::email();
        $email->setTo($targets);
        $email->setSubject($title);
        $email->setMessage($body);
        $email->send();
    }
}
