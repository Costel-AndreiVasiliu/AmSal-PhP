<?php
require_once("conectare.php");

if (!isset($_SESSION["user_id"]) || $_SESSION["user_id"] == "") {
    redirect("login.php");
}
check_access(basename(__FILE__));

include 'header_contabil.php';
?>

<div class="container d-flex flex-column justify-content-center align-items-center vh-100"> 
    <div class="row">
        <div class="col-12">
            Salutare, <?php echo htmlspecialchars($_SESSION['name']); ?>!
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
