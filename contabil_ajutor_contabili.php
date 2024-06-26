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

// Preluăm toți angajații cu funcția de contabil
$sql = "SELECT id, nume, prenume FROM angajati WHERE functie = 'contabil'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajutor Contabili</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container d-flex flex-column justify-content-center align-items-center vh-100">
        <div class="row">
            <form method="post" action="procesare_ajutor_contabili.php">
                <div class="mb-3">
                    <label for="angajat_select" class="form-label">Contabil</label>
                    <select class="form-select" id="angajat_select" name="angajat_id" required>
                        <option value="" disabled selected>Selectează un contabil</option>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <option value="<?php echo $row['id']; ?>"><?php echo htmlspecialchars($row['nume'] . ' ' . $row['prenume']); ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="tip_job" class="form-label">Tip job</label>
                    <textarea class="form-control-sm" id="tip_job" rows="1" name="tip_job"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Adaugă</button>
            </form>
        </div>
    </div>
    <?php include 'footer.php'; ?>
</body>
</html>
<?php
$conn->close();
?>
