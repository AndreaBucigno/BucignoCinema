<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>BucignoCinema - Home </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet" />
</head>

<body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-danger">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">
                <i class="bi bi-film me-2"></i>
                BucignoCinema
            </a>
            <button class="navbar-toggler" type="button"
                data-bs-toggle="collapse" data-bs-target="#navbarMain">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarMain">

                <a href="login.php" class="btn btn-dark align-self-right ms-auto">
                    <i class="bi bi-person-circle fs-5"></i>
                </a>
            </div>
        </div>
    </nav>

    <!-- CAROSELLO -->
    <div id="carouselCinema" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselCinema" data-bs-slide-to="0" class="active"></button>
            <button type="button" data-bs-target="#carouselCinema" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#carouselCinema" data-bs-slide-to="2"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://placehold.co/1200x450/212529/ffffff?text=Film+in+Arrivo" class="d-block w-100" alt="Film 1" />
                <div class="carousel-caption d-none d-md-block">
                    <h5>Il Grande Viaggio</h5>
                    <p>Dal 15 marzo in tutti i nostri schermi. Non perdertelo!</p>
                    <a href="#" class="btn btn-danger">Prenota ora</a>
                </div>
            </div>
            <div class="carousel-item">
                <img src="https://placehold.co/1200x450/b02a37/ffffff?text=Nuova+Stagione+2025" class="d-block w-100" alt="Film 2" />
                <div class="carousel-caption d-none d-md-block">
                    <h5>Nuova Stagione 2025</h5>
                    <p>Tanti nuovi film ti aspettano ogni settimana.</p>
                    <a href="#" class="btn btn-dark">Scopri la programmazione</a>
                </div>
            </div>
            <div class="carousel-item">
                <img src="https://placehold.co/1200x450/495057/ffffff?text=Offerta+Speciale" class="d-block w-100" alt="Film 3" />
                <div class="carousel-caption d-none d-md-block">
                    <h5>Offerta Speciale</h5>
                    <p>Ogni mercoledì biglietti a soli €5. Portaci tutta la famiglia!</p>
                    <a href="#" class="btn btn-danger">Scopri di più</a>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselCinema" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselCinema" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>

    <!-- SEZIONE FILM IN PROGRAMMAZIONE -->
    <div class="container my-5">
        <h2 class="fw-bold mb-4">Film in Programmazione</h2>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100 shadow-sm">
                    <img src="https://placehold.co/400x250/212529/ffffff?text=Film+1" class="card-img-top" alt="Film 1" />
                    <div class="card-body">
                        <h5 class="card-title">L'Ultimo Tramonto</h5>
                        <p class="card-text text-muted">Un emozionante thriller ambientato tra le montagne della Norvegia. Azione, suspense e colpi di scena garantiti.</p>
                        <span class="badge bg-danger me-1">Azione</span>
                        <span class="badge bg-secondary">18+</span>
                    </div>
                    <div class="card-footer d-flex justify-content-between align-items-center">
                        <small class="text-muted"><i class="bi bi-clock me-1"></i>2h 15min</small>
                        <a href="#" class="btn btn-sm btn-danger">Prenota</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 shadow-sm">
                    <img src="https://placehold.co/400x250/b02a37/ffffff?text=Film+2" class="card-img-top" alt="Film 2" />
                    <div class="card-body">
                        <h5 class="card-title">Stelle Lontane</h5>
                        <p class="card-text text-muted">Una storia d'amore e avventura tra le stelle. Un film che ti farà sognare e commuovere fino all'ultima scena.</p>
                        <span class="badge bg-primary me-1">Romantico</span>
                        <span class="badge bg-secondary">PG</span>
                    </div>
                    <div class="card-footer d-flex justify-content-between align-items-center">
                        <small class="text-muted"><i class="bi bi-clock me-1"></i>1h 58min</small>
                        <a href="#" class="btn btn-sm btn-danger">Prenota</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 shadow-sm">
                    <img src="https://placehold.co/400x250/495057/ffffff?text=Film+3" class="card-img-top" alt="Film 3" />
                    <div class="card-body">
                        <h5 class="card-title">Risate al Buio</h5>
                        <p class="card-text text-muted">La commedia dell'anno! Tre amici improbabili si ritrovano coinvolti in una serie di disavventure esilaranti.</p>
                        <span class="badge bg-success me-1">Commedia</span>
                        <span class="badge bg-secondary">PG</span>
                    </div>
                    <div class="card-footer d-flex justify-content-between align-items-center">
                        <small class="text-muted"><i class="bi bi-clock me-1"></i>1h 40min</small>
                        <a href="#" class="btn btn-sm btn-danger">Prenota</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- SEZIONE INFO -->
    <div class="bg-dark text-white py-5">
        <div class="container">
            <div class="row text-center g-4">
                <div class="col-md-4">
                    <i class="bi bi-camera-reels display-4 text-danger"></i>
                    <h4 class="mt-3">2 SEDI</h4>
                    <p class="text-muted">Cinque sale moderne con schermo 4K e audio Dolby Atmos per un'esperienza unica.</p>
                </div>
                <div class="col-md-4">
                    <i class="bi bi-cup-straw display-4 text-danger"></i>
                    <h4 class="mt-3">Bar & Snack</h4>

                </div>
                <div class="col-md-4">
                    <i class="bi bi-geo-alt display-4 text-danger"></i>
                    <h4 class="mt-3">Perugia, Italia</h4>

                </div>
            </div>
        </div>
    </div>

    <!-- FOOTER -->
    <footer class="bg-danger text-white text-center py-3">
        <small>&copy; 2025 Bucigno Cinama — Tutti i diritti riservati</small>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>