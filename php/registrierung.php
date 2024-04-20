<?php
session_start();
// Variablen definieren

$name="";
$vorname="";
$plz="";
$ort="";
$strasse="";
$email="";
$tel="";
$pw="";
$f=0;
$active=['','','','','active' ,''];

//Variablen setzten

if(isset($_POST['submit'])){

$name=htmlentities($_POST['name']);
$vorname=htmlentities($_POST['vorname']);
$plz=htmlentities($_POST['plz']);
$ort=htmlentities($_POST['ort']);
$strasse=htmlentities($_POST['strasse']);
$email=htmlentities($_POST['email']);
$tel=htmlentities($_POST['tel']);
$pw=htmlentities($_POST['pw']);

//Formatierung vorgeben
if(mb_strlen($name)>2 && mb_strlen($vorname)>2){

// in CSV speichern und formatieren

$csv="$name|$vorname|$plz|$ort|$strasse|$email|$tel|$pw\n";
echo $csv;
// File beim erstellen hier anlegen

$f=file_put_contents("../geheim/user.csv", $csv,FILE_APPEND|LOCK_EX);

// Error handling - ohne Einträge hat die Datei 0kb

if($f > 1) {
    $_SESSION["fehler"]="Daten gespeichert";
} else {
    $_SESSION["fehler"]="Daten nicht geschrieben";
}
} else {
    $_SESSION["fehler"]="Daten nicht geschrieben";
}
// Upload unf doppelte Einträge verhindern
header('Location:./login.php');
exit; // verlasse den Vorgang
}

// MENU
$noDisplay=['','','','','','' ];

// wenn es die variable vorhanden ist, bin ich angemeldet
if(isset($_SESSION['user'])){

  //login & registrierung ausblenden
  $noDisplay[4]='li_none';
  $noDisplay[5]='li_none';
}
else{
  $noDisplay[3]= 'li_none';
}

print_r($noDisplay);
?>
<!DOCTYPE html>
<html lang="en">

    <!doctype html>
    <html lang="en">
        
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>shop | sign in</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
            <link rel="stylesheet" href="./css/style.css">
        </head>
        
    <body>
    <?php
        require_once("./nav.php");
        ?>
        <div class="container">
    <main>
        <form action="" method="post">
            <h1 class="my-3">Sign in</h1>

            <div class="mb-3 row">
                <label for="name" class="form-label col-4">Name</label>
                <div class="col-8">
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="vorname" class="form-label col-4">Vorname</label>
                <div class="col-8">
                    <input type="text" class="form-control" id="vorname" name="vorname" required >
                </div>
            </div>
            <div class="mb-3 row">
                <label for="plz" class="form-label col-4">Plz</label>
                <div class="col-8">
                <input type="number" class="form-control" id="plz" name="plz" required>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="ort" class="form-label col-4">Ort</label>
                <div class="col-8">
                    <input type="text" class="form-control" id="ort" name="ort" required>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="strasse" class="form-label col-4">Straße & Hausnr.</label>
                <div class="col-8">
                    <input type="text" class="form-control" id="strasse" name="strasse" required>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="email" class="form-label col-4">E-Mail</label>
                <div class="col-8">
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="tel" class="form-label col-4">Tel.</label>
                <div class="col-8">
                <input type="number" class="form-control" id="tel" name="tel" required>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="pw" class="form-label col-4">Passwort</label>
                <div class="col-8">
                <input type="password" class="form-control" id="pw" name="pw" required>
                </div>
            </div>
            <div class="mb-3 row">
                <div class="col-4 p-3">         
                    <div class="col-4" id="fehler">
                        <?php
                                if (isset($_SESSION["fehler"])) {
                                    echo $_SESSION["fehler"];
                                    $_SESSION["fehler"] = "";
                                  }
                        ?>
                 
             </div>
            </div>
                <div class="col-8">
                    <button type="submit" class="btn btn-primary" name="submit">Sign in</button>
                </div>
            </div>
        </form>
    </main>
</div>
    <?php
        require_once("./footer.php");
        ?>


</body>

</html>