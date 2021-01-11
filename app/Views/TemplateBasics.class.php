<?php
/**
 * Trida vypisujici HTML hlavicku a paticku stranky.
 */
class TemplateBasics {

    /**
     *  Vrati vrsek stranky az po oblast, ve ktere se vypisuje obsah stranky.
     *  @param string $pageTitle    Nazev stranky.
     */
    public function getHTMLHeader(string $pageTitle) {
        if(session_status() !== 2) {
            session_start();
        }
        ?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="author" content="Hana Hrkalová">
        <link rel="stylesheet" href="styles/admin_table.css">
        <link rel="stylesheet" href="styles/form.css">
        <link rel="stylesheet" href="styles/sign.css">
        <link rel="stylesheet" href="styles/style.css">
        <link rel="stylesheet" href="styles/footer.css">
        <link rel="stylesheet" href="styles/article.css">
        <script src="scripts/scripts.js" defer></script>
        <title> <?php echo $pageTitle ?> </title>
    </head>
    <body>
        <nav>
            <div>
                <ul id="myList">
                    <div id="Account">
                        
                                <?php
                                if(!isset($_SESSION['iduzivatel'])) {
                                    echo '
                                    <li class="navLI">
                                        <a class="navLink" href="index.php?page=sign_in">Přihlásit se</a>
                                    </li>
                                    <li class="navLI" >
                                        <a class="navLink" href="index.php?page=register">Registrovat</a>
                                    </li>';
                                }else {
                                    echo '
                                    <li class="navLI">
                                        <a class="navLink" href="index.php?page=sign_out">Odhlásit se</a>
                                    </li>';
                                }
                                ?>
                        <?php
                        if(isset($_SESSION['postaveni']) && isset($_SESSION['iduzivatel'])) {
                            $post = $_SESSION['postaveni'];
                            if($post == 1){
                                echo '      
                                <li class = "min">
                                    <a class="navLink" href="index.php?page=my_articles">Moje články</a>
                                </li>
                                <li class = "min">
                                    <a class="navLink" href="index.php?page=create_article">Vytvořit článek</a>
                                </li>
                                ';
                            }if($post == 3) {
                                echo '
                                <li class="min">
                                    <a class="navLink" href="index.php?page=my_assignments">Moje práce</a>
                                </li>
                                <li class = "min">
                                    <a class="navLink" href="index.php?page=users">Uživatelé</a>
                                </li>';
                            }if($post == 2) {
                                echo '
                                <li class="min">
                                    <a class="navLink" href="index.php?page=my_reviews">Moje práce</a>
                                </li>';
                            } 
                        }
                        ?>
                        <li class="min">
                            <a class="navLink" href="index.php?page=">O nás</a>
                        </li>
                        <li class = "min">
                            <a class="navLink" href="index.php?page=">Pravidla fóra</a>
                        </li>
                        <li class = "min">
                            <a class="navLink" href="index.php?page=">Kontakt</a>
                        </li>
                    </div>
                </ul>
            </div>
        </nav>
        <div id='vermenu'>
                <ul>
                    <li class="navLI">
                        <a class="navLink" href="index.php?page=">Domů</a>
                    </li>
                    <?php
                    
                        if(isset($_SESSION['postaveni']) && isset($_SESSION['iduzivatel'])) {
                            $post = $_SESSION['postaveni'];
                            if($post == 1) {
                                echo '      
                                <li class = "navLI">
                                    <a class="navLink" href="index.php?page=my_articles">Moje články</a>
                                </li>
                                <li class = "navLI">
                                    <a class="navLink" href="index.php?page=create_articles">Vytvořit článek</a>
                                </li>
                                ';
                            }if($post == 3) {
                                echo '
                                <li class="navLI">
                                   <a class="navLink" href="index.php?page=my_assignments">Moje práce</a>
                                </li>
                                <li class = "navLI">
                                    <a class="navLink" href="index.php?page=users">Uživatelé</a>
                                </li>';
                            }if($post == 2) {
                                echo '  
                                <li class="navLI">
                                    <a class="navLink" href="index.php?page=my_reviews">Moje práce</a>
                                </li>';
                            } 
                        }
                        ?>
                    <li class="navLI">
                        <a class="navLink" href="index.php?page=about">O nás</a>
                    </li>
                    <li class = "navLI">
                        <a class="navLink" href="index.php?page=rules">Pravidla fóra</a>
                    </li>
                    <li class = "navLI">
                        <a class="navLink" href="index.php?page=contact">Kontakt</a>
                    </li>
                </ul>
            </div>
                </nav>
                <br>
        <?php
    }
    
    /**
     *  Vrati paticku stranky.
     */
    public function getHTMLFooter(){
        ?>
                <br>
                <footer>
            <div>
                @copyright
            </div>
        </footer>
            <body>
        </html>

        <?php
    }
        
}

?>