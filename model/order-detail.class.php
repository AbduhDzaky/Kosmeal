<?php

class Order
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }
    public function getOrderById($orderId)
    {
        $query = "SELECT o.*, m.name AS menu_name, m.image_url, m.price 
                  FROM orders o
                  JOIN menus m ON o.menu_id = m.id
                  WHERE o.id = :orderId";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':orderId', $orderId, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function addReview($orderId, $userId, $rating, $comment)
    {
        $query = "INSERT INTO reviews (order_id, user_id, rating, comment, created_at)
                  VALUES (:orderId, :userId, :rating, :comment, NOW())";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':orderId', $orderId);
        $stmt->bindParam(':userId', $userId);
        $stmt->bindParam(':rating', $rating);
        $stmt->bindParam(':comment', $comment);
        return $stmt->execute();
    }
}