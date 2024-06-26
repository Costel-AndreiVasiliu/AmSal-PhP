<?php
require_once("conectare.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Determinăm tipul de utilizator (admin sau contabil)
    $tip_user_id = (strtolower($name) == 'admin') ? 1 : 2;

    // Inserarea utilizatorului în baza de date
    $sql = "INSERT INTO useri (name, email, password, tip_user_id) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $name, $email, $password, $tip_user_id);

    if ($stmt->execute()) {
        $user_id = $stmt->insert_id;

        // Adăugarea drepturilor pentru utilizator în funcție de tipul de utilizator
        $sql_rights = "INSERT INTO drepturi (IdPage, IdUser) VALUES (?, ?)";
        $stmt_rights = $conn->prepare($sql_rights);
        $stmt_rights->bind_param("ii", $idPage, $user_id);

        if ($tip_user_id == 1) { // Admin
            for ($idPage = 1; $idPage <= 12; $idPage++) {
                $stmt_rights->execute();
            }
        } else if ($tip_user_id == 2) { // Contabil
            $pages = [8, 9, 10, 11, 12]; // Paginile la care are acces contabilul
            foreach ($pages as $idPage) {
                $stmt_rights->execute();
            }
        }

        $stmt_rights->close();

        $_SESSION['message'] = "Utilizatorul a fost înregistrat cu succes!";
        header("Location: login.php");
        exit();
    } else {
        $_SESSION['message'] = "Eroare la înregistrare: " . $stmt->error;
        header("Location: register.php");
        exit();
    }

    $stmt->close();
    $conn->close();
}
?>
