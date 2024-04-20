<nav class="navbar navbar-expand-lg bg-body-tertiary px-5">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Shop</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                        <li class="nav-item <?=$noDisplay[0]?>">
                            <a class="nav-link" aria-current="page" href="start.php">Home</a>
                        </li>
                        <li class="nav-item <?=$noDisplay[1]?>">
                            <a class="nav-link <?=$active[1]?>" href="shop.php">Shop</a>
                        </li>
                        <li class="nav-item <?=$noDisplay[2]?>">
                            <a class="nav-link <?=$active[2]?>" href="warenkorb.php">Warenkorb</a>
                        </li>
                        <li class="nav-item <?=$noDisplay[3]?>">
                            <a class="nav-link <?=$active[3]?>" href="artikel.php">Artikel</a>
                        </li>
                        <li class="nav-item <?=$noDisplay[4]?>">
                            <a class="nav-link <?=$active[4]?>" href="registrierung.php">Sign in</a>
                        </li>
                        <li class="nav-item <?=$noDisplay[5]?>">
                            <a class="nav-link <?=$active[3]?>" href="login.php">Log in</a>
                        </li>

                    </ul>
                </div>
            </div>
        </nav>