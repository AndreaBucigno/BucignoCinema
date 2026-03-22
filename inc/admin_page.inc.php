<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>BucignoCinema — {{title}}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="/BucignoCinema/assets/css/styles.css" />
    <link href="//cdn.datatables.net/2.3.7/css/dataTables.dataTables.min.css" rel="stylesheet" />
    <script src="//cdn.datatables.net/2.3.7/js/jquery.dataTables.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="/BucignoCinema/assets/js/script.js"></script>
</head>

<body class="bg-dark">

    <div class="container-fluid d-flex">

        <!-- SIDEBAR -->
        <div id="sidebar">
            <div class="sidebar-brand text-white text-center">
                <i class="bi bi-film fs-3"></i>
                <div class="fw-bold mt-1">Bucigno Cinema</div>
                <small class="text-white-50">Pannello Admin</small>
            </div>
            <nav class="nav flex-column mt-3">
                <a href="/BucignoCinema/admin.php" class="nav-link {{active_Home}}"><i class="bi bi-house-door-fill me-2"></i>Home</a>
                <a href="/BucignoCinema/Sub_Admin/admin-cinema.php" class="nav-link {{active_cinema}}"><i class="bi bi-speedometer2 me-2"></i>Cinema</a>
                <a href="/BucignoCinema/Sub_Admin/admin-spettacoli.php" class="nav-link {{active_film}}"><i class="bi bi-camera-reels me-2"></i>Spettacoli</a>
                <a href="/BucignoCinema/Sub_Admin/admin-proiezioni.php" class="nav-link {{active_programmazione}}"><i class="bi bi-calendar3 me-2"></i>Programmazione</a>
                <a href="/BucignoCinema/Sub_Admin/admin-prenotazioni.php" class="nav-link {{active_biglietti}}"><i class="bi bi-ticket-perforated me-2"></i>Prenotazioni</a>
                <a href="/BucignoCinema/Sub_Admin/admin-clienti.php" class="nav-link {{active_utenti}}"><i class="bi bi-people me-2"></i>Clienti</a>
                <hr class="sidebar-divider" />

                <hr class="sidebar-divider" />
                <a href="/BucignoCinema/logout.php" class="nav-link text-danger"><i class="bi bi-box-arrow-left me-2"></i>Logout</a>
            </nav>
        </div>

        <!-- CONTENUTO -->
        <div id="main" class="bg-dark text-white">
            <div id="topbar" class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-bold text-white">{{title}}</h5>
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-person-circle fs-4 text-light"></i>
                    <span class="small text-light">{{admin_name}}</span>
                </div>
            </div>
            <div class="p-4 bg-dark shadow-sm rounded ">

                {{body}}
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="?v=<?php echo file_exists(__DIR__ . '/assets/js/script.js') ? filemtime(__DIR__ . '/assets/js/script.js') : 0; ?>"></script>
</body>

</html>