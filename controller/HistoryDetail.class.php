<?php
class HistoryDetail extends Controller {
    public function index() {
        session_start();
        $orderId = $_SESSION['order_id'] ?? null;

        if (!$orderId) {
            header('Location: index.php?c=Order&m=history');
            exit;
        }

        $orderModel = $this->model('KosMealModel');
        $orderData = $orderModel->getOrderById($orderId);

        if (!$orderData) {
            echo "Error: Pesanan tidak ditemukan.";
            exit;
        }

        $this->view('order-detail', ['order' => $orderData]);

        unset($_SESSION['order_id']);
    }
}