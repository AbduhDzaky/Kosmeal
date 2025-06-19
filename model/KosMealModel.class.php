<?php

require_once __DIR__ . '/Database.php';
class KosMealModel {
    public $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }
    
    function getAllPackages() {
        $result = $this->db->query("SELECT no, name, description, price FROM packages");
        $packages = [];
        if ($result && $result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $packages[] = $row;
            }
        }
        return $packages;
    }

    function getPackageDetails($packageName) {
        $stmt = $this->db->prepare("SELECT no, name, description, price FROM packages WHERE name = ?");
        if ($stmt === false) {
            error_log("Prepare failed: " . $this->db->error);
            return null;
        }
        $stmt->bind_param("s", $packageName);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result && $result->num_rows > 0) {
            return $result->fetch_assoc();
        }
        return null;
    }

    function saveOrder($orderId, $packageName, $price, $tax, $total, $orderDate) {
        $stmt = $this->db->prepare("INSERT INTO orders (order_id, package, price, tax, total, order_date) VALUES (?, ?, ?, ?, ?, ?)");
        if ($stmt === false) {
            error_log("Prepare failed: " . $this->db->error);
            return false;
        }
        
        $stmt->bind_param("ssddds", $orderId, $packageName, $price, $tax, $total, $orderDate);

        if ($stmt->execute()) {
            return true;
        } else {
            error_log("Error saving order: " . $stmt->error);
            return false;
        }
        $stmt->close();
    }

    function getOrderById($orderId) {
        $stmt = $this->db->prepare("SELECT * FROM orders WHERE order_id = ?");
        $stmt->bind_param("s", $orderId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            return $result->fetch_assoc();
        }
        return null;
    }
    public function getAllOrders() {
        $result = $this->db->query('SELECT * FROM orders ORDER BY order_date DESC, no DESC');
        $orders = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $orders[] = $row;
            }
        }
        return $orders;
    }

public function getOrderHistory() {
    $sql = "SELECT * FROM orders ORDER BY order_date DESC, no DESC";
    $result = $this->db->query($sql);

    $history = [];
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $history[] = $row;
        }
    }

    return $history;
}

public function getOrderDetail($orderId) {
    $stmt = $this->db->prepare("SELECT * FROM orders WHERE order_id = ?");
    if ($stmt === false) {
        error_log("Prepare failed: " . $this->db->error);
        return null;
    }

    $stmt->bind_param("s", $orderId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        return $result->fetch_assoc();
    }

    return null;
}
}