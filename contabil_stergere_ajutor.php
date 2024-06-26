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
    redirect("contabil_vizualizare_lista_ajutoare.php");
}

$id = intval($_GET['id']);

// Ștergem ajutorul contabil din baza de date
$sql = "DELETE FROM ajutor_contabili WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    $_SESSION['message'] = "Ajutor contabil șters cu succes!";
} else {
    $_SESSION['message'] = "Eroare la ștergerea ajutorului contabil: " . $stmt->error;
}

$stmt->close();
$conn->close();

header("Location: contabil_vizualizare_lista_ajutoare.php");
exit();
?>
