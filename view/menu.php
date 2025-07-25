<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
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

    <div class="container bg-menu mt-4">
        <h2 class="fw-bold text-center mb-4 text-kuning">Paket Menu Bulanan</h2>
        <div class="row justify-content-center g-4">
            <?php foreach ($packages as $package) : ?>
                <div class="col-md-4 d-flex flex-column">
                   <div class="card h-100 text-center p-3 menu-card d-flex flex-column">
                    <img
                        src="public/img/paket<?= strtolower($package['name']) ?>.jpg"
                        alt="<?= htmlspecialchars($package['name']) ?>"
                        class="img-fluid mb-2"
                        style="height: 150px; object-fit: cover; border-radius: 10px;"
                        onerror="this.onerror=null;this.src='https://via.placeholder.com/150x150?text=No+Image';"
                    >
                    <h5 class="fw-bold"><?= htmlspecialchars($package['name']) ?></h5>
                    <p><?= htmlspecialchars($package['description']) ?></p>
                    <a href="index.php?c=Order&m=index&package=<?= urlencode($package['name']) ?>" class="text-decoration-none mt-auto">
                        <div class="bg-kuning rounded p-2 w-75 mx-auto text-dark fw-bold">Rp<?= number_format($package['price'], 0, ',', '.') ?></div>
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>