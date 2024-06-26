<?php
require_once("conectare.php");

if (!isset($_SESSION["user_id"]) || $_SESSION["user_id"] == "") {
    redirect("login.php");
}
check_access(basename(__FILE__));

if ($_SESSION['role'] != 'admin') {
    redirect("contabil_dashboard.php");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nume_functie = htmlspecialchars($_POST['nume_functie']);
    $salariu = htmlspecialchars($_POST['salariu']);
    $perioada_contractuala = htmlspecialchars($_POST['perioada_contractuala']);
    $numar_angajati = htmlspecialchars($_POST['numar_angajati']);

    // Inserarea datelor în baza de date
    $sql = "INSERT INTO functii (nume_functie, salariu, perioada_contractuala, numar_angajati) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $nume_functie, $salariu, $perioada_contractuala, $numar_angajati);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Functie adăugată cu succes!";
        header("Location: admin_vizualizare_functii_lista.php");
        exit();
    } else {
        $_SESSION['message'] = "Eroare la adăugarea funcției: " . $stmt->error;
        header("Location: admin_adaugare_functie.php");
        exit();
    }

    $stmt->close();
}

$conn->close();
?>
