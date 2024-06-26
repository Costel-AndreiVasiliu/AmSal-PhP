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

// Ștergerea lunii de pontaj din baza de date
$sql = "DELETE FROM pontaj WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    $_SESSION['message'] = "Luna de pontaj ștearsă cu succes!";
} else {
    $_SESSION['message'] = "Eroare la ștergerea lunii de pontaj: " . $stmt->error;
}

$stmt->close();
$conn->close();

header("Location: contabil_vizualizare_pontaj.php");
exit();
?>
