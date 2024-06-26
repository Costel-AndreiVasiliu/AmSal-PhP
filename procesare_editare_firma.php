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
    $nume = htmlspecialchars($_POST['Company']);
    $cif = htmlspecialchars($_POST['CIF']);
    $reg_com = htmlspecialchars($_POST['Register']);
    $forma_juridica = htmlspecialchars($_POST['Legal_form']);
    $banca = htmlspecialchars($_POST['Bank']);
    $iban = htmlspecialchars($_POST['IBAN']);
    $adresa = htmlspecialchars($_POST['Address']);
    $localitate = htmlspecialchars($_POST['Locality']);
    $judet = htmlspecialchars($_POST['County']);
    $tara = htmlspecialchars($_POST['Country']);
    $capital_social = htmlspecialchars($_POST['Social']);
    $platitor_tva = htmlspecialchars($_POST['VAT_Payer']);

    // Actualizează datele în baza de date
    $sql = "UPDATE firme SET nume=?, cif=?, reg_com=?, forma_juridica=?, banca=?, iban=?, adresa=?, localitate=?, judet=?, tara=?, capital_social=?, platitor_tva=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssssssssi", $nume, $cif, $reg_com, $forma_juridica, $banca, $iban, $adresa, $localitate, $judet, $tara, $capital_social, $platitor_tva, $id);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Firma a fost actualizată cu succes!";
        header("Location: admin_vizualizare_firme_lista.php");
        exit();
    } else {
        $_SESSION['message'] = "Eroare la actualizarea firmei: " . $stmt->error;
        header("Location: editare_firma.php?id=$id");
        exit();
    }

    $stmt->close();
}

$conn->close();
?>
