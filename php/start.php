<?php
session_start();
// Klasse setzten in nav zu active
$active=['active','','','','','' ];

//Menu
// klasse li_none setzen in nav hinzugefügt
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
    <title>shop | home</title>
</head>

<body>
    <!doctype html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Bootstrap demo</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
            <link rel="stylesheet" href="../css/style.css">
    </head>

    <body>
    <?php
        require_once("./nav.php");
        ?>
<main class="container">
  <div>Inhalt</div>
  <div>Inhalt</div>
  <div>Inhalt</div>
  <div>Inhalt</div>
  <div>Inhalt</div>
  <div>Inhalt</div>
  <div>Inhalt</div>
</main>
        <?php
        require_once("./footer.php");
        ?>

        <div id="fehler">
        <?php
        if (isset($_SESSION["fehler"])) {
          echo $_SESSION["fehler"];
          $_SESSION["fehler"] = "";
        }
        ?>
      </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>
</body>

</html>