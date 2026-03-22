<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>BucignoCinema — {{title}}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet" />
    <link href="//cdn.datatables.net/2.3.7/css/dataTables.dataTables.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="//cdn.datatables.net/2.3.7/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="/BucignoCinema/assets/css/styles.css" />
</head>

<body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand fw-bold fs-5" href="">
                <i class="bi bi-film me-2" style="color:var(--rosso);"></i>
                BucignoCinema
            </a>

            <button class="navbar-toggler" type="button"
                data-bs-toggle="collapse" data-bs-target="#navbarUser">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarUser">
                <ul class="navbar-nav ms-auto gap-1">
                    <li class="nav-item">
                        <a class="nav-link {{active_profilo}}" href="/BucignoCinema/user.php">
                            <i class="bi bi-person-circle me-1"></i>Profilo
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{active_prenotazioni}}" href="/BucignoCinema/Sub_User/user-prenotazioni.php">
                            <i class="bi bi-ticket-perforated me-1"></i>Prenotazioni
                        </a>
                    </li>

                    <li class="nav-item ms-2">
                        <a class="nav-link text-danger" href="/BucignoCinema/login.php">
                            <i class="bi bi-box-arrow-left me-1"></i>Logout
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- CONTENUTO -->
    <div class="container py-4" style="min-height: calc(100vh - 120px);">

        {{body}}
    </div>

    <footer>
        <small>&copy; 2026 BucignoCinema — Tutti i diritti riservati</small>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>