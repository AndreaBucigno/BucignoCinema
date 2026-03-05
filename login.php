<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>BucignoCinema - Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet" />
</head>

<body class="bg-dark">

    <div class="d-flex justify-content-center align-items-center vh-100">
        <div class="card shadow" style="width: 380px;">
            <div class="card-body p-4">

                <div class="text-center mb-4">
                    <i class="bi bi-film text-danger fs-1"></i>
                    <h4 class="fw-bold mt-2">BucignoCinema</h4>
                    <p class="text-muted small">Accedi al tuo account</p>
                </div>
                <form action="Handler/LoginHandler.php" method="POST">
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" placeholder="nome@email.it" name="email" />
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" class="form-control" placeholder="••••••••" name="password" />
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="ricordami" />
                            <label class="form-check-label small" for="ricordami">Ricordami</label>
                        </div>
                        <a href="reset_password.php" class="small text-danger">Password dimenticata?</a>
                    </div>

                    <button class="btn btn-danger w-100 mb-3">Accedi</button>
                    <div class="text-center mt-3">

                        <a href="index.php" class="small text-muted">
                            <i class="bi bi-arrow-left me-1"></i>Torna alla home
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>