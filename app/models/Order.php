<?php

namespace App\models;

use App\base\Connection;
use App\models\Basket;
use App\models\Product;
use PDOException;

class Order
{
    public static function all()
    {
        $query = Connection::make()->query("SELECT
        product_in_Orders.order_id AS orderId,
        orders.date_order AS dataOrder,
        statuses.name AS statusName,
        CLIENT.name AS clientName,
        CLIENT.phone AS phone,
        SUM(product_in_Orders.price) AS pricePosition,
        COUNT(product_in_Orders.count) AS COUNT
    FROM
        product_in_Orders
    INNER JOIN orders ON orders.id = order_id
    INNER JOIN CLIENT ON client.id = orders.client_id
    INNER JOIN statuses ON statuses.id = orders.status_id
    GROUP BY
        product_in_Orders.order_id,
        orders.date_order,
        statuses.name,
        CLIENT.name,
        CLIENT.phone
        
        ");
        return $query->fetchAll();
    }
    public static function find($order_id)
    {
        $query = Connection::make()->prepare("SELECT
        orders.id AS orderId,
        client.name AS clientName,
        product_in_Orders.product_id,
        products.name,
        products.id,
        (SELECT SUM(count) FROM product_in_Orders WHERE product_in_Orders.order_id = orders.id) as product_count, 
        product_in_Orders.price as product_price,
        categories.name AS category,
        product_in_Orders.count,
        product_in_Orders.syrup_price,
        products.photo,
        statuses.name AS statusName,
        orders.created_at AS created_at,
        orders.date_order AS dateOrder
    FROM
        product_in_Orders
        
    INNER JOIN products ON product_in_Orders.product_id = products.id
    INNER JOIN volume_in_products ON volume_in_products.product_id = product_in_Orders.product_id AND volume_in_products.volume_id = product_in_Orders.volume_id
    INNER JOIN orders ON product_in_Orders.order_id = orders.id
    INNER JOIN statuses ON orders.status_id = statuses.id
    INNER JOIN client ON orders.client_id = client.id
    INNER JOIN categories ON products.category_id = categories.id
    WHERE  order_id = :order_id");

        $query->execute(['order_id' => $order_id]);
        return $query->fetchAll();
    }

    public static function findInClient($id)
    {
        $query = Connection::make()->prepare("SELECT DISTINCT
        orders.id as id,
        client_id as client_id,
        reason_cancel,
        status_id,
        orders.created_at as created_order,
        orders.date_order,
        statuses.name as status,
        client.name as client,
        orders.price as AllPrice
        FROM orders
        INNER JOIN client ON orders.client_id = client.id
        INNER JOIN statuses ON orders.status_id = statuses.id
        INNER JOIN product_in_Orders ON product_in_Orders.order_id = orders.id
        WHERE orders.client_id = :client_id ORDER BY orders.created_at DESC ");
        $query->execute([':client_id' => $id]);
        return $query->fetchAll();
    }
    public static function findInClientProduct($order_id)
    {
        $query = Connection::make()->prepare("SELECT DISTINCT
        orders.id as id,
        products.name as product,
        (SELECT SUM(count) FROM product_in_Orders WHERE product_in_Orders.order_id = orders.id) as count, 
        (SELECT SUM(product_in_Orders.price + product_in_Orders.syrup_price) FROM product_in_Orders WHERE product_in_Orders.order_id = orders.id and product_in_Orders.product_id = products.id) as product_price
        
        FROM orders
        INNER JOIN product_in_Orders ON product_in_Orders.order_id = orders.id
        INNER JOIN products ON product_in_Orders.product_id = products.id
        WHERE product_in_Orders.order_id = :order_id LIMIT 3");
        $query->execute(['order_id' => $order_id]);
        return $query->fetchAll();
    }
    public static function totalPrice($order_id)
    {
        $query = Connection::make()->prepare('SELECT SUM(product_in_Orders.count * volume_in_products.price) as sum
        FROM product_in_Orders,products
        INNER JOIN volume_in_products ON volume_in_products.product_id = product_in_Orders.product_id AND volume_in_products.volume_id = product_in_Orders.volume_id
        WHERE product_in_Orders.order_id = :order_id');

        $query->execute(['order_id' => $order_id]);

        return $query->fetch(\PDO::FETCH_COLUMN);
    }
    public static function totalCount($order_id)
    {
        $query = Connection::make()->prepare('SELECT SUM(product_in_Orders.count) FROM product_in_Orders WHERE product_in_Orders.order_id = :order_id');
        $query->execute(['order_id' => $order_id]);
        return $query->fetch(\PDO::FETCH_COLUMN);
    }

    public static function addOrder($user_id, $totalPrice)
    {
        $conn = Connection::make();
        $query = $conn->prepare('INSERT INTO orders(created_at, date_order, status_id, client_id, price) VALUES (:created_at,:date_order,1, :client_id, :price)');
        $query->execute([
            'created_at' => date('Y-m-d'),
            'date_order' =>  date('Y-m-d'),
            'client_id' => $user_id,
            'price' => $totalPrice
        ]);
        return $conn->lastInsertId();
    }

    private static function getParams($array, $value)
    {
        return implode(",", array_fill(0, count($array), $value));
    }

    public static function addOrderProducts($basket, $order_id, $conn)
    {
        $queryText = 'INSERT INTO product_in_Orders (count, order_id, product_id, volume_id, price, syrup_price) VALUES ';
        $params = self::getParams($basket, '(?, ?, ?, ?, ?, ?)');
        $queryText .= $params;

        $values = [];
        foreach ($basket as $item) {
            $values[] = $item->count;
            $values[] = $order_id;
            $values[] = $item->product_id;
            $values[] = $item->volume_id;
            $values[] = $item->price;
            $values[] = $item->syrup_price;
        }
        $query = $conn->prepare($queryText);
        $query->execute($values);
    }

    public static function create($user_id)
    {
        //получаем корзину пользователя
        $basket = Basket::get_basket($user_id);

        //установим подключение для работы с транзакцией
        $conn = Connection::make();

        //транзакция
        try {
            //открываем транзакцию
            $conn->beginTransaction();

            $totalPrice = Basket::totalPrice($user_id);

            //1. создаём новый заказ
            $order_id = self::addOrder($user_id, $totalPrice, $conn);

            //2. добавляем продукты в заказ
            self::addOrderProducts($basket, $order_id, $conn);

            //3. корректируем кол-во товаров на складе
            Product::updateCount($basket, $conn);

            //4. очищаем корзину пользователя
            Basket::clear($user_id, $conn);

            //принимаем транзакцию
            $conn->commit();
        }
        //откатываем транзакцию в случае ошибки
        catch (PDOException $error) {
            $conn->rollBack();
            echo 'ошибка ' . $error->getMessage();
        }
    }
    public static function addStatuses($date)
    {
        $query = Connection::make()->prepare('UPDATE orders SET status_id= :status_id, reason_cancel = :reason_cancel WHERE id=:id');
        $query->execute([
            'status_id' => $date['status_id'],
            'id' => $date["id"],
            'reason_cancel' => $date["reason_cancel"],
        ]);
        return $query->fetch(\PDO::FETCH_COLUMN);
    }
    public static function ordersByStatuses($id)
    {
        $query = Connection::make()->prepare("SELECT
        product_in_Orders.order_id AS orderId,
        orders.date_order AS dataOrder,
        statuses.name AS statusName,
        CLIENT.name AS clientName,
        CLIENT.phone AS phone,
        SUM(product_in_Orders.price) AS pricePosition,
        COUNT(product_in_Orders.count) AS COUNT
    FROM
        product_in_Orders
    INNER JOIN orders ON orders.id = order_id
    INNER JOIN CLIENT ON client.id = orders.client_id
    INNER JOIN statuses ON statuses.id = orders.status_id
    WHERE orders.status_id = :id
    GROUP BY
        product_in_Orders.order_id,
        orders.date_order,
        statuses.name,
        CLIENT.name,
        CLIENT.phone");
        $query->execute(["id" => $id]);
        return $query->fetchAll();
    }
}
