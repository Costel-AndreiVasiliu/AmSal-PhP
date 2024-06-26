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
    $nume = htmlspecialchars($_POST['nume_contabil']);
    $prenume = htmlspecialchars($_POST['prenume_contabil']);
    $numar_telefon = htmlspecialchars($_POST['numar_telefon']);
    $email = htmlspecialchars($_POST['email']);
    $functie = htmlspecialchars($_POST['functie_contabil']);
    $salariu = htmlspecialchars($_POST['salariu_contabil']);
    $buletin = $_FILES['buletin'];

    if (!empty($buletin['name'])) {
        // Validare și încărcare fișier
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($buletin["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Verifică dacă fișierul este o imagine
        $check = getimagesize($buletin["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            $_SESSION['message'] = "Fișierul nu este o imagine.";
            $uploadOk = 0;
        }

        // Verifică dimensiunea fișierului
        if ($buletin["size"] > 500000) {
            $_SESSION['message'] = "Fișierul este prea mare.";
            $uploadOk = 0;
        }

        // Permite doar anumite formate de fișiere
        if ($imageFileType != "jpg" && $imageFileType != "jpeg") {
            $_SESSION['message'] = "Doar fișierele JPG și JPEG sunt permise.";
            $uploadOk = 0;
        }

        // Verifică dacă $uploadOk este setat la 0 din cauza unei erori
        if ($uploadOk == 0) {
            $_SESSION['message'] = "Fișierul nu a fost încărcat.";
            header("Location: editare_contabil.php?id=$id");
            exit();
        } else {
            // Dacă totul este în regulă, încearcă să încarci fișierul
            if (move_uploaded_file($buletin["tmp_name"], $target_file)) {
                // Actualizează datele și calea fișierului în baza de date
                $sql = "UPDATE contabili SET nume=?, prenume=?, numar_telefon=?, email=?, functie=?, salariu=?, buletin=? WHERE id=?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sssssssi", $nume, $prenume, $numar_telefon, $email, $functie, $salariu, $target_file, $id);
            } else {
                $_SESSION['message'] = "Eroare la încărcarea fișierului.";
                header("Location: editare_contabil.php?id=$id");
                exit();
            }
        }
    } else {
        // Actualizează datele fără a schimba fișierul
        $sql = "UPDATE contabili SET nume=?, prenume=?, numar_telefon=?, email=?, functie=?, salariu=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssi", $nume, $prenume, $numar_telefon, $email, $functie, $salariu, $id);
    }

    if ($stmt->execute()) {
        $_SESSION['message'] = "Contabilul a fost actualizat cu succes!";
        header("Location: admin_vizualizare_contabili_lista.php");
        exit();
    } else {
        $_SESSION['message'] = "Eroare la actualizarea contabilului: " . $stmt->error;
        header("Location: editare_contabil.php?id=$id");
        exit();
    }

    $stmt->close();
}

$conn->close();
?>
