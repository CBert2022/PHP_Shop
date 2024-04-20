<?php
session_start();
//import der funktion
require_once("../inc/fctAllg.php");

$datArr = [];
$tab = "";
$active=['','active','','','','' ];

// leg session var an, wenn es noch keine gibt
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
};

// Liest Inhalt der datei
$datArr = file("../geheim/artikel.csv");

// Tabelle
foreach ($datArr as $key => $value) {

    //zerscheidet value bei den |,Bild ist in [2]
    $arr = explode("|", $value);

    //Pfad und Größe angeben
    $arr[2] = '<img src="../img/' . $arr[2] . '" width="100" >';

    // vorm runden string in zahl umwandeln
    $arr[1] = floatval($arr[1]);

    // runden auf 2 dezimalstellen und ersetztem . durch ,
    $arr[1] = number_format($arr[1], 2, ',', '.');
    $arr[1] = '' . $arr[1] . '€';

    //hinzugügen der bestelloption mit indivuduellen namen und ids
    $bestellung = "|<input type=\"text\" class=\"form-control\" name=\"i$key\" id=\"i$key\" ><button class=\"btn btn-primary my-2\" name=\"b\">Bestellen</button>";



    //Mach aus allen eintargen / keys wieder einen string getrennt mit |
    $datArr[$key] = implode('|', $arr) . $bestellung;
};

// Auswertung Bestellung
if (isset($_GET['b'])) {
    //print_r($_GET);
    foreach ($_GET as $key => $value) {

        $artikelImCart = -1;
        
        if ($value > 0) {
            // variable muss in php mit buchstaben starten, nun schneiden wir den weg
            $key = substr($key, 1);
            //echo $key . "-" . $value;
            //print_r(($datArr[$key]));

            //Logik Stückzahl eines bestehenden Artikel erhöhen
            foreach ($_SESSION['cart'] as $k => $v) {
                // Prüfung ob Artikel im cart bereits vorhanden
                if ($v['id'] == $key) {
                    //Artikel gefunden an Stelle $k
                    $artikelImCart = $k;
                }
            }
            if ($artikelImCart == -1) {
                // alle key & anz in session speichern
                $_SESSION['cart'][] = ['id' => $key, 'anz' => $value];
                echo "-$key-";
                print_r($_SESSION['cart']);
            } else {
                // Wenn Artikel bereits im Cart, füge nur anzahl hinzu
                $_SESSION['cart'][$artikelImCart]['anz'] += $value;
            }
        }
    }

    // verhindert, dass bei reaload produkt nochmal hinzugefügt werden, weil die an url hängen
    // nach header wird kein code mehr ausgeführt
    // zum deduggen auskommentieren
    header('Location:./shop.php');
    exit; // verlasse den Vorgang
}
print_r($_SESSION['cart']);
// unset($_SESSION['cart']);
// Importierte Fkt ausführen zum erstellen der Tabelle
$tab = makeTab($datArr, '|');

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
}

//print_r($noDisplay);
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop</title>
    <link rel="stylesheet" href="../css/style.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-size: 10px;
        }

        td {
            padding: 20px 10px !important;
            vertical-align: top;
        }

        img {
            object-fit: cover;
            border-radius: 5px;
        }


        .imgBoot {
            padding-top: 1px;
            margin-left: 0.5px;
            width: 100%;
            border-radius: 5px;
            overflow: hidden;
        }

        .imgBoot img {
            width: 99%;
            height: auto;
        }

        @media (min-width: 992px) {
            .col-lg-4 {
                flex: 0 0 33.333333%;
                max-width: 33.333333%;
            }
        }
    </style>
</head>

<body>
    <!doctype html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>shop</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    </head>

    <body>
    <?php
        require_once("./nav.php");
        ?>
        <main class="container">
            <h1 class="my-3">Liste</h1>
            <div id="fehler">
                <?php
                if (isset($_SESSION["fehler"])) {
                    echo $_SESSION["fehler"];
                    $_SESSION["fehler"] = "";
                }
                ?>
            </div>
            <form action="" method="get">
                <table class="table">
                    <?= $tab ?>
                </table>
            </form>
            <div class="row">
                <h1>Cards</h1>
                <?php foreach ($datArr as $key => $value) : ?>
                    <?php $arrB = explode("|", $value); ?>
                    <div class="col-4 col-md-3 col-lg-2 mb-4">
                        <div class="card mb-5">
                            <div class="imgBoot ">
                                <?= $arrB[2] ?>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title"><?= $arrB[0] ?></h5>
                                <p class="card-text"><?= $arrB[3] ?></p>
                                <p class="card-text">Preis: <?= $arrB[1] ?></p>
                                <a href="#" class="btn btn-primary">Details</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </main>
        <?php
        require_once("./footer.php");
        ?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>

</html>