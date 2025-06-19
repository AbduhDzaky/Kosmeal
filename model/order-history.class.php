<?php

class Order
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }
    public function getOrdersByUserId($userId)
    {
        $query = "SELECT o.*, m.name AS menu_name, m.image_url 
                  FROM orders o
                  JOIN menus m ON o.menu_id = m.id
                  WHERE o.user_id = :userId
                  ORDER BY o.created_at DESC";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getOrderDetail($orderId)
    {
        $query = "SELECT o.*, m.name AS menu_name, m.description, m.image_url, m.price 
                  FROM orders o
                  JOIN menus m ON o.menu_id = m.id
                  WHERE o.id = :orderId";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':orderId', $orderId);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
