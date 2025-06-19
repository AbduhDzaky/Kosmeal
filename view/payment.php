<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>KosMeal - Payment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="public/css/stylepayment.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-dark navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold text-yellow" href="index.php">KosMeal</a>
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
            <h1>Payment</h1>
            <div class="qr-container">
                <p class="scan-text">Scan QR</p>
                <div class="qr-box">
                    <img src="public/img/qrcode.jpg" style="width: 100%; height: auto;" />
                </div>
            </div>
            
            <div class="text-row">
                <p>Total:</p>
                <p id="total-harga">
                    Rp<?= number_format($total, 0, ',', '.') ?>
                </p>
            </div>           
            <p class="text-upload">Silahkan upload bukti pembayaran</p>
            <form action="index.php?c=AppController&m=upload" method="POST" enctype="multipart/form-data">
                <div class="file-upload-container">
                    <input type="file" class="file-upload" name="bukti" accept="image/*" required>
                </div>
                <input type="hidden" name="orderNumber" value="<?php echo $orderNumber; ?>">
                <input type="hidden" name="total" value="<?php echo $total; ?>">
                <button class="btn" type="submit">Upload</button>
            </form>

            <div class="text-row">
                <p>Bayar Sebelum:</p>
                <p id="countdown"></p>
            </div>            
        </div>
    </div>

    <script>
        window.onload = function() {
            const now = new Date().getTime();
            
            const deadline = now + 2 * 60 * 60 * 1000;

            const countdownElement = document.getElementById("countdown");

            const interval = setInterval(() => {
                const currentTime = new Date().getTime();
                const distance = deadline - currentTime;

                if (distance <= 0) {
                    clearInterval(interval);
                    countdownElement.innerHTML = "00:00:00";
                    return;
                }

                const hours = Math.floor((distance / (1000 * 60 * 60)) % 24);
                const minutes = Math.floor((distance / (1000 * 60)) % 60);
                const seconds = Math.floor((distance / 1000) % 60);

                countdownElement.innerHTML = 
                    `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
            }, 1000);
        };
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>