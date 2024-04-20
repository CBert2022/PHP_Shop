<?php
// zur nutzung von session variablen
session_start();
//import der funktion
require_once("../inc/fctAllg.php");
// deklarieren von benötigten vars
$datArr=[];
$datBestellung=[];
$gesSumme=0;
$tab="";
$active=['','','active','','' ,''];
//print_r($_SESSION["cart"]);
//import der csv mit den Daten
$datArr = file("../geheim/artikel.csv");

//Warenkorb löschen wenn btn gedrückt
if(isset($_GET['delcart'])){
    // Array wird auf leer gesetzt
    $_SESSION['cart']= [];
}

//Artikel löschen wenn btn gedrückt
if(isset($_GET['delcartid'])){
    // unset id = löschen
$id=$_GET['delcartid'];
unset($_SESSION['cart'][$id]);
}

// Warenkorb nur ausgeben, wenn er Artikel beinhaltet
if(isset($_SESSION['cart'])){
    
        print_r($_SESSION['cart']);

// Daten aus $-SESSION var extrahieren
foreach ($_SESSION["cart"] as $key => $value) {
    //ordnet jedem artikel eine id zu
    $id= $value['id'];
    //echo $id;
    // Datensatz trennen
    $arr=explode('|', $datArr[$id]);
    // gesamte Summe erfassen
    $gesSumme += $value["anz"] * $arr[1];
    $gesSumme = floatval($gesSumme);

    //zeige Titel, Preis, Bild, aktuelle Stückzahl
    //echo $arr[0]."|".$arr[1]."|".$arr[2]."|".$value["anz"]."<br><br>";
    // Spalte mit löschen btn plus id generierung
    $del="<a href=\"warenkorb.php?delcartid=$key\" class=\"button\" onclick=\"confirmDelete()\">X</a>";
    $datBestellung[]=$arr[0]."|".$arr[1]."|".$arr[2]."|".$value["anz"]."|".$del;
}



foreach ($datBestellung as $key => $value) {
    $arr=explode('|',$value );
      //Pfad und Größe angeben
      $arr[2] = '<img src="../img/' . $arr[2] . '" width="40" >';

          // vorm runden string in zahl umwandeln
    $arr[1] = floatval($arr[1]);

    // runden auf 2 dezimalstellen und ersetztem . durch ,
    $arr[1] = number_format($arr[1], 2, ',', '.');
    $arr[1] = '' . $arr[1] . '€';

    //Mach aus allen eintargen / keys wieder einen string getrennt mit |
    $datBestellung[$key] = implode('|', $arr);
}

//print_r($datBestellung);
$tab = makeTab($datBestellung, '|');
 }

 // Format für Summe anpassen
$gesSumme = number_format($gesSumme, 2, ',', '.');
$gesSumme = "Summe: ". $gesSumme.'€';

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

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
          * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-size: 10px;
        }

        td {
            padding: 10px;
            vertical-align: top;
        }

        img {
            object-fit: cover;
            border-radius: 5px;
        }

        .summe{
            display: flex;
            justify-content: end;
            font-weight: 900;
        }
    </style>
        <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <!doctype html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>shop | cart</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
            <link rel="stylesheet" href="../css/style.css">
    </head>

    <body>
        
    <?php
        require_once("./nav.php");
        ?>
        <main class="container">
            <h1 class="my-3">Warenkorb</h1>
            <div id="fehler">
        <?php
        if (isset($_SESSION["fehler"])) {
          echo $_SESSION["fehler"];
          $_SESSION["fehler"] = "";
        }
        ?>
      </div>
                <table class="table border border-light-subtle">
                        <?= $tab ?>
                    </table>
                    <div  class="d-flex flex-row-reverse justify-content-between align-items-center alert alert-light" role="alert">
                        <div class="fw-bold">
                            <?=$gesSumme  ?>

                        </div>
                        <a href="warenkorb.php?delcart=0" class="button btn btn-secondary my-2">Warenkorb löschen</a>
                </div>
        </main>
        <?php
        require_once("./footer.php");
        //echo dirname(__FILE__);
        ?>
        <script>
        function confirmDelete() {
            return confirm("Wirklich löschen?");
        }
    </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>
</body>

</html>