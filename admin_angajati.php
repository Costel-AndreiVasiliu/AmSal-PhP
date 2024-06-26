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
    <title>Admin - Gestionare Angajati</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container d-flex flex-column justify-content-center align-items-center vh-100">
        <div class="row">
            <a href="admin_adaugare_angajat.php"><button type="button" class="btn btn-success">Adauga angajat</button></a>
            <a href="admin_vizualizare_angajati_lista.php"><button type="button" class="btn btn-warning">Vizualizare lista angajati</button></a>
        </div>
    </div>

    <?php include 'footer.php'; // Încărcăm footer-ul ?>
</body>
</html>
