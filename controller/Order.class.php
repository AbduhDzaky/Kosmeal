<?php
date_default_timezone_set('Asia/Jakarta');

class Order extends Controller {
    public function index() {
        $packageName = $_GET['package'] ?? null;

        if (!$packageName) {
            header('location:index.php?c=Menu');
            exit;
        }

        $model = $this->model('KosMealModel');
        $packageDetails = $model->getPackageDetails($packageName);

        if (!$packageDetails) {
            header('location:index.php?c=Menu');
            exit;
        }

        $orderId = 'ORD' . date('Ymd') . mt_rand(100000, 999999);
        $date = date('Y-m-d');
        $price = (double)$packageDetails['price'];
        $tax = $price * 0.10;
        $total = $price + $tax;

        $model->saveOrder($orderId, $packageDetails['name'], $price, $tax, $total, $date);

        session_start();
        $_SESSION['orderNumber'] = $orderId;

        $orderDetails = [
            'orderId' => $orderId,
            'date' => $date,
            'package' => $packageDetails['name'],
            'price' => $price,
            'tax' => $tax,
            'total' => $total
        ];

        $this->view('order_confirmation', ['orderDetails' => $orderDetails]);
    }

    public function saveOrder() {
        header('Content-Type: application/json'); 

        $orderId = $_POST['orderId'] ?? null;
        $packageName = $_POST['package'] ?? null;
        $packagePrice = $_POST['price'] ?? null;
        $totalFromClient = $_POST['total'] ?? null; 

        if (!$orderId || !$packageName || $packagePrice === null || $totalFromClient === null) {
            echo json_encode(['success' => false, 'message' => 'Data tidak lengkap.']);
            return;
        }

        $model = $this->model('KosMealModel');

        $packageDetails = $model->getPackageDetails($packageName);

        if (!$packageDetails || (double)$packageDetails['price'] != (double)$packagePrice) {
            echo json_encode(['success' => false, 'message' => 'Data paket tidak valid.']);
            return;
        }

        $date = date('Y-m-d');
        $price = (double)$packageDetails['price'];
        $tax = $price * 0.10;
        $calculatedTotal = $price + $tax;

        if (abs($calculatedTotal - (double)$totalFromClient) > 0.01) {
            error_log("Client total ($totalFromClient) mismatch with server total ($calculatedTotal) for order $orderId");
            echo json_encode(['success' => false, 'message' => 'Total pembayaran tidak cocok. Terjadi kesalahan.']);
            return;
        }

        if ($model->saveOrder($orderId, $packageName, $price, $tax, $calculatedTotal, $date)) {
            $redirectUrl = 'index.php?c=Payment&m=index&order_id=' . urlencode($orderId);
            echo json_encode([
                'success' => true,
                'message' => "Order '" . htmlspecialchars($packageName) . "' berhasil disimpan, lakukan pembayaran",
                'redirectUrl' => $redirectUrl
            ]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Terjadi kesalahan saat menyimpan order.']);
        }
    }
    public function history() 
    {
        $model = $this->model('KosMealModel');
        $allOrders = $model->getAllOrders();


        $this->view('order-history', ['orders' => $allOrders]);
    }
}