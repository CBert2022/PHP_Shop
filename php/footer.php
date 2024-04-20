<footer>
            <div class="alert alert-light" role="alert" id="footer">
                <?php
                if (isset($_SESSION["user"])) {
                    echo 'Angemeldet: ';
                    echo $_SESSION["user"][0] . ',' . $_SESSION["user"][1];
                    // Logout-Link anzeigen, wenn ein Benutzer angemeldet ist
                    echo '   | <a href="login.php?logout=0">Logout</a>';
                } else {
                    echo '<a href="login.php">Login</a>';
                }
                //echo "Anzahl Artikel im Warenkorb:" . count($_SESSION['cart']);

                //print_r($_SESSION['cart']);
             
                $totalAnz = 0;
                foreach ($_SESSION['cart'] as $element) {
                    // Check ob aktuelles Element "anz" hat zu $totalAnz hinzufügen
                    if (isset($item['anz'])) {
                        $totalAnz += $item['anz'];
                    }
                }
                echo "   | Items im Cart: ".$totalAnz;
                ?>
            </div>
        </footer>