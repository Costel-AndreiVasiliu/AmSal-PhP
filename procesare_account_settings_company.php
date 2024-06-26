<?php
require_once("conectare.php");

if (!isset($_SESSION["user_id"]) || $_SESSION["user_id"] == "") {
    redirect("login.php");
}
check_access(basename(__FILE__));

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $company_id = intval($_POST['company_id']);
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

    // Actualizăm datele companiei în baza de date
    $sql = "UPDATE firme SET nume=?, cif=?, reg_com=?, forma_juridica=?, banca=?, iban=?, adresa=?, localitate=?, judet=?, tara=?, capital_social=?, platitor_tva=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssssssssi", $nume, $cif, $reg_com, $forma_juridica, $banca, $iban, $adresa, $localitate, $judet, $tara, $capital_social, $platitor_tva, $company_id);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Informațiile companiei au fost actualizate cu succes!";
        header("Location: admin_account_settings.php?company_id=".$company_id);
        exit();
    } else {
        $_SESSION['message'] = "Eroare la actualizarea informațiilor companiei: " . $stmt->error;
        header("Location: admin_account_settings.php?company_id=".$company_id);
        exit();
    }

    $stmt->close();
}

$conn->close();
?>
