<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giriş Kontrol</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css">

    <style>
        body {
            background: linear-gradient(135deg, #0f0c29, #302b63, #24243e);
            min-height: 100vh;
        }

        .result-card {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            padding: 50px 40px;
            box-shadow: 0 15px 50px rgba(0, 0, 0, 0.4);
            max-width: 520px;
            width: 100%;
            text-align: center;
        }

        .success-icon {
            font-size: 4rem;
            display: block;
            margin-bottom: 20px;
        }

        .result-card h1 {
            color: #ffffff;
            font-weight: 700;
            font-size: 1.8rem;
            margin-bottom: 12px;
        }

        .result-card .student-id {
            display: inline-block;
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: #fff;
            font-weight: 700;
            font-size: 1.1rem;
            padding: 8px 24px;
            border-radius: 30px;
            letter-spacing: 1px;
            margin: 16px 0;
        }

        .result-card p {
            color: rgba(255, 255, 255, 0.6);
            font-size: 0.95rem;
        }

        .btn-home {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: #ffffff;
            font-weight: 600;
            padding: 10px 30px;
            border-radius: 10px;
            text-decoration: none;
            transition: background 0.3s;
            display: inline-block;
            margin-top: 20px;
        }

        .btn-home:hover {
            background: rgba(255, 255, 255, 0.2);
            color: #ffffff;
        }

        /* Mobil Uyum */
        @media (max-width: 576px) {
            .result-card {
                margin: 10px;
                padding: 35px 20px;
            }
        }
    </style>
</head>

<body class="d-flex flex-column min-vh-100">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="index.html">Portfolyom</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="index.html">Hakkında</a></li>
                    <li class="nav-item"><a class="nav-link" href="ozgecmis.html">Özgeçmiş</a></li>
                    <li class="nav-item"><a class="nav-link" href="sehrim.html">Şehrim</a></li>
                    <li class="nav-item"><a class="nav-link" href="mirasimiz.html">Mirasımız</a></li>
                    <li class="nav-item"><a class="nav-link" href="ilgialanlarim.html">İlgi Alanlarım</a></li>
                    <li class="nav-item"><a class="nav-link" href="iletisim.html">İletişim</a></li>
                    <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Ana İçerik -->
    <main class="flex-grow-1 d-flex align-items-center justify-content-center py-5">

        <?php
        // Tanımlı kullanıcı bilgileri (hardcoded)
        $dogru_email = "b2412100042@sakarya.edu.tr";
        $dogru_sifre = "b2412100042";

        // POST verilerini al
        $email = isset($_POST['email']) ? trim($_POST['email']) : '';
        $sifre = isset($_POST['sifre']) ? trim($_POST['sifre']) : '';

        // Boş alan kontrolü
        if (empty($email) || empty($sifre)) {
            header("Location: login.php?hata=2");
            exit();
        }

        // Kullanıcı adı ve şifre karşılaştırması
        if ($email === $dogru_email && $sifre === $dogru_sifre) {
            // Başarılı giriş — öğrenci numarasını e-postadan çıkar
            $ogrenci_no = explode('@', $email)[0];
        ?>

            <div class="result-card">
                <div class="success-icon">✅</div>
                <h1>Hoşgeldiniz!</h1>
                <div class="student-id"><?php echo htmlspecialchars($ogrenci_no); ?></div>
                <p>Giriş işleminiz başarıyla tamamlandı. Sisteme öğrenci numaranız ile giriş yaptınız.</p>
                <a href="index.html" class="btn-home">🏠 Ana Sayfaya Dön</a>
            </div>

        <?php
        } else {
            // Başarısız giriş — hata ile login sayfasına yönlendir
            header("Location: login.php?hata=1");
            exit();
        }
        ?>

    </main>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-3 mt-auto">
        <div class="container">
            <p class="mb-0">&copy; 2026 Tüm Hakları Saklıdır. Web Teknolojileri Projesi.</p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
