<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>BucignoCinema - Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="assets/css/styles.css" />
</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand fw-bold fs-5" href="#">
                <i class="bi bi-film me-2" style="color:var(--rosso);"></i>
                BucignoCinema
            </a>
            <a href="login.php" class="btn btn-login ms-auto px-3">
                <i class="bi bi-person-circle me-1"></i> Accedi
            </a>
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
                <div class="carousel-slide slide-1">
                    <div class="slide-titolo">#<span>TORNA</span> AL CINEMA</div>
                </div>
                <div class="carousel-caption">
                    <h5>Accedi e prenota il tuo posto</h5>
                    <a href="login.php" class="btn btn-sm mt-1" style="background:var(--rosso); color:white;">Accedi ora</a>
                </div>
            </div>
            <div class="carousel-item">
                <div class="carousel-slide slide-2">
                    <div class="slide-titolo">#<span>TORNA</span> AL CINEMA</div>
                </div>
                <div class="carousel-caption">
                    <h5>Nuova Stagione 2026</h5>
                    <p>Tanti nuovi film ogni settimana.</p>
                    <a href="#" class="btn btn-sm mt-1" style="background:var(--rosso); color:white;">Scopri</a>
                </div>
            </div>
            <div class="carousel-item">
                <div class="carousel-slide slide-3">
                    <div class="slide-titolo">#<span>TORNA</span> AL CINEMA</div>
                </div>
                <div class="carousel-caption">
                    <h5>Offerta Speciale</h5>
                    <p>Ogni mercoledì biglietti a soli €5.</p>
                    <a href="#" class="btn btn-sm mt-1" style="background:var(--rosso); color:white;">Scopri di più</a>
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

    <!-- RECENSIONI -->
    <div class="sezione-recensioni">
        <div class="container">
            <h2 class="sezione-titolo">Cosa dicono i nostri clienti</h2>
            <div id="carouselRecensioni" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="recensione-card">
                            <div class="d-flex align-items-center mb-3 gap-3">
                                <i class="bi bi-person-circle fs-2" style="color:var(--rosso);"></i>
                                <div>
                                    <div class="fw-bold">Marco Rossi</div>
                                    <div class="stelle">
                                        <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                    </div>
                                </div>
                            </div>
                            <p>"Esperienza fantastica! Le sale sono modernissime e il suono è incredibile. Tornerò sicuramente!"</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="recensione-card">
                            <div class="d-flex align-items-center mb-3 gap-3">
                                <i class="bi bi-person-circle fs-2" style="color:var(--rosso);"></i>
                                <div>
                                    <div class="fw-bold">Giulia Bianchi</div>
                                    <div class="stelle">
                                        <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-half"></i>
                                    </div>
                                </div>
                            </div>
                            <p>"Personale gentilissimo e prezzi onesti. La sala IMAX è spettacolare, non delude mai!"</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="recensione-card">
                            <div class="d-flex align-items-center mb-3 gap-3">
                                <i class="bi bi-person-circle fs-2" style="color:var(--rosso);"></i>
                                <div>
                                    <div class="fw-bold">Luca Verdi</div>
                                    <div class="stelle">
                                        <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                    </div>
                                </div>
                            </div>
                            <p>"Il miglior cinema di Perugia. Programmazione aggiornata e poltrone comodissime!"</p>
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

    <!-- INFO -->
    <div class="sezione-info">
        <div class="container">
            <div class="row text-center g-4">
                <div class="col-md-4">
                    <i class="bi bi-camera-reels info-icona"></i>
                    <div class="info-titolo">2 Sedi</div>
                    <p class="info-testo">Sale moderne con schermo 4K e audio Dolby Atmos.</p>
                </div>
                <div class="col-md-4">
                    <i class="bi bi-cup-straw info-icona"></i>
                    <div class="info-titolo">Bar & Snack</div>
                    <p class="info-testo">Popcorn, bibite e tanto altro per il tuo film.</p>
                </div>
                <div class="col-md-4">
                    <i class="bi bi-geo-alt info-icona"></i>
                    <div class="info-titolo">Perugia, Italia</div>
                    <p class="info-testo">Due sedi comode nel cuore di Perugia.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- FOOTER -->
    <footer>
        <small>&copy; 2026 BucignoCinema — Tutti i diritti riservati</small>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>