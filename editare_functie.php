<?php
require_once("conectare.php");

if (!isset($_SESSION["user_id"]) || $_SESSION["user_id"] == "") {
    redirect("login.php");
}
check_access(basename(__FILE__));

if ($_SESSION['role'] != 'admin') {
    redirect("contabil_dashboard.php");
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "SELECT * FROM functii WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $functie = $result->fetch_assoc();
    $stmt->close();
} else {
    $_SESSION['message'] = "ID-ul funcției nu a fost specificat.";
    header("Location: admin_vizualizare_functii_lista.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editare Functie</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include 'header_admin.php'; // Încărcăm header-ul specific pentru admin ?>
    <div class="container d-flex flex-column justify-content-center align-items-center vh-100">
        <h1>Editare Functie</h1>
        <form action="procesare_editare_functie.php" method="post">
            <input type="hidden" name="id" value="<?php echo $functie['id']; ?>">
            <div class="mb-3">
                <label for="nume_functie" class="form-label">Nume functie</label>
                <textarea class="form-control-sm" id="nume_functie" rows="1" name="nume_functie" required><?php echo $functie['nume_functie']; ?></textarea>
            </div>
            <div class="mb-3">
                <label for="salariu" class="form-label">Salariu</label>
                <textarea class="form-control-sm" id="salariu" rows="1" name="salariu" required><?php echo $functie['salariu']; ?></textarea>
            </div>
            <div class="mb-3">
                <label for="perioada_contractuala" class="form-label">Perioada contractuala</label>
                <textarea class="form-control-sm" id="perioada_contractuala" rows="1" name="perioada_contractuala" required><?php echo $functie['perioada_contractuala']; ?></textarea>
            </div>
            <div class="mb-3">
                <label for="numar_angajati" class="form-label">Numar angajati</label>
                <textarea class="form-control-sm" id="numar_angajati" rows="1" name="numar_angajati" required><?php echo $functie['numar_angajati']; ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Editeaza</button>
        </form>
    </div>
    <?php include 'footer.php'; // Încărcăm footer-ul ?>
</body>
</html>
