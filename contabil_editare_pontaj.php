<?php
require_once("conectare.php");

if (!isset($_SESSION["user_id"]) || $_SESSION["user_id"] == "") {
    redirect("login.php");
}
check_access(basename(__FILE__));

if ($_SESSION['role'] != 'contabil') {
    redirect("admin_dashboard.php");
}

if (!isset($_GET['id'])) {
    header("Location: contabil_vizualizare_pontaj.php");
    exit();
}

$id = intval($_GET['id']);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nume_luna = htmlspecialchars($_POST['nume_luna']);
    $total_ore_lucratoare = htmlspecialchars($_POST['total_ore_lucratoare']);

    // Actualizarea datelor în baza de date
    $sql = "UPDATE pontaj SET nume_luna = ?, total_ore_lucratoare = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sii", $nume_luna, $total_ore_lucratoare, $id);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Luna de pontaj actualizată cu succes!";
        header("Location: contabil_vizualizare_pontaj.php");
        exit();
    } else {
        $_SESSION['message'] = "Eroare la actualizarea lunii de pontaj: " . $stmt->error;
        header("Location: contabil_editare_pontaj.php?id=$id");
        exit();
    }

    $stmt->close();
} else {
    // Preluăm datele lunii de pontaj din baza de date
    $sql = "SELECT * FROM pontaj WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $pontaj = $result->fetch_assoc();
    $stmt->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editare Pontaj</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container d-flex flex-column justify-content-center align-items-center vh-100">
        <div class="row">
            <form method="post" action="contabil_editare_pontaj.php?id=<?php echo $id; ?>">
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Nume</label>
                    <textarea class="form-control-sm" id="exampleFormControlTextarea1" rows="1" name="nume_luna"><?php echo htmlspecialchars($pontaj['nume_luna']); ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Total ore lucratoare</label>
                    <textarea class="form-control-sm" id="exampleFormControlTextarea1" rows="1" name="total_ore_lucratoare"><?php echo htmlspecialchars($pontaj['total_ore_lucratoare']); ?></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Actualizează</button>
            </form>
        </div>
    </div>
</body>
</html>
