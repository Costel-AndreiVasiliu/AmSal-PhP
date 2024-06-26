<?php
require_once("conectare.php");

if (!isset($_SESSION["user_id"]) || $_SESSION["user_id"] == "") {
    redirect("login.php");
}

if ($_SESSION['role'] != 'contabil') {
    redirect("admin_dashboard.php");
}

if (!isset($_GET['id'])) {
    redirect("contabil_vizualizare_lista_ajutoare.php");
}
check_access(basename(__FILE__));

$id = intval($_GET['id']);

// Preluăm ajutorul contabil din baza de date
$sql = "SELECT * FROM ajutor_contabili WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$ajutor = $result->fetch_assoc();
$stmt->close();

// Preluăm toți angajații cu funcția de contabil
$sql = "SELECT id, nume, prenume FROM angajati WHERE functie = 'contabil'";
$result_angajati = $conn->query($sql);

include 'header_contabil.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editează Ajutor Contabil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container d-flex flex-column justify-content-center align-items-center vh-100">
        <div class="row">
            <form method="post" action="procesare_editare_ajutor.php">
                <input type="hidden" name="id" value="<?php echo $ajutor['id']; ?>">
                <div class="mb-3">
                    <label for="angajat_select" class="form-label">Angajat</label>
                    <select class="form-select" id="angajat_select" name="angajat_id" required>
                        <?php while ($row = $result_angajati->fetch_assoc()): ?>
                            <option value="<?php echo $row['id']; ?>" <?php if ($row['id'] == $ajutor['angajat_id']) echo 'selected'; ?>><?php echo htmlspecialchars($row['nume'] . ' ' . $row['prenume']); ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="tip_job" class="form-label">Tip job</label>
                    <textarea class="form-control-sm" id="tip_job" rows="1" name="tip_job"><?php echo htmlspecialchars($ajutor['tip_job']); ?></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Editează</button>
            </form>
        </div>
    </div>
    <?php include 'footer.php'; ?>
</body>
</html>
<?php
$conn->close();
?>
