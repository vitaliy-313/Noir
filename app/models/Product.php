<?php

namespace App\models;

use App\base\Connection;
use PDO;

class Product
{
    //получаем товары отсортирование по новизне
    //в этом классесодержатся все методы необходимые для работы с пользователем в нашей базе
    public static function all()
    {
        $query = Connection::make()->query("SELECT DISTINCT products.*,
        categories.name as category
        FROM products 
        INNER JOIN categories ON categories.id = products.category_id AND count > 0
        ORDER BY created_at DESC");
        return $query->fetchAll();
    }
    //Минисальная цена для меню
    public static function minPriceProduct($id)
    {
        $query = Connection::make()->prepare("SELECT MIN(price) as minPrice
        FROM volume_in_products 
        WHERE product_id = :product_id");
        $query->execute(['product_id' => $id]);
        return $query->fetch();
    }
    //минимальная объем
    public static function minPriceVolumeProduct($id)
    {
        $query = Connection::make()->prepare("SELECT price, volumes.name as volume
        FROM volume_in_products 
        INNER JOIN volumes ON volume_in_products.volume_id = volumes.id   
        WHERE product_id = :product_id
        ORDER BY price LIMIT 1 ");
        $query->execute(['product_id' => $id]);
        return $query->fetch();
    }
    //цена
    public static function volumes($id)
    {
        $query = Connection::make()->prepare("SELECT volumes.id, volumes.name, units.name as units 
        FROM volume_in_products 
        INNER JOIN volumes ON volume_in_products.volume_id = volumes.id  
        INNER JOIN units ON volume_in_products.unit_id = units.id
        WHERE product_id = :product_id");
        $query->execute(['product_id' => $id]);
        return $query->fetchAll();
    }
    public static function volume_by_product($id){
        $query = Connection::make()->prepare("SELECT volumes.id FROM `baskets` INNER JOIN volumes ON baskets.volume_id=volumes.id WHERE product_id=:product_id AND baskets.volume_id=volumes.id");
        $query->execute(['product_id' => $id]);
        return $query->fetch();
    }
    
    public static function priceProductByVolume($product_id, $volume_id)
    {
        $query = Connection::make()->prepare("SELECT price
        FROM volume_in_products   
        WHERE product_id = :product_id and volume_id = :volume_id");
        $query->execute([
            'product_id' => $product_id,
            'volume_id' => $volume_id
        ]);
        return $query->fetch(PDO::FETCH_COLUMN);
    }
    //ищем товар на складе по его id
    public static function find($id)
    {
        $query = Connection::make()->prepare("SELECT products.*, categories.name as category FROM products INNER JOIN categories ON products.category_id = categories.id WHERE products.id = :id");
        $query->execute(['id' => $id]);
        return $query->fetch();
    }

    //получаем 5 последних товаров
    public static function five()
    {
        $query = Connection::make()->query("SELECT * FROM products LIMIT 3");
        return $query->fetchAll();
    }

    //в этом классесодержатся все методы необходимые для работы с пользователем в нашей базе

    //формируем строку с позиционным параметром
    private static function getParams($array)
    {
        return implode(",", array_fill(0, count($array), "?"));
    }

    //получаем товары по указаным категориям
    public static function productsByManyCategory($categories)
    {
        //формируем параметры для запроса
        $params = self::getParams($categories);
        $query = Connection::make()->prepare("SELECT DISTINCT products.*, categories.name as category FROM products
        INNER JOIN categories ON products.category_id = categories.id
        WHERE category_id IN($params) AND count > 0");
        $query->execute($categories);
        return $query->fetchAll();
    }
    //обновляем колличество товара на складе

    public static function addProduct($data)
    {
        $conn = Connection::make();
        $query = $conn->prepare("INSERT INTO products(name, count, description, description_mini, photo, created_at, updated_at, category_id) VALUES (:name, :count, :description, :description_mini, :photo, :created_at, :updated_at, :category_id)");
        $query->execute([
            ":name"=>$data["name"],
            ":count"=>$data["count"],
            ":description"=>$data["description"],
            ":description_mini"=>$data["description_mini"],
            ":photo"=>$data["photo"],
            ":created_at"=>date('Y-m-d H:i:s'),
            ":updated_at"=>date('Y-m-d H:i:s'),
            ":category_id"=>$data["category"],
        ]);
        return $conn->lastInsertId();
        
    }
    public static function deleteProduct($product_id)
    {
        $query = Connection::make()->prepare("DELETE FROM products WHERE id = :id");
        $query->execute([
            ":id"=> $product_id
        ]);   
    }
    public static function updateProduct($data)
    {
        $query = Connection::make()->prepare("UPDATE products SET name=:name, count=:count,description = :description, description_mini = :description_mini, photo=:photo, updated_at =:updated_at, category_id=:category WHERE id = :id");
        $query->execute([
            ":name"=>$data["name"],
            ":count"=>$data["count"],
            ":description"=>$data["description"],
            ":description_mini"=>$data["description_mini"],
            ":photo"=>$data["photo"],
            ":updated_at"=>date('Y-m-d H:i:s'),
            ":category"=>$data["category"],
            ":id"=>$data["id"],
        ]);
        
    }
    public static function updateCount($basket, $conn)
    {
        $conn = $conn ?? Connection::make();
        $query = $conn->prepare("UPDATE products SET count = count-:count WHERE id = :product_id");
        foreach ($basket as $item) {
            $query->bindValue("count", $item->count, \PDO::PARAM_INT);
            $query->bindValue("product_id", $item->product_id, \PDO::PARAM_INT);
            $query->execute();
        }
    }
    public static function viewByCategory($id)
    {
        $query = Connection::make()->prepare("SELECT products.*, categories.name as category
        FROM products
        INNER JOIN categories ON products.category_id = categories.id
        WHERE products.category_id = :id");

        $query->execute([
            'id' => $id
        ]);

        return $query->fetchAll();
    }
}
