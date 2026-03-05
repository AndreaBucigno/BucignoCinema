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
                <div style="height:450px; background-color:#212529; display:flex; align-items:center; justify-content:center;">
                    <h1 style="color:white; font-size:4rem; font-weight:bold;">#TORNA AL CINEMA</h1>
                </div>
                <div class="carousel-caption d-none d-md-block">
                    <h5>Accedi per prenotare un biglietto presso una delle nostre sedi</h5>
                    <a href="login.php" class="btn btn-danger">Accedi</a>
                </div>
            </div>
            <div class="carousel-item">
                <div style="height:450px; background-color:#b02a37; display:flex; align-items:center; justify-content:center;">
                    <h1 style="color:white; font-size:4rem; font-weight:bold;">#TORNA AL CINEMA</h1>
                </div>
                <div class="carousel-caption d-none d-md-block">
                    <h5>Nuova Stagione 2025</h5>
                    <p>Tanti nuovi film ti aspettano ogni settimana.</p>
                    <a href="#" class="btn btn-dark">Scopri la programmazione</a>
                </div>
            </div>
            <div class="carousel-item">
                <div style="height:450px; background-color:#495057; display:flex; align-items:center; justify-content:center;">
                    <h1 style="color:white; font-size:4rem; font-weight:bold;">#TORNA AL CINEMA</h1>
                </div>
                <div class="carousel-caption d-none d-md-block">
                    <h5>Offerta Speciale</h5>
                    <p>Ogni mercoledì biglietti a soli €5. Portaci tutta la famiglia!</p>
                    <a href="#" class="btn btn-danger">Scopri di più</a>
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

        <!-- RECENSIONI -->
        <div class="bg-dark text-white py-5">
            <div class="container">
                <h2 class="fw-bold mb-4 text-center">Cosa dicono i nostri clienti</h2>
                <div id="carouselRecensioni" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">

                        <div class="carousel-item active">
                            <div class="d-flex justify-content-center">
                                <div class="card bg-secondary text-white p-4 shadow" style="max-width:600px; width:100%;">
                                    <div class="d-flex align-items-center mb-3">
                                        <i class="bi bi-person-circle fs-1 me-3 text-danger"></i>
                                        <div>
                                            <h6 class="mb-0 fw-bold">Marco Rossi</h6>
                                            <small class="text-warning">
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                            </small>
                                        </div>
                                    </div>
                                    <p class="mb-0">"Esperienza fantastica! Le sale sono modernissime e il suono è incredibile. Tornerò sicuramente!"</p>
                                </div>
                            </div>
                        </div>

                        <div class="carousel-item">
                            <div class="d-flex justify-content-center">
                                <div class="card bg-secondary text-white p-4 shadow" style="max-width:600px; width:100%;">
                                    <div class="d-flex align-items-center mb-3">
                                        <i class="bi bi-person-circle fs-1 me-3 text-danger"></i>
                                        <div>
                                            <h6 class="mb-0 fw-bold">Giulia Bianchi</h6>
                                            <small class="text-warning">
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-half"></i>
                                            </small>
                                        </div>
                                    </div>
                                    <p class="mb-0">"Personale gentilissimo e prezzi onesti. La sala IMAX è spettacolare, non delude mai!"</p>
                                </div>
                            </div>
                        </div>

                        <div class="carousel-item">
                            <div class="d-flex justify-content-center">
                                <div class="card bg-secondary text-white p-4 shadow" style="max-width:600px; width:100%;">
                                    <div class="d-flex align-items-center mb-3">
                                        <i class="bi bi-person-circle fs-1 me-3 text-danger"></i>
                                        <div>
                                            <h6 class="mb-0 fw-bold">Luca Verdi</h6>
                                            <small class="text-warning">
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                            </small>
                                        </div>
                                    </div>
                                    <p class="mb-0">"Il miglior cinema di Perugia senza dubbio. Programmazione sempre aggiornata e poltrone comodissime!"</p>
                                </div>
                            </div>
                        </div>

                    </div>

                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselRecensioni" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselRecensioni" data-bs-slide="next">
                        <span class="carousel-control-next-icon"></span>
                    </button>
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
        <footer class="bg-danger text-white text-center py-3 ">
            <small>&copy; 2025 Bucigno Cinama — Tutti i diritti riservati</small>
        </footer>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>