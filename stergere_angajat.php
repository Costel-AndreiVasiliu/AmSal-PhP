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
    $sql = "DELETE FROM angajati WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Angajatul a fost șters cu succes.";
    } else {
        $_SESSION['message'] = "Eroare la ștergerea angajatului: " . $stmt->error;
    }

    $stmt->close();
    header("Location: admin_vizualizare_angajati_lista.php");
    exit();
} else {
    $_SESSION['message'] = "ID-ul angajatului nu a fost specificat.";
    header("Location: admin_vizualizare_angajati_lista.php");
    exit();
}

$conn->close();
?>
