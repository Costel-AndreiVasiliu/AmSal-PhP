<?php
require_once("conectare.php");

if (!isset($_SESSION["user_id"]) || $_SESSION["user_id"] == "") {
    redirect("login.php");
}

if ($_SESSION['role'] != 'admin') {
    redirect("contabil_dashboard.php");
}
check_access(basename(__FILE__));

include 'header_admin.php'; // Încărcăm header-ul specific pentru admin
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Adaugare Angajat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container d-flex flex-column justify-content-center align-items-center vh-100">
        <div class="row">
            <form action="procesare_adaugare_angajat.php" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="nume_angajat" class="form-label">Nume</label>
                    <textarea class="form-control-sm" id="nume_angajat" rows="1" name="nume_angajat" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="prenume_angajat" class="form-label">Prenume</label>
                    <textarea class="form-control-sm" id="prenume_angajat" rows="1" name="prenume_angajat" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="prenume_angajat" class="form-label">CNP</label>
                    <textarea class="form-control-sm" id="prenume_angajat" rows="1" name="cnp" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="numar_telefon" class="form-label">Numar telefon</label>
                    <textarea class="form-control-sm" id="numar_telefon" rows="1" name="numar_telefon" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Adresa email</label>
                    <input type="email" class="form-control-sm" id="email" aria-describedby="emailHelp" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="functie_angajat" class="form-label">Functie</label>
                    <textarea class="form-control-sm" id="functie_angajat" rows="1" name="functie_angajat" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="salariu_angajat" class="form-label">Salariu</label>
                    <textarea class="form-control-sm" id="salariu_angajat" rows="1" name="salariu_angajat" required></textarea>
                </div>
                <div class="input-group mb-3">
                    <input type="file" accept="image/jpeg" class="form-control-sm" id="buletin" name="buletin" required>
                </div>
                <button type="submit" class="btn btn-primary">Adauga</button>
            </form>
        </div>
    </div>
    <?php include 'footer.php'; // Încărcăm footer-ul ?>
</body>
</html>
