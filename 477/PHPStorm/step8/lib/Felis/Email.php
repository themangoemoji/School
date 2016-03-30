<?php
/**
 * Created by PhpStorm.
 * User: mhw
 * Date: 3/29/16
 * Time: 2:16 PM
 */

namespace Felis;


class Email {
    public function mail($to, $subject, $message, $headers) {
        mail($to, $subject, $message, $headers);
    }
}