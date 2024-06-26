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

    // Inserarea datelor în baza de date
    $sql = "INSERT INTO firme (nume, cif, reg_com, forma_juridica, banca, iban, adresa, localitate, judet, tara, capital_social, platitor_tva) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssssssss", $nume, $cif, $reg_com, $forma_juridica, $banca, $iban, $adresa, $localitate, $judet, $tara, $capital_social, $platitor_tva);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Firma adăugată cu succes!";
        header("Location: admin_vizualizare_firme_lista.php");
        exit();
    } else {
        $_SESSION['message'] = "Eroare la adăugarea firmei: " . $stmt->error;
        header("Location: admin_adaugare_firma.php");
        exit();
    }

    $stmt->close();
}

$conn->close();
?>
