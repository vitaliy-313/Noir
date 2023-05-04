<?php

namespace App\models;

use App\base\Connection;

class Volume
{
    public static function all()
    {
        $query = Connection::make()->query("SELECT *
        FROM volumes
        ");
        return $query->fetchAll();
    }
    public static function unitsAll()
    {
        $query = Connection::make()->query("SELECT * FROM units
        ");
        return $query->fetchAll();
    }
    private static function getParams($array, $value)
    {
        return implode(",", array_fill(0, count($array), $value));
    }
    public static function addValue($product_id, $value_mass)
    {
        $count = count($value_mass['volume_id']);

        $queryText = ("INSERT INTO volume_in_products(product_id, volume_id, price, unit_id) VALUES");
        $params = self::getParams($value_mass['volume_id'], '(?, ?, ?, ?)');

        $queryText .= $params;
        
        $values = [];
        for($i = 0; $i< $count; $i++){
            $values[] = $product_id;
            $values[] = $value_mass['volume_id'][$i];
            $values[] = $value_mass['price'][$i];
            $values[] = $value_mass['unit'];
        }
        
        $query = Connection::make()->prepare($queryText);
        $query->execute($values);
    }
}
