<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Verileri - Sonuç</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/iletisim.css">

    <style>
        .data-card {
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
            padding: 40px;
            margin-top: 30px;
        }

        .data-card h2 {
            color: #2d3748;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .data-card .subtitle {
            color: #718096;
            font-size: 0.95rem;
            margin-bottom: 30px;
        }

        .data-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }

        .data-table tr:not(:last-child) td {
            border-bottom: 1px solid #e2e8f0;
        }

        .data-table td {
            padding: 14px 16px;
            vertical-align: top;
        }

        .data-table td:first-child {
            font-weight: 700;
            color: #4a5568;
            white-space: nowrap;
            width: 200px;
        }

        .data-table td:last-child {
            color: #2d3748;
        }

        .badge-interest {
            display: inline-block;
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: #fff;
            font-size: 0.78rem;
            font-weight: 600;
            padding: 4px 12px;
            border-radius: 20px;
            margin-right: 6px;
            margin-bottom: 4px;
        }

        .empty-value {
            color: #a0aec0;
            font-style: italic;
        }

        .btn-back {
            background: linear-gradient(135deg, #667eea, #764ba2);
            border: none;
            color: #ffffff;
            font-weight: 700;
            padding: 10px 30px;
            border-radius: 10px;
            text-decoration: none;
            transition: transform 0.2s, box-shadow 0.2s;
            display: inline-block;
            margin-top: 25px;
        }

        .btn-back:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(118, 75, 162, 0.3);
            color: #ffffff;
        }

        .success-banner {
            background: linear-gradient(135deg, #48bb78, #38a169);
            color: #fff;
            padding: 16px 24px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 1rem;
            margin-bottom: 30px;
        }

        /* Mobil Uyum */
        @media (max-width: 576px) {
            .data-card {
                padding: 20px;
            }

            .data-table td:first-child {
                width: auto;
            }

            .data-table td {
                display: block;
                padding: 8px 12px;
            }

            .data-table td:first-child {
                padding-bottom: 0;
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
    <main class="flex-grow-1">
        <div class="container mt-5 mb-5">
            <div class="row justify-content-center">
                <div class="col-lg-8">

                    <?php
                    // POST verilerini al
                    $ad_soyad       = isset($_POST['name'])      ? htmlspecialchars(trim($_POST['name']))      : '';
                    $email          = isset($_POST['email'])     ? htmlspecialchars(trim($_POST['email']))     : '';
                    $telefon        = isset($_POST['phone'])     ? htmlspecialchars(trim($_POST['phone']))     : '';
                    $dogum_tarihi   = isset($_POST['birthdate']) ? htmlspecialchars(trim($_POST['birthdate'])) : '';
                    $cinsiyet       = isset($_POST['gender'])    ? htmlspecialchars(trim($_POST['gender']))    : '';
                    $konu           = isset($_POST['subject'])   ? htmlspecialchars(trim($_POST['subject']))   : '';
                    $mesaj          = isset($_POST['message'])   ? htmlspecialchars(trim($_POST['message']))   : '';

                    // İlgi alanları (checkbox — dizi olarak gelir)
                    $ilgi_alanlari = isset($_POST['interests']) ? $_POST['interests'] : [];

                    // Konu değerlerini okunabilir metne çevir
                    $konu_metinleri = [
                        'isbirligi' => 'İş Birliği Teklifi',
                        'proje'     => 'Proje Hakkında',
                        'teknik'    => 'Teknik Destek',
                        'diger'     => 'Diğer'
                    ];
                    $konu_metin = isset($konu_metinleri[$konu]) ? $konu_metinleri[$konu] : $konu;
                    ?>

                    <div class="data-card">
                        <div class="success-banner">
                            ✅ Formunuz başarıyla gönderildi! Aşağıda gönderilen tüm veriler listelenmiştir.
                        </div>

                        <h2>📋 Gönderilen Form Verileri</h2>
                        <p class="subtitle">İletişim formundan alınan bilgiler sunucu tarafında (PHP) işlenmiştir.</p>

                        <table class="data-table">
                            <tr>
                                <td>👤 Ad Soyad</td>
                                <td><?php echo $ad_soyad ?: '<span class="empty-value">Belirtilmedi</span>'; ?></td>
                            </tr>
                            <tr>
                                <td>📧 E-posta</td>
                                <td><?php echo $email ?: '<span class="empty-value">Belirtilmedi</span>'; ?></td>
                            </tr>
                            <tr>
                                <td>📱 Telefon</td>
                                <td><?php echo $telefon ?: '<span class="empty-value">Belirtilmedi</span>'; ?></td>
                            </tr>
                            <tr>
                                <td>🎂 Doğum Tarihi</td>
                                <td><?php echo $dogum_tarihi ?: '<span class="empty-value">Belirtilmedi</span>'; ?></td>
                            </tr>
                            <tr>
                                <td>⚧ Cinsiyet</td>
                                <td><?php echo $cinsiyet ?: '<span class="empty-value">Belirtilmedi</span>'; ?></td>
                            </tr>
                            <tr>
                                <td>📌 Konu</td>
                                <td><?php echo $konu_metin ?: '<span class="empty-value">Belirtilmedi</span>'; ?></td>
                            </tr>
                            <tr>
                                <td>🎯 İlgi Alanları</td>
                                <td>
                                    <?php
                                    if (!empty($ilgi_alanlari)) {
                                        foreach ($ilgi_alanlari as $ilgi) {
                                            echo '<span class="badge-interest">' . htmlspecialchars($ilgi) . '</span>';
                                        }
                                    } else {
                                        echo '<span class="empty-value">Belirtilmedi</span>';
                                    }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td>💬 Mesaj</td>
                                <td><?php echo nl2br($mesaj) ?: '<span class="empty-value">Belirtilmedi</span>'; ?></td>
                            </tr>
                        </table>

                        <a href="iletisim.html" class="btn-back">← İletişim Sayfasına Geri Dön</a>
                    </div>

                </div>
            </div>
        </div>
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
