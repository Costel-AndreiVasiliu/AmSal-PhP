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
    $id = intval($_POST['id']);
    $angajat_id = intval($_POST['angajat_id']);
    $tip_job = htmlspecialchars($_POST['tip_job']);

    // Actualizăm datele în baza de date
    $sql = "UPDATE ajutor_contabili SET angajat_id = ?, tip_job = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isi", $angajat_id, $tip_job, $id);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Ajutor contabil actualizat cu succes!";
        header("Location: contabil_vizualizare_lista_ajutoare.php");
        exit();
    } else {
        $_SESSION['message'] = "Eroare la actualizarea ajutorului contabil: " . $stmt->error;
        header("Location: contabil_editare_ajutor.php?id=$id");
        exit();
    }

    $stmt->close();
}

$conn->close();
?>
