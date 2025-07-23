<?php
$linkMidtrans = '#'; // default jika paket tidak ditemukan

switch (strtolower($orderDetails['package'] ?? '')) {
    case 'hemat':
        $linkMidtrans = 'https://app.sandbox.midtrans.com/payment-links/1753088677395';
        break;
    case 'medium':
        $linkMidtrans = 'https://app.sandbox.midtrans.com/payment-links/1753088759507';
        break;
    case 'premium':
        $linkMidtrans = 'https://app.sandbox.midtrans.com/payment-links/1753088817105';
        break;
    default:
        $linkMidtrans = 'https://app.sandbox.midtrans.com/payment-links/PAKET_DEFAULT_LINK';
        break;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Order</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="public/css/Tampilan.css">
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
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="index.php?c=Menu">Menu</a>
                </li><li class="nav-item"><a class="nav-link" href="index.php?c=Order&m=history">Order History</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container mt-3" style="max-width: 420px;">
        <?php
        $orderDetails = $data['orderDetails'] ?? [];
        $orderId = htmlspecialchars($orderDetails['orderId'] ?? '');
        $date = htmlspecialchars($orderDetails['date'] ?? '');
        $total = number_format($orderDetails['total'] ?? 0, 0, ',', '.');
        $package = htmlspecialchars($orderDetails['package'] ?? 'Default Package');
        $price = number_format($orderDetails['price'] ?? 0, 0, ',', '.');
        $tax = number_format($orderDetails['tax'] ?? 0, 0, ',', '.');
        ?>
        <section class="card p-2 border-0" style="background-color: #5d5d5f;">
            <div class="text-center pb-2 border-bottom" style="border-color: rgba(255,255,255,0.1);">
                <h2 class="fw-bold mb-1" style="font-size: 1.15rem; color: #ffcc00;">
                    Order #<?= $orderId ?>
                </h2>
                <p class="mb-0" style="font-size: 0.9rem; color: #ffcc00;">
                    <?= $date ?> - Rp<?= $total ?>
                </p>
            </div>

            <img
                src="public/img/paket<?= strtolower($orderDetails['package']) ?>.jpg"
                class="img-fluid w-100 my-2"
                style="height: 130px; object-fit: cover; border-radius: 6px"
                onerror="this.onerror=null;this.src='https://via.placeholder.com/150x150?text=No+Image';" {{-- Tambahkan kembali onerror jika gambar mungkin tidak ada --}}
            >

            <div class="text-center pb-2 border-bottom" style="border-color: rgba(255,255,255,0.1);">
                <h5 class="fw-bold mb-1" style="font-size: 1rem; color: #ffcc00;">
                    <?= $package ?>
                </h5>
                <p class="mb-1 px-2" style="font-size: 0.85rem; color: white;">
                    Menu diacak setiap hari agar kamu nggak bosan, dan dikirim langsung ke kost dua kali sehari pagi dan siang, biar kamu tetap kenyang tanpa repot!
                </p>
            </div>

            <div class="p-3 text-kuning">
                <div class="d-flex justify-content-between mb-1">
                    <span>Subtotal :</span>
                    <span>Rp<?= $price ?></span>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <span>PPN (10%) :</span>
                    <span>Rp<?= $tax ?></span>
                </div>
                <div class="d-flex justify-content-between fw-bold mb-3" style="font-size: 1.1rem;">
                    <span>Total :</span>
                    <span>Rp<?= $total ?></span>
                </div>
                <a href="<?= $linkMidtrans ?>"
    id="payButton"
    class="btn bg-kuning text-dark fw-bold w-100 py-2"
    data-package-name="<?= htmlspecialchars($orderDetails['package'] ?? '') ?>"
    data-package-price="<?= htmlspecialchars($orderDetails['price'] ?? '') ?>"
    data-order-id="<?= htmlspecialchars($orderDetails['orderId'] ?? '') ?>"
    data-total-amount="<?= htmlspecialchars($orderDetails['total'] ?? '') ?>">
    Bayar
</a>
                <div id="statusMessage" class="mt-3 text-center" style="color: white;"></div>
            </div>

        </section>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    document.getElementById('payButton').addEventListener('click', function() {
        const packageName = this.dataset.packageName;
        const packagePrice = this.dataset.packagePrice;
        const orderId = this.dataset.orderId;
        const totalAmount = this.dataset.totalAmount;
        const statusMessageDiv = document.getElementById('statusMessage'); 

        statusMessageDiv.textContent = 'Memproses...';
        statusMessageDiv.style.color = 'white'; 

        const formData = new URLSearchParams();
        formData.append('package', packageName);
        formData.append('price', packagePrice);
        formData.append('orderId', orderId);
        formData.append('total', totalAmount);

        fetch('main.php?c=Order&m=saveOrder', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: formData.toString()
        })
        .then(response => {
            if (!response.ok) {
                return response.text().then(text => { 
                    throw new Error(text || 'Network response was not ok');
                });
            }
            return response.json(); 
        })
        .then(data => {
            if (data.success) {
                statusMessageDiv.textContent = ''; 
                statusMessageDiv.style.color = ''; 
                window.location.href = data.redirectUrl;
                
            } else {
                statusMessageDiv.textContent = 'Error: ' + data.message; 
                statusMessageDiv.style.color = 'red'; 
            }
        })
        .catch(error => {
            console.error('Terjadi masalah dengan operasi pengambilan data:', error);
            let errorMessage = 'Terjadi kesalahan tidak terduga.';
            try {
                const errorData = JSON.parse(error.message); 
                errorMessage = errorData.message || errorMessage;
            } catch (e) {
                errorMessage = error.message; 
            }
        });
    });
    </script>
</body>
</html>