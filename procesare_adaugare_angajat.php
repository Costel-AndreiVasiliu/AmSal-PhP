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
    $nume = htmlspecialchars($_POST['nume_angajat']);
    $prenume = htmlspecialchars($_POST['prenume_angajat']);
    $cnp = htmlspecialchars($_POST['cnp']);
    $numar_telefon = htmlspecialchars($_POST['numar_telefon']);
    $email = htmlspecialchars($_POST['email']);
    $functie = htmlspecialchars($_POST['functie_angajat']);
    $salariu = htmlspecialchars($_POST['salariu_angajat']);
    $buletin = $_FILES['buletin'];

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
        header("Location: admin_adaugare_angajat.php");
        exit();
    } else {
        // Dacă totul este în regulă, încearcă să încarci fișierul
        if (move_uploaded_file($buletin["tmp_name"], $target_file)) {
            // Inserarea datelor în baza de date
            $sql = "INSERT INTO angajati (nume, prenume, numar_telefon, email, functie, salariu, buletin, cnp) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssssssss", $nume, $prenume, $numar_telefon, $email, $functie, $salariu, $target_file, $cnp);

            if ($stmt->execute()) {
                $_SESSION['message'] = "Angajat adăugat cu succes!";
                header("Location: admin_vizualizare_angajati_lista.php");
                exit();
            } else {
                $_SESSION['message'] = "Eroare la adăugarea angajatului: " . $stmt->error;
                header("Location: admin_adaugare_angajat.php");
                exit();
            }

            $stmt->close();
        } else {
            $_SESSION['message'] = "Eroare la încărcarea fișierului.";
            header("Location: admin_adaugare_angajat.php");
            exit();
        }
    }
}

$conn->close();
?>
