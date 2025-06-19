<?php

class PaymentModel {
    public function save($orderNumber,  $uploadPath , $batasWaktu, $createdAt) {
        $db = new Database();
        $conn = $db->getConnection();

        $stmt = $conn->prepare("INSERT INTO payment (order_id, bukti, batas_waktu, created_at) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $orderNumber,  $uploadPath , $batasWaktu, $createdAt);
        $stmt->execute();
        $stmt->close();
    }

    public function getByOrderNumber($orderNumber) {
        $db = new Database();
        $conn = $db->getConnection();

        $stmt = $conn->prepare("SELECT * FROM payment WHERE order_id = ?");
        if (!$stmt) {
            die("Prepare failed: " . $conn->error);
        }

        $stmt->bind_param("s", $orderNumber);
        $stmt->execute();
        $result = $stmt->get_result();

        if (!$result) {
            die("Execute failed: " . $stmt->error);
        }

        return $result->fetch_assoc();
    }
}