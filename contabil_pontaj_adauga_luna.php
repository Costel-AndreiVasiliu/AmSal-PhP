<?php
require_once("conectare.php");

if (!isset($_SESSION["user_id"]) || $_SESSION["user_id"] == "") {
    redirect("login.php");
}

if ($_SESSION['role'] != 'contabil') {
    redirect("admin_dashboard.php");
}
check_access(basename(__FILE__));

include 'header_contabil.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adaugă Lună de Pontaj</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container d-flex flex-column justify-content-center align-items-center vh-100">
        <div class="row">
            <form method="post" action="procesare_adaugare_pontaj.php">
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Nume Lună</label>
                    <textarea class="form-control-sm" id="exampleFormControlTextarea1" rows="1" name="nume_luna"></textarea>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Total Ore Lucrătoare</label>
                    <textarea class="form-control-sm" id="exampleFormControlTextarea1" rows="1" name="total_ore_lucratoare"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Adaugă</button>
            </form>
        </div>
    </div>
    <?php include 'footer.php'; ?>
</body>
</html>
