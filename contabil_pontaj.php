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

// Preluăm toate lunile de pontaj din baza de date
$sql = "SELECT id, nume_luna FROM pontaj";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pontaj</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container d-flex flex-column justify-content-center align-items-center vh-100">
        <div class="row">
            <form method="post" action="contabil_vizualizare_pontaj.php">
                <select class="form-select" name="nume_luna" onchange="this.form.submit()">
                    <option value="" disabled selected>Selectează o lună</option>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <option value="<?php echo htmlspecialchars($row['nume_luna']); ?>"><?php echo htmlspecialchars($row['nume_luna']); ?></option>
                    <?php endwhile; ?>
                </select>
            </form>
        </div>
        <br><br>
        <div class="row">
            <a href="contabil_pontaj_adauga_luna.php"><button type="button" class="btn btn-success">Adaugă lună</button></a>
        </div>
        <br>
        <div class="row">
            <a href="contabil_vizualizare_pontaj.php"><button type="button" class="btn btn-primary">Vizualizare Pontaj</button></a>
        </div>
    </div>
    <?php include 'footer.php'; ?>
</body>
</html>
<?php
$conn->close();
?>
