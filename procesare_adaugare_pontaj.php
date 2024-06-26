<?php
require_once("conectare.php");

if (!isset($_SESSION["user_id"]) || $_SESSION["user_id"] == "") {
    redirect("login.php");
}
check_access(basename(__FILE__));


if ($_SESSION['role'] != 'contabil') {
    redirect("admin_dashboard.php");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nume_luna = htmlspecialchars($_POST['nume_luna']);
    $total_ore_lucratoare = htmlspecialchars($_POST['total_ore_lucratoare']);

    // Inserarea datelor în baza de date
    $sql = "INSERT INTO pontaj (nume_luna, total_ore_lucratoare) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $nume_luna, $total_ore_lucratoare);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Luna de pontaj adăugată cu succes!";
        header("Location: contabil_vizualizare_pontaj.php");
        exit();
    } else {
        $_SESSION['message'] = "Eroare la adăugarea lunii de pontaj: " . $stmt->error;
        header("Location: contabil_pontaj_adauga_luna.php");
        exit();
    }

    $stmt->close();
}

$conn->close();
?>
