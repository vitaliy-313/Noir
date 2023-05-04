<?php

namespace App\models;

use App\base\Connection;

class Category
{

    //в этом классесодержатся все методы необходимые для работы с пользователем в нашей базе
    public static function all()
    {
        $query = Connection::make()->query("SELECT id, name, image FROM categories ");
        return $query->fetchAll();
    }
//товары по категориям
    public static function productsByCategory($category)
    {
        $query = Connection::make()->prepare("SELECT categories.name as category, products.*  
        FROM categories 
        INNER JOIN products ON categories.id = products.category_id 
        WHERE category_id = :category_id");
        
        $query->execute([
            ":category_id" => $category
        ]);
        return $query->fetchAll();
    }
    public static function find($category_name)
    {
        $query = Connection::make()->prepare("SELECT name FROM categories WHERE name = :name");
        $query->execute(["name" => $category_name]);
        return $query->fetch();
    }
    
    public static function add($name)
    {

        $category = self::find($name);
        if (!$category) {
            $query = Connection::make()->prepare("INSERT INTO categories (name) VALUES (:category_name)");
            $query->execute(["category_name" => $name]);
        }
    }

    public static function delete($data)
    {
        $query = Connection::make()->prepare("DELETE FROM `categories` WHERE id=:id");
        $query->execute(
            [
                ":id" => $data,
            ]
        );
    }
}