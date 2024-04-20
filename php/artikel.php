<?php
session_start(); 

// Variablen definieren
$name = "";
$preis= 0;
$bild="";
$beschreibung = "";
$f=0;
$active=['','','','active','' ,''];

//Variablen setzten

if(isset($_POST['submit'])){
$name=htmlentities($_POST['name']);
  // Ersetze Kommas durch Punkte
$preis = htmlentities($_POST['preis']);
// mögliches komma durch . ersetzen
$preis=str_replace(",",'.',$preis);
//$bild=$_POST['bild'];
// Beschreibung soll in ein Feld:
$beschreibung=htmlentities($_POST['beschreibung']);
//html Zeilenumbruch sichtbar machen
$beschreibung=nl2br($beschreibung);
//Zeilenumbrüche entfernen
$beschreibung=str_replace("\n",'',$beschreibung);
$beschreibung=str_replace("\r",'',$beschreibung);

// Upload
print_r($_FILES);
// Dateiendung holen
$x = pathinfo($_FILES['bild']['name'], PATHINFO_EXTENSION);
// Umwandeln in Kleinbuchstaben
$x=strtolower($x);
// strlen = string länge
if(strlen($name) >3 && strlen($preis)>0&& strlen($_FILES['bild']['size'])> 0){

// Prüfen ob korrektes Datenformat
if($x == 'jpg' || $x == 'png' || $x == 'gif' || $x == 'jpeg'){
    $bild = uniqid($_FILES['bild']['name']) . '.' . $x;
    // Schiebe Bild in Verzeichnis
    move_uploaded_file($_FILES['bild']['tmp_name'],'../img/'.$bild);
};
$csv="$name|$preis|$bild|$beschreibung\n";

$f=file_put_contents("../geheim/artikel.csv", $csv,FILE_APPEND|LOCK_EX);
if($f > 1) {
    $_SESSION["fehler"]="Daten gespeichert";
} else {
    $_SESSION["fehler"]="Daten nicht geschrieben";
}
   header('Location:./artikel.php');
   exit; // verlasse den Vorgang
}
};

//MENU
$noDisplay=['','','','','','' ];

// wenn es die variable vorhanden ist, bin ich angemeldet
if(isset($_SESSION['user'])){

  //login & registrierung ausblenden
  $noDisplay[4]='li_none';
  $noDisplay[5]='li_none';
}
else{
    $noDisplay[3]= 'li_none';
    // wenn nicht eingeloggt springe auf
    header('Location:./login.php');
    exit; // verlasse den Vorgang
}

print_r($noDisplay);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .success {
            color: green;
            font-size: 12px;
        
        }

        .error {
            color: red;
        }
    </style>
</head>

<body>
    <!doctype html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Bootstrap demo</title>
        <link rel="stylesheet" href="./css/style.css">
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
        <form action="" method="post" enctype="multipart/form-data">
            <h1 class="my-3">Neuen Artikel erfassen</h1>

            <div class="mb-3 row">
                <label for="name" class="form-label col-4">Name</label>
                <div class="col-8">
                    <input type="text" class="form-control" id="name" name="name">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="preis" class="form-label col-4">Preis</label>
                <div class="col-8">
                    <input type="text" class="form-control" id="preis" name="preis">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="bild" class="form-label col-4">Bild</label>
                <div class="col-8">
                <input type="file" name="bild" id="bild" accept="image/gif,image/jpeg,image/png">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="beschreibung" class="form-label col-4">Beschreibung</label>
                <div class="col-8">
                    <textarea class="form-control" id="floatingTextarea" name="beschreibung"></textarea>
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
                    <button type="submit" class="btn btn-primary" name="submit">Eintragen</button>
                </div>
            </div>
        </form>
    </main>
    <?php
        require_once("./footer.php");
        ?>

</body>

</html>