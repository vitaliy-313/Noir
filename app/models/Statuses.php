<?php

namespace App\models;

use App\base\Connection;

class Statuses
{
    public static function all()
    {
        $query = Connection::make()->query("SELECT name, id FROM statuses");
        return $query->fetchAll();
    }

    public static function find($id)
    {
        $query = Connection::make()->prepare("SELECT * FROM orders WHERE id = :id");
        $query->execute(["id" => $id]);
        return $query->fetch();
    }
}
