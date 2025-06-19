

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pesanan - KosMeal</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="public/css/style.css" /> 
  
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold" href="index.php">KosMeal</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                
                <li class="nav-item"><a class="nav-link" href="#">Profile</a></li>
                
                <li class="nav-item"><a class="nav-link" href="index.php?c=Menu">Menu</a></li>

                <li class="nav-item"><a class="nav-link active" aria-current="page" href="index.php?c=Order&m=history">Order History</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container my-5">
    <h1 class="text-center mb-4 fw-bold text-warning">Order History</h1>

    <?php 
    session_start();
    if (!empty($data['orders'])): 
        foreach ($data['orders'] as $order):
            $_SESSION['order_id'] = $order['order_id'];
            $imagePath = 'public/img/default.jpg'; 
            $packageName = strtolower($order['package']);

            if ($packageName == 'hemat') {
                $imagePath = 'public/img/pakethemat.jpg';
            } elseif ($packageName == 'medium') {
                $imagePath = 'public/img/paketmedium.jpg'; 
            } elseif ($packageName == 'premium') {
                $imagePath = 'public/img/paketpremium.jpg';
            }
    ?>
            <div class="order-item rounded p-3 mb-3 d-flex align-items-center">
                <img src="<?= $imagePath; ?>" class="rounded" alt="<?= htmlspecialchars($order['package']); ?>" style="width: 80px; height: 80px; object-fit: cover;">
                
                <div class="ms-3 flex-grow-1">
                    <h6 class="mb-1 fw-bold text-warning"><?= htmlspecialchars($order['package']); ?></h6>
                    <p class="text-white-50 small mb-0">Pesanan pada <?= date('d M Y', strtotime($order['order_date'])); ?></p>
                </div>

                <a href="index.php?c=HistoryDetail&m=index" class="btn btn-warning btn-sm">
                    Detail
                </a>
            </div>
            <?php 
        endforeach; 
    else: 
    ?>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="alert alert-secondary text-center" role="alert">
                    <h4 class="alert-heading">Kosong!</h4>
                    <p class="mb-0">Anda belum memiliki riwayat pesanan apa pun.</p>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>