<?php
require_once("conectare.php");

if (!isset($_SESSION["user_id"]) || $_SESSION["user_id"] == "") {
    redirect("login.php");
}
check_access(basename(__FILE__));

$user_id = $_SESSION["user_id"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nume = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $current_password = htmlspecialchars($_POST['current_password']);
    $new_password = htmlspecialchars($_POST['new_password']);
    $new_password_confirmation = htmlspecialchars($_POST['new_password_confirmation']);

    // Verificăm dacă parola curentă este corectă
    $sql = "SELECT password FROM useri WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $stmt->close();

    if (password_verify($current_password, $user['password'])) {
        // Verificăm dacă noile parole se potrivesc
        if ($new_password === $new_password_confirmation) {
            // Actualizăm datele utilizatorului
            if (!empty($new_password)) {
                $new_password_hashed = password_hash($new_password, PASSWORD_DEFAULT);
                $sql_update = "UPDATE useri SET name = ?, email = ?, password = ? WHERE id = ?";
                $stmt_update = $conn->prepare($sql_update);
                $stmt_update->bind_param("sssi", $nume, $email, $new_password_hashed, $user_id);
            } else {
                $sql_update = "UPDATE useri SET name = ?, email = ? WHERE id = ?";
                $stmt_update = $conn->prepare($sql_update);
                $stmt_update->bind_param("ssi", $nume, $email, $user_id);
            }

            if ($stmt_update->execute()) {
                $_SESSION['message'] = "Profilul a fost actualizat cu succes!";
                // Actualizăm variabilele de sesiune
                $_SESSION['name'] = $nume;
                $_SESSION['email'] = $email;
                header("Location: admin_account_settings.php");
                exit();
            } else {
                $_SESSION['message'] = "Eroare la actualizarea profilului: " . $stmt_update->error;
                header("Location: admin_account_settings.php");
                exit();
            }

            $stmt_update->close();
        } else {
            $_SESSION['message'] = "Noile parole nu se potrivesc.";
            header("Location: admin_account_settings.php");
            exit();
        }
    } else {
        $_SESSION['message'] = "Parola curentă este incorectă.";
        header("Location: admin_account_settings.php");
        exit();
    }
}

$conn->close();
?>
