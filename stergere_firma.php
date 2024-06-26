<?php
require_once("conectare.php");

if (!isset($_SESSION["user_id"]) || $_SESSION["user_id"] == "") {
    redirect("login.php");
}

if ($_SESSION['role'] != 'admin') {
    redirect("contabil_dashboard.php");
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "DELETE FROM firme WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Firma a fost ștersă cu succes.";
    } else {
        $_SESSION['message'] = "Eroare la ștergerea firmei: " . $stmt->error;
    }

    $stmt->close();
    header("Location: admin_vizualizare_firme_lista.php");
    exit();
} else {
    $_SESSION['message'] = "ID-ul firmei nu a fost specificat.";
    header("Location: admin_vizualizare_firme_lista.php");
    exit();
}

$conn->close();
?>
