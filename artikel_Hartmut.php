$name = "";

$preis = 0;

$bild = "";

$besch = "";

$fehler = "";


if (isset($_POST['save'])) {

  $name = htmlentities($_POST['name']);

  $preis = htmlentities($_POST['preis']);

  //$bild = $_POST['bild'];

  $besch = htmlentities($_POST['besch']);

  $besch=nl2br($besch);

  $besch = str_replace("/n", '', $besch);

  $besch = str_replace("/r", '', $besch);

  // Upload


  $ext = pathinfo($_FILES['bild']['name'], PATHINFO_EXTENSION);

  $ext = strtolower($ext);

  echo 88;

  if (strlen($name) > 3 && strlen($preis) > 0 && $_FILES['bild']['size'] > 0) {

    echo 99;

    if ($ext == 'jpg' || $ext == 'png' || $ext == 'gif') {

      $bild = uniqid($_FILES['bild']['name']) . '.' . $ext;

      move_uploaded_file($_FILES['bild']['tmp_name'], './img/' . $bild);

    }

    $csv = "$name|$preis|$bild|$besch\n";


    $f = file_put_contents("./geheim/artikel.csv", $csv, FILE_APPEND | LOCK_EX);

    if ($f < 1) {

      $fehler = "Daten nicht geschr.";

    } else {

      $fehler = "Daten geschrieben";

    }

    ;

  }

}