<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="public/css/Tampilan.css">
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
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Profile</a></li>
                    <li class="nav-item"><a class="nav-link" href="index.php?c=Menu">Menu</a></li>
                    <li class="nav-item"><a class="nav-link" href="index.php?c=Order&m=history">Order History</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container my-3">
        <div class="intro text-center">
            <h1 class="fw-bold">KosMeal</h1>
            <p class="mt-3">
                Kosmeal adalah layanan catering yang menyediakan pilihan makanan
                sehat dan terjangkau untuk mahasiswa.<br>
                Dengan berbagai pilihan paket hemat, medium, dan premium,<br>
                Kosmeal hadir untuk memudahkan kamu yang sibuk kuliah dan tidak
                punya banyak waktu untuk memasak.<br>
                Cukup pesan, makanan sehat langsung diantar ke kos, tanpa repot
                dan tetap ramah di kantong!
            </p>
            <a class="btn bg-kuning text-dark fw-semibold mt-3 px-4 py-2" href="index.php?c=Menu">Pesan Sekarang</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>