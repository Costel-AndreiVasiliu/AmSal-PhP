<?php
require_once("conectare.php");

if (!isset($_SESSION["user_id"]) || $_SESSION["user_id"] == "") {
    redirect("login.php");
}

if ($_SESSION['role'] != 'admin') {
    redirect("contabil_dashboard.php");
}
check_access(basename(__FILE__));

include 'header_admin.php'; // Încărcăm header-ul specific pentru admin
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Adaugare Firma</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container d-flex flex-column justify-content-center align-items-center vh-100">
    <h1>Adaugare Firma</h1>
    <div class="row">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title text-center">Company</h5>
              <p></p>
              <p></p>
              <form action="procesare_adaugare_firma.php" method="post">
    <div class="container_1">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="form-group">
                    <h3 class="small">Company's Name</h3>
                    <input type="text" class="form-control" placeholder="Fill in here" name="Company" value="">
                </div>
            </div>
        </div>
    </div>
    <p></p>
    <div class="container_1">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="form-group">
                    <h3 class="small">CIF</h3>
                    <input type="text" class="form-control" placeholder="RO########" name="CIF" pattern="RO\d{8}" title="Enter a valid CIF starting with RO and followed by 8 digits." value="">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <h3 class="small">Trade Reg</h3>
                    <input type="text" class="form-control" placeholder="J/C/F##/####/####" name="Register" pattern="[JCF]\d{2}/\d{4}/\d{4}" title="Enter a valid TradeReg starting with J, C or F followed by 11 digits." value="">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <h3 class="small" for="legal_form">Legal Form:</h3>
                    <select class="form-control" id="legal_form" name="Legal_form">
                        <option value="PFA" disabled selected>Choose the legal form</option>
                        <option value="SRL">SRL</option>
                        <option value="PFA">PFA</option>
                        <option value="II">II</option>
                        <option value="IF">IF</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <p></p>
    <div class="container_1">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="form-group">
                    <h3 class="small">Bank</h3>
                    <input type="text" class="form-control" placeholder="Fill in here" name="Bank" value="">
                </div>
            </div>
            <div class="col-md-5">
                <div class="form-group">
                    <h3 class="small">IBAN</h3>
                    <input type="text" class="form-control" placeholder="Fill in here" name="IBAN" value="">
                </div>
            </div>
        </div>
    </div>
    <p></p>
    <div class="container_1">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="form-group">
                    <h3 class="small">Address</h3>
                    <input type="text" class="form-control" placeholder="Fill in here" name="Address" value="">
                </div>
            </div>
            <div class="col-md-5">
                <div class="form-group">
                    <h3 class="small">Locality</h3>
                    <input type="text" class="form-control" placeholder="Fill in here" name="Locality" value="">
                </div>
            </div>
        </div>
        <p></p>
        <div class="container_1">
            <div class="row justify-content-center">
                <div class="col-md-5">
                    <div class="form-group">
                        <h3 class="small">County</h3>
                        <input type="text" class="form-control" placeholder="Fill in here" name="County" value="">
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group">
                        <h3 class="small">Country</h3>
                        <input type="text" class="form-control" placeholder="Fill in here" name="Country" value="">
                    </div>
                </div>
            </div>
        </div>
        <p></p>
        <div class="container_1">
            <div class="row justify-content-center">
                <div class="col-md-5">
                    <div class="form-group">
                        <h3 class="small">Social Capital</h3>
                        <input type="text" class="form-control" placeholder="Fill in here" name="Social" value="">
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group">
                        <h3 class="small">VAT payer?</h3>
                        <select class="form-control" name="VAT_Payer">
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select>
                    </div>
                </div>
            </div>
            <p></p>
        </div>
        <div>
            <button type="submit" class="btn btn-primary">Adauga firma</button>
        </div>
    </form>
</div>

          </div>
        </div>

      </div>
    </div>
  </div>
  </div>
  </div>
    <?php include 'footer.php'; // Încărcăm footer-ul ?>
</body>
</html>
