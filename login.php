<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giriş Yap - Login</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css">

    <style>
        body {
            background: linear-gradient(135deg, #0f0c29, #302b63, #24243e);
            min-height: 100vh;
        }

        .login-card {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 15px 50px rgba(0, 0, 0, 0.4);
            max-width: 480px;
            width: 100%;
        }

        .login-card h2 {
            color: #ffffff;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .login-card .subtitle {
            color: rgba(255, 255, 255, 0.5);
            font-size: 0.9rem;
            margin-bottom: 30px;
        }

        .login-card .form-label {
            color: rgba(255, 255, 255, 0.75);
            font-weight: 600;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
        }

        .login-card .form-control {
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.15);
            color: #ffffff;
            border-radius: 10px;
            padding: 12px 16px;
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        .login-card .form-control::placeholder {
            color: rgba(255, 255, 255, 0.3);
        }

        .login-card .form-control:focus {
            background: rgba(255, 255, 255, 0.1);
            border-color: #764ba2;
            box-shadow: 0 0 15px rgba(118, 75, 162, 0.3);
            color: #ffffff;
        }

        .btn-login {
            background: linear-gradient(135deg, #667eea, #764ba2);
            border: none;
            color: #ffffff;
            font-weight: 700;
            padding: 12px;
            border-radius: 10px;
            width: 100%;
            font-size: 1rem;
            letter-spacing: 0.5px;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(118, 75, 162, 0.4);
            color: #ffffff;
        }

        .login-icon {
            font-size: 3rem;
            display: block;
            text-align: center;
            margin-bottom: 16px;
        }

        .error-alert {
            background: rgba(220, 53, 69, 0.15);
            border: 1px solid rgba(220, 53, 69, 0.4);
            color: #ff6b7a;
            border-radius: 10px;
            padding: 12px 16px;
            font-size: 0.85rem;
            margin-bottom: 20px;
        }

        .js-error {
            color: #ff6b7a;
            font-size: 0.8rem;
            margin-top: 4px;
            display: none;
        }

        .js-error.visible {
            display: block;
        }

        .form-control.is-invalid {
            border-color: #dc3545 !important;
        }

        /* Mobil Uyum */
        @media (max-width: 576px) {
            .login-card {
                margin: 10px;
                padding: 30px 20px;
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
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="login.php">Login</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Ana İçerik -->
    <main class="flex-grow-1 d-flex align-items-center justify-content-center py-5">
        <div class="login-card">
            <div class="login-icon">🔐</div>
            <h2 class="text-center">Giriş Yap</h2>
            <p class="subtitle text-center">Öğrenci bilgileriniz ile giriş yapın</p>

            <!-- PHP hata mesajı -->
            <?php if (isset($_GET['hata']) && $_GET['hata'] == '1'): ?>
                <div class="error-alert">
                    ⚠ Kullanıcı adı veya şifre hatalı. Lütfen tekrar deneyin.
                </div>
            <?php endif; ?>

            <?php if (isset($_GET['hata']) && $_GET['hata'] == '2'): ?>
                <div class="error-alert">
                    ⚠ Lütfen tüm alanları doldurun.
                </div>
            <?php endif; ?>

            <form action="giris_kontrol.php" method="POST" id="loginForm" onsubmit="return validateLogin()">

                <!-- E-posta -->
                <div class="mb-3">
                    <label class="form-label">E-posta (Kullanıcı Adı)</label>
                    <input type="email" class="form-control" id="email" name="email"
                        placeholder="b2412100042@sakarya.edu.tr">
                    <div class="js-error" id="err-email">⚠ Geçerli bir @sakarya.edu.tr e-posta adresi girin.</div>
                </div>

                <!-- Şifre -->
                <div class="mb-4">
                    <label class="form-label">Şifre (Öğrenci Numarası)</label>
                    <input type="password" class="form-control" id="sifre" name="sifre"
                        placeholder="Öğrenci numaranızı girin">
                    <div class="js-error" id="err-sifre">⚠ Şifre boş bırakılamaz.</div>
                </div>

                <button type="submit" class="btn btn-login">Giriş Yap</button>
            </form>
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

    <script>
        // JavaScript ile istemci tarafında doğrulama
        function validateLogin() {
            let isValid = true;

            // Hataları temizle
            document.querySelectorAll('.js-error').forEach(el => el.classList.remove('visible'));
            document.querySelectorAll('.form-control').forEach(el => el.classList.remove('is-invalid'));

            const email = document.getElementById('email').value.trim();
            const sifre = document.getElementById('sifre').value.trim();

            // E-posta boş mu ve @sakarya.edu.tr formatında mı?
            const emailRegex = /^[a-zA-Z0-9]+@sakarya\.edu\.tr$/;
            if (!email || !emailRegex.test(email)) {
                document.getElementById('email').classList.add('is-invalid');
                document.getElementById('err-email').classList.add('visible');
                isValid = false;
            }

            // Şifre boş mu?
            if (!sifre) {
                document.getElementById('sifre').classList.add('is-invalid');
                document.getElementById('err-sifre').classList.add('visible');
                isValid = false;
            }

            return isValid;
        }
    </script>

</body>

</html>
