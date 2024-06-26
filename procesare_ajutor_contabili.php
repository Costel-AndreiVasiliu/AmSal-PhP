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
    $angajat_id = intval($_POST['angajat_id']);
    $tip_job = htmlspecialchars($_POST['tip_job']);

    // Inserarea datelor în baza de date
    $sql = "INSERT INTO ajutor_contabili (angajat_id, tip_job) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $angajat_id, $tip_job);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Ajutor contabil adăugat cu succes!";
        header("Location: contabil_vizualizare_lista_ajutoare.php");
        exit();
    } else {
        $_SESSION['message'] = "Eroare la adăugarea ajutorului contabil: " . $stmt->error;
        header("Location: contabil_ajutor_contabili.php");
        exit();
    }

    $stmt->close();
}

$conn->close();
?>
