<?php

namespace App\models;

use App\base\Connection;

class Client
{

    //в этом классесодержатся все методы необходимые для работы с пользователем в нашей базе
    public static function all()
    {
        $query = Connection::make()->query("SELECT client.name as name, client.surname as surname, client.phone as phone, roles.name as role FROM client INNER JOIN client.role_id=roles.id ");
        return $query->fetchAll();
    }

    //вывод
    public static function store($data)
    {
        $query = Connection::make()->prepare("INSERT INTO client( name, surname, phone, password, role_id) values(:name, :surname, :phone, :password, :role_id)");
        return $query->execute([
            "name" => $data['name'],
            "surname" => $data['surname'],
            "phone" => $data['phone'],
            "role_id" => 3,
            'password' => password_hash($data['password'], PASSWORD_DEFAULT)
        ]);
    }
    //delet
    public static function destroy($id)
    {
        $query = Connection::make()->prepare("DELETE FROM client WHERE id = :id");
        return $query->execute([
            "id" => $id
        ]);
    }

    public static function getClient($phone, $password)
    {
        $query = Connection::make()->prepare("SELECT client.*, roles.name as role 
        FROM client
        INNER JOIN roles ON client.role_id = roles.id
        WHERE client.phone=:phone");
        $query->execute([
            ":phone"=> $phone
        ]);
        $client = $query->fetch();
        if (password_verify($password, $client->password)){
            return $client;
        }
        return null;
    }
    public static function find($id){
        $query = Connection::make()->prepare("SELECT client.* FROM client WHERE client.id = :id");
        $query->execute([
            ":id" =>$id
        ]);
        return $query->fetch();
    }
}
