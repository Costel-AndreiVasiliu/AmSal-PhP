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
    $id = intval($_POST['id']);
    $nume_functie = htmlspecialchars($_POST['nume_functie']);
    $salariu = htmlspecialchars($_POST['salariu']);
    $perioada_contractuala = htmlspecialchars($_POST['perioada_contractuala']);
    $numar_angajati = htmlspecialchars($_POST['numar_angajati']);

    // Actualizează datele în baza de date
    $sql = "UPDATE functii SET nume_functie=?, salariu=?, perioada_contractuala=?, numar_angajati=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssii", $nume_functie, $salariu, $perioada_contractuala, $numar_angajati, $id);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Functia a fost actualizată cu succes!";
        header("Location: admin_vizualizare_functii_lista.php");
        exit();
    } else {
        $_SESSION['message'] = "Eroare la actualizarea funcției: " . $stmt->error;
        header("Location: editare_functie.php?id=$id");
        exit();
    }

    $stmt->close();
}

$conn->close();
?>
