<?php

namespace App\models;

use App\base\Connection;

class Syrup
{
    public static function all()
    {
        $query = Connection::make()->query("SELECT * FROM syrups");
        return $query->fetchAll();
    }
}