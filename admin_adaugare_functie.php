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
    <title>Admin - Adaugare Functie</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container d-flex flex-column justify-content-center align-items-center vh-100">
        <h1>Adaugare Functie</h1>
        <form action="procesare_adaugare_functie.php" method="post">
            <div class="mb-3">
                <label for="nume_functie" class="form-label">Nume functie</label>
                <textarea class="form-control-sm" id="nume_functie" rows="1" name="nume_functie" required></textarea>
            </div>
            <div class="mb-3">
                <label for="salariu" class="form-label">Salariu</label>
                <textarea class="form-control-sm" id="salariu" rows="1" name="salariu" required></textarea>
            </div>
            <div class="mb-3">
                <label for="perioada_contractuala" class="form-label">Perioada contractuala</label>
                <textarea class="form-control-sm" id="perioada_contractuala" rows="1" name="perioada_contractuala" required></textarea>
            </div>
            <div class="mb-3">
                <label for="numar_angajati" class="form-label">Numar angajati</label>
                <textarea class="form-control-sm" id="numar_angajati" rows="1" name="numar_angajati" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Adauga</button>
        </form>
    </div>
    <?php include 'footer.php'; // Încărcăm footer-ul ?>
</body>
</html>
