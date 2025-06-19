

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Detail Pesanan - <?= htmlspecialchars($data['order']['order_id']); ?></title>
    
    <script src="https://unpkg.com/feather-icons"></script>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" />
    
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
                
                <li class="nav-item"><a class="nav-link" href="index.php?c=Menu">Menu</a></li>

                <li class="nav-item"><a class="nav-link active" aria-current="page" href="index.php?c=Order&m=history">Order History</a></li>
            </ul>
        </div>
    </div>
</nav>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-7">
                <h2 class="text-center fw-bold">Detail Pesanan</h2>
                <p class="text-center text-muted mb-4 text-kuning">#<?= htmlspecialchars($data['order']['order_id']); ?></p>

                <div class="card shadow-sm card-dark">
                    <div class="card-header text-center">
                        <h5 class="mb-0 fw-bold"><?= htmlspecialchars($data['order']['package']); ?></h5>
                        <small class="text-muted"><?= date('d F Y', strtotime($data['order']['order_date'])); ?></small>
                    </div>
                    <?php
                        $image = 'public/img/default.jpg';
                        if (strtolower($data['order']['package']) == 'hemat') $image = 'public/img/pakethemat.jpg';
                        if (strtolower($data['order']['package']) == 'medium') $image = 'public/img/paketmedium.jpg';
                        if (strtolower($data['order']['package']) == 'premium') $image = 'public/img/paketpremium.jpg';
                    ?>
                    <img src="<?= $image; ?>" class="card-img-top" alt="Paket <?= htmlspecialchars($data['order']['package']); ?>" style="max-height: 250px; object-fit: cover;">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between">
                            <span class="text-muted">Subtotal</span>
                            <span>Rp<?= number_format($data['order']['price'], 0, ',', '.'); ?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span class="text-muted">PPN (10%)</span>
                            <span>Rp<?= number_format($data['order']['tax'], 0, ',', '.'); ?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between fw-bold">
                            <span class="text-warning">Total</span>
                            <span class="fs-5 text-warning">Rp<?= number_format($data['order']['total'], 0, ',', '.'); ?></span>
                        </li>
                    </ul>
                </div>
                
                <div class="card shadow-sm mt-4 card-dark">
                    <div class="card-header">
                        <h5 class="mb-0 fw-bold">Beri Ulasan Anda</h5>
                    </div>
                    <div class="card-body">
                        <p class="text-muted small">Ulasan Anda akan disimpan di browser ini.</p>
                        <div class="stars text-center fs-2 mb-3" data-rating="0">
                            <i data-feather="star" data-value="1"></i>
                            <i data-feather="star" data-value="2"></i>
                            <i data-feather="star" data-value="3"></i>
                            <i data-feather="star" data-value="4"></i>
                            <i data-feather="star" data-value="5"></i>
                        </div>
                        <textarea id="reviewText" class="form-control mb-3" rows="3" placeholder="Tulis pengalaman Anda..."></textarea>
                        <div class="d-grid">
                            <button id="saveReviewBtn" class="btn bg-kuning text-dark fw-semibold">Simpan Ulasan</button>
                        </div>
                        <div id="alertPlaceholder" class="mt-3"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        feather.replace();
        const orderId = '<?= htmlspecialchars($data['order']['order_id']); ?>';
        const reviewKey = 'review_' + orderId;
        const starsContainer = document.querySelector('.stars');
        const allStars = starsContainer.querySelectorAll('.feather');
        const reviewTextArea = document.getElementById('reviewText');
        const saveButton = document.getElementById('saveReviewBtn');
        const alertPlaceholder = document.getElementById('alertPlaceholder');
        function setRating(rating){starsContainer.dataset.rating=rating;allStars.forEach(star=>{if(parseInt(star.dataset.value)<=rating){star.style.fill='#ffc107';star.classList.add('active')}else{star.style.fill='none';star.classList.remove('active')}})};allStars.forEach(star=>{star.addEventListener('click',()=>{const rating=parseInt(star.dataset.value);setRating(rating)})});function showAlert(message,type){alertPlaceholder.innerHTML=`<div class="alert alert-${type}" role="alert">${message}</div>`;setTimeout(()=>{alertPlaceholder.innerHTML=''},3000)};saveButton.addEventListener('click',()=>{const rating=parseInt(starsContainer.dataset.rating);const text=reviewTextArea.value;if(rating===0){showAlert('Harap berikan rating bintang terlebih dahulu.','danger');return}const reviewData={rating:rating,text:text};localStorage.setItem(reviewKey,JSON.stringify(reviewData));showAlert('Ulasan Anda berhasil disimpan!','success')});document.addEventListener('DOMContentLoaded',()=>{const savedReviewJSON=localStorage.getItem(reviewKey);if(savedReviewJSON){const savedReview=JSON.parse(savedReviewJSON);setRating(savedReview.rating);reviewTextArea.value=savedReview.text;console.log('Ulasan yang tersimpan berhasil dimuat.')}});
    </script>
</body>
</html>