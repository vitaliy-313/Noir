<?php

namespace app\models;

use app\base\Connection;

class Basket
{
    //получаем корзинку пользователя

    public static  function get_basket($client_id)
    {
        $query = Connection::make()->prepare("SELECT baskets.id as basket_id,
		baskets.product_id as product_id,
        baskets.volume_id as volume_id,
        baskets.syrup_id as syrup_id,
        client.name as client_name, 
        products.name as product_name,  
        products.photo as photo,  
        baskets.count as count,
        volumes.name as volume,

        syrups.price as syrup_price,
        volume_in_products.price as product_price,
        (volume_in_products.price*baskets.count )as price
        FROM baskets 
        INNER JOIN client ON client_id = client.id 
        INNER JOIN products ON product_id = products.id
        INNER JOIN volumes ON volume_id = volumes.id 
        INNER JOIN syrups ON syrup_id = syrups.id 
        INNER JOIN volume_in_products ON volume_in_products.product_id = baskets.product_id AND volume_in_products.volume_id = baskets.volume_id 
        WHERE client_id = :clientId ");
        $query->execute([
            "clientId" => $client_id
        ]);
        return $query->fetchAll();
    }

    public static function find($client_id, $product_id)
    {
        $query = Connection::make()->prepare('SELECT baskets.*,
        volume_in_products.price as price
        FROM baskets
        INNER JOIN volume_in_products ON volume_in_products.product_id = baskets.product_id AND volume_in_products.volume_id = baskets.volume_id 
        WHERE baskets.product_id = :product_id 
        AND baskets.client_id = :client_id');
        $query->execute(['product_id' => $product_id, 'client_id' => $client_id]);
        return $query->fetch();
    }

    public static function totalPrice($client_id)
    {
        $query = Connection::make()->prepare('SELECT
        SUM(volume_in_products.price * baskets.count + syrups.price) as sum
        FROM baskets
        INNER JOIN products ON baskets.product_id = products.id
        INNER JOIN syrups ON syrup_id = syrups.id 
        INNER JOIN volume_in_products ON volume_in_products.product_id = baskets.product_id AND volume_in_products.volume_id = baskets.volume_id

        WHERE baskets.client_id = :client_id');
        $query->execute(['client_id' => $client_id]);
        return $query->fetch(\PDO::FETCH_COLUMN);
    }

    //ищем итоговое кол во товаров
    public static function totalCount($client_id)
    {
        $query = Connection::make()->prepare('SELECT SUM(baskets.count) FROM baskets WHERE baskets.client_id = :client_id');
        $query->execute(['client_id' => $client_id]);
        return $query->fetch(\PDO::FETCH_COLUMN);
    }
    //метод на добавление позиции в корзину
    public static function add($product_id, $client_id, $volume_id = 1,$syrup_id=1)
    {
        //поищем товар в корзине пользователья
        $productInBaskets = self::find($client_id, $product_id);

        //ищем анологичный товар на складе
        $query = Connection::make()->prepare("SELECT * FROM products WHERE id = :productId");
        $query->execute([
            "productId" => $product_id,
        ]);
        $product = $query->fetch();

        if ($product->category_id == 2) {
            $volume_id = 4;
        }
        //если товара нет в корзине то мы его добавим его в корзину в кол-ве = 1
        if (!$productInBaskets) {

            $query = Connection::make()->prepare("INSERT INTO baskets (count, client_id, client_time_id, product_id, volume_id, syrup_id) VALUES (1, :clientId, :client_time_id, :productId, :volume_id, :syrup_id)");
            $query->execute([
                "clientId" => $client_id,
                "client_time_id" => date("Y-m-d H:i:s"),
                "productId" => $product_id,
                "volume_id" => $volume_id,
                "syrup_id"=>$syrup_id
                
            ]);
        }
        //иначе если кол не привысит больше того сколько есть на складе то увеличиваем на 1
        else {
            if ($productInBaskets->count < $product->count) {
                $query = Connection::make()->prepare("UPDATE baskets SET count=count+1 WHERE product_id =:productId AND client_id=:clientId");
                $query->execute([
                    "productId" => $product_id,
                    "clientId" => $client_id,
                ]);
            }
        }
        return self::find($client_id, $product_id);
    }
    public static function deс($product_id, $client_id)
    {
        $productInBaskets = self::find($client_id, $product_id);

        if ($productInBaskets->count > 1) {
            $query = Connection::make()->prepare("UPDATE baskets SET count=count-1 WHERE product_id =:productId AND client_id=:clientId");
            $query->execute([
                "productId" => $product_id,
                "clientId" => $client_id,
            ]);
        }
        return self::find($client_id, $product_id);
    }
    public static function deleteProduct($product_id, $client_id)
    {

        $query = Connection::make()->prepare("DELETE FROM baskets WHERE product_id =:productId AND client_id=:clientId");
        $query->execute([
            "productId" => $product_id,
            "clientId" => $client_id,
        ]);
        return "delete";
    }
    public static function addSyrup($product_id, $client_id, $syrup_id)
    {

        $query = Connection::make()->prepare("UPDATE baskets SET syrup_id=:syrup_id WHERE product_id =:productId AND client_id=:clientId");
        $query->execute([
            "productId" => $product_id,
            "clientId" => $client_id,
            "syrup_id" => $syrup_id
        ]);
        return self::find($client_id, $product_id);
    }
    public static function changeVolume($product_id, $client_id, $volume_id)
    {

        $query = Connection::make()->prepare("UPDATE baskets SET volume_id=:volume_id WHERE product_id =:productId AND client_id=:clientId");
        $query->execute([
            "productId" => $product_id,
            "clientId" => $client_id,
            "volume_id" => $volume_id
        ]);
        return self::find($client_id, $product_id);
    }
    public  static function clear($user_id)
    {
        $query = Connection::make()->prepare("DELETE FROM baskets WHERE client_id=:userId");
        $query->execute([
            "userId" => $user_id
        ]);
        return $query->fetchAll();
    }
}
