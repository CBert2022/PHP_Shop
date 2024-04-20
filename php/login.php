<?php
session_start();

// Variablen definieren

$email = "";
$pw = "";
$active=['','','','','' ,'active'];

// prüft ob durch den klick auf logout der parameter ?logout übergeben wurde und löscht die session
if (isset($_GET["logout"])) {
    unset($_SESSION["user"]);
}

//Variablen setzten

if (isset($_POST['submit'])) {
    $email = htmlentities($_POST['email']);
    $pw = htmlentities($_POST['pw']);

    // besser mb_ befehle nutzen um Zeichenlänge zu prüfen
    if (mb_strlen($email) > 5 && mb_strlen($pw) > 3) {
        $data = file("../geheim/user.csv");

        //Schleife zum Vergleich der login mail & pw mit denen der Registrierung 
        foreach ($data as $key => $value) {

            //arr zerschneiden, Trenner sind die |
            $arr = explode("|", $value);
            if ($arr[5] == $email && $arr[7] == $pw) {

                //User in Session var speichern, zeigt an, ob eingeloggt
                $_SESSION['user'] = $arr;

                // Upload unf doppelte Einträge verhindern
                //print_r($arr);
                header('Location:./login.php');
                exit; // verlasse den Vorgang
            }
        }
    }
}
//MENU
$noDisplay=['','','','','','' ];

// wenn es die variable vorhanden ist, bin ich angemeldet
if(isset($_SESSION['user'])){

    header('Location:./login.php');
    exit; // verlasse den Vorgang
  //login & registrierung ausblenden
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
    <title>shop | login</title>
</head>

<body>
    <!doctype html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Bootstrap demo</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="./css/style.css">
    </head>

    <body>
    <?php
        require_once("./nav.php");
        ?>
        <main class="container">
            <form action="" method="post">
                <h1 class="my-3">Log in</h1>

                <div class="mb-3 row">
                    <label for="email" class="form-label col-4">E-Mail</label>
                    <div class="col-8">
                        <input type="text" class="form-control" id="email" name="email" required>
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
                        <button type="submit" class="btn btn-primary" name="submit">Log in</button>
                    </div>
                </div>
            </form>
        </main>
        <?php
        require_once("./footer.php");
        ?>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>

</html>