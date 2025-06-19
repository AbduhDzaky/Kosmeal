<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>KosMeal - Payment Confirmed</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="public/css/stylepayment.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
</head>
<body>
  <nav class="navbar navbar-expand-lg bg-dark navbar-dark">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold text-yellow" href="#">KosMeal</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
            <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Profile</a></li>
            <li class="nav-item"><a class="nav-link active" aria-current="page" href="index.php?c=Menu">Menu</a></li>
            <li class="nav-item"><a class="nav-link" href="index.php?c=Order&m=history">Order History</a></li>
            </ul>
        </div>
    </div>
  </nav>

  <div class="container">
    <div class="content">
        <h1>Payment Confirmed</h1>
        <div class="text-row">
          <?php if (!empty($createdAt)) : ?>
            <?php
              $dt = new DateTime($createdAt);
              $dt->setTimezone(new DateTimeZone('Asia/Jakarta'));
            ?>
            <p><?= $dt->format('d/m/Y') ?></p>
            <p><?= $dt->format('H:i:s') ?></p>
          <?php else : ?>
            <p>Tanggal tidak tersedia</p>
          <?php endif; ?>
        </div>

        <div class="separator"></div>
        <div class="text-row">
            <p>Order Number:</p>
            <p id="order-number"><?= $orderId ?></p>
        </div>
        <a href="index.php?c=Order&m=history" class="btn">Order History</a>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>