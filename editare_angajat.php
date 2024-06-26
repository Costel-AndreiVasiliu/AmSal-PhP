<?php
require_once("conectare.php");

if (!isset($_SESSION["user_id"]) || $_SESSION["user_id"] == "") {
    redirect("login.php");
}

if ($_SESSION['role'] != 'admin') {
    redirect("contabil_dashboard.php");
}
check_access(basename(__FILE__));

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "SELECT * FROM angajati WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $angajat = $result->fetch_assoc();
    $stmt->close();
} else {
    $_SESSION['message'] = "ID-ul angajatului nu a fost specificat.";
    header("Location: admin_vizualizare_angajati_lista.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editare Angajat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include 'header_admin.php'; // Încărcăm header-ul specific pentru admin ?>
    <div class="container d-flex flex-column justify-content-center align-items-center vh-100">
        <h1>Editare Angajat</h1>
        <form action="procesare_editare_angajat.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $angajat['id']; ?>">
            <div class="mb-3">
                <label for="nume_angajat" class="form-label">Nume</label>
                <textarea class="form-control-sm" id="nume_angajat" rows="1" name="nume_angajat" required><?php echo $angajat['nume']; ?></textarea>
            </div>
            <div class="mb-3">
                <label for="prenume_angajat" class="form-label">Prenume</label>
                <textarea class="form-control-sm" id="prenume_angajat" rows="1" name="prenume_angajat" required><?php echo $angajat['prenume']; ?></textarea>
            </div>
            <div class="mb-3">
                <label for="numar_telefon" class="form-label">Numar telefon</label>
                <textarea class="form-control-sm" id="numar_telefon" rows="1" name="numar_telefon" required><?php echo $angajat['numar_telefon']; ?></textarea>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Adresa email</label>
                <input type="email" class="form-control-sm" id="email" aria-describedby="emailHelp" name="email" required value="<?php echo $angajat['email']; ?>">
            </div>
            <div class="mb-3">
                <label for="functie_angajat" class="form-label">Functie</label>
                <textarea class="form-control-sm" id="functie_angajat" rows="1" name="functie_angajat" required><?php echo $angajat['functie']; ?></textarea>
            </div>
            <div class="mb-3">
                <label for="salariu_angajat" class="form-label">Salariu</label>
                <textarea class="form-control-sm" id="salariu_angajat" rows="1" name="salariu_angajat" required><?php echo $angajat['salariu']; ?></textarea>
            </div>
            <div class="input-group mb-3">
                <input type="file" accept="image/jpeg" class="form-control-sm" id="buletin" name="buletin">
            </div>
            <button type="submit" class="btn btn-primary">Editeaza</button>
        </form>
    </div>
    <?php include 'footer.php'; // Încărcăm footer-ul ?>
</body>
</html>
