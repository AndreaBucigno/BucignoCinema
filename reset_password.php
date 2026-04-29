<?php
session_start();
require_once __DIR__ . '/config/db.php';
require_once __DIR__ . '/Handler/HandlerMail.php';

function generateRandomPassword($length = 12)
{
    $sets = [
        'ABCDEFGHJKLMNPQRSTUVWXYZ',
        'abcdefghijkmnopqrstuvwxyz',
        '23456789',
        '!@#$%^&*()-_=+'
    ];

    $password = '';
    foreach ($sets as $set) {
        $password .= $set[random_int(0, strlen($set) - 1)];
    }

    $all = implode('', $sets);
    for ($i = count($sets); $i < $length; $i++) {
        $password .= $all[random_int(0, strlen($all) - 1)];
    }

    return str_shuffle($password);
}

$message      = '';
$message_type = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

    if ($email) {
        // Cerca l'utente nel DB
        $stmt = $pdo->prepare("SELECT * FROM utenti WHERE email = :email");
        $stmt->execute([':email' => $email]);
        $utente = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($utente) {
            $newPassword = generateRandomPassword(12);
            try {
                $update = $pdo->prepare("UPDATE utenti SET password = :password, password_hash = :password_hash WHERE id = :id");
                $update->execute([
                    ':password'      => $newPassword,
                    ':password_hash' => password_hash($newPassword, PASSWORD_DEFAULT),
                    ':id'            => $utente['id'],
                ]);

                $mail = getMailerInstance();

                if ($mail) {
                    try {
                        $mail->addAddress($email, $utente['nome']);
                        $mail->isHTML(true);
                        $mail->Subject = 'BucignoCinema — Recupero Password';
                        $mail->Body = "
                            <div style='font-family:sans-serif;max-width:480px;margin:auto;'>
                                <h2 style='color:#b02a37;'>BucignoCinema</h2>
                                <p>Ciao <strong>{$utente['nome']}</strong>,</p>
                                <p>Hai richiesto il recupero della tua password.</p>
                                <p>Le tue nuove credenziali di accesso sono:</p>
                                <table style='border:1px solid #ddd;padding:12px;border-radius:6px;width:100%;'>
                                    <tr><td><strong>Email:</strong></td><td>{$utente['email']}</td></tr>
                                    <tr><td><strong>Password:</strong></td><td>{$newPassword}</td></tr>
                                </table>
                                <p style='margin-top:16px;color:#888;font-size:12px;'>
                                    Se non hai richiesto questo recupero, ignora questa email.
                                </p>
                            </div>
                        ";
                        $mail->send();
                        $message      = 'Email inviata! Controlla la tua casella di posta.';
                        $message_type = 'success';
                        appLog(10, $message);
                    } catch (\Exception $e) {
                        $message      = 'Errore durante l\'invio: ' . $e->getMessage();
                        $message_type = 'danger';
                        appLog(40, $message);
                    }
                } else {
                    $message      = 'Server di posta non configurato.';
                    $message_type = 'danger';
                }
            } catch (\Exception $e) {
                $message      = 'Errore durante la generazione della password.';
                $message_type = 'danger';
                appLog(40, $e->getMessage());
            }
        } else {
            // Messaggio generico per sicurezza
            $message      = 'Se l\'email è registrata, riceverai le istruzioni a breve.';
            $message_type = 'info';
        }
    } else {
        $message      = 'Inserisci un indirizzo email valido.';
        $message_type = 'danger';
    }
}
?>
<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Password Dimenticata — BucignoCinema</title>
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
                    <p class="text-muted small">Inserisci la tua email e ti invieremo la password.</p>
                </div>

                <?php if ($message): ?>
                    <div class="alert alert-<?= $message_type ?> py-2 small">
                        <?= htmlspecialchars($message) ?>
                    </div>
                <?php endif; ?>

                <form action="reset_password.php" method="POST">
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" placeholder="nome@email.it" required />
                    </div>
                    <button class="btn btn-danger w-100 mb-3" type="submit">
                        <i class="bi bi-envelope me-1"></i>Invia Password
                    </button>
                </form>

                <div class="text-center mt-2">
                    <a href="login.php" class="small text-muted">
                        <i class="bi bi-arrow-left me-1"></i>Torna al login
                    </a>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/BucignoCinema/assets/js/script.js"></script>
</body>

</html>