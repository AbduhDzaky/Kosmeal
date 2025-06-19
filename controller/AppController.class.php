<?php
date_default_timezone_set('Asia/Jakarta');

class AppController {
    protected $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function model($modelName) {
        require_once "model/{$modelName}.class.php";
        return new $modelName();
    }

    public function view($viewName, $data = []) {
        extract($data);
        require "view/{$viewName}";
    }

    public function index() {
        header("Location: index.php?c=Home");
        exit;
    }

    public function payment() {
        session_start();
        $orderId = $_SESSION['orderNumber'] ?? null;

        if (!$orderId) {
            echo "Order ID tidak diberikan.";
            return;
        }

        require_once "model/KosMealModel.class.php";
        $model = $this->model('KosMealModel');
        $orderData = $model->getOrderById($orderId);

        if (!$orderData) {
            echo "Order tidak ditemukan.";
            return;
        }

        $orderNumber = $orderData['order_id'];
        $total = $orderData['total'];
        require "view/payment.php";
    }

    public function confirmed() {
        session_start();
        $orderId = $_SESSION['orderNumber'] ?? null;

        if (!$orderId) {
            echo "Order ID tidak tersedia.";
            return;
        }

        require_once "model/KosMealModel.class.php";
        $model = $this->model('KosMealModel');
        $orderData = $model->getOrderById($orderId);

        $modelPayment = new PaymentModel();
        $paymentData = $modelPayment->getByOrderNumber($orderId);

        if (!$orderData) {
            echo "Order tidak ditemukan.";
            return;
        }

        $createdAt = $paymentData['created_at'] ?? $orderData['created_at'] ?? null;

        $this->view('confirmed.php', [
            'orderId' => $orderId,
            'createdAt' => $createdAt
        ]);
    }

    public function upload() {
        if (isset($_FILES['bukti']) && $_FILES['bukti']['error'] === 0) {
            $bukti = $_FILES['bukti'];
            $orderNumber = $_POST['orderNumber'];
            $total = $_POST['total'];

            $uploadPath = "upload/" . $orderNumber . "_" . basename($bukti['name']);
            move_uploaded_file($bukti['tmp_name'], $uploadPath);

            $batasWaktu = date('Y-m-d H:i:s');
            $createdAt = date('Y-m-d H:i:s');

            require_once "model/PaymentModel.php";
            $model = new PaymentModel();
            $model->save($orderNumber, $uploadPath, $batasWaktu, $createdAt);

            session_start();
            $_SESSION['orderNumber'] = $orderNumber;
            header("Location: index.php?c=AppController&m=confirmed");
            exit;
        }
    }
}