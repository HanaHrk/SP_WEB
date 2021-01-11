<?php
//////////////////////////////////////////////////////////////////
/////////////////  Globalni nastaveni aplikace ///////////////////
//////////////////////////////////////////////////////////////////

//// Pripojeni k databazi ////

/** Adresa serveru. */
define("DB_SERVER","localhost"); // https://students.kiv.zcu.cz lze 147.228.63.10, ale musite byt na VPN
/** Nazev databaze. */
define("DB_NAME","math_forum");
/** Uzivatel databaze. */
define("DB_USER","root");
/** Heslo uzivatele databaze */
define("DB_PASS","");


//// Nazvy tabulek v DB ////

/** Tabulka s uzivateli. */
define("TABLE_CLANEK", "clanek");

define("TABLE_RECENZE", "recenze");
define("TABLE_UZIVATEL", "uzivatel");
define("TABLE_NAPSAL", "uzivatel_napsal_clanek");

if(session_status() != 2) {
    session_start();
}
/*$_SESSION['iduzivatel'] = 1688452432937231;
$_SESSION['postaveni'] = 1;*/
/*$_SESSION['iduzivatel'] = 1688191090148989;
$_SESSION['postaveni'] = 2;*/
/*$_SESSION['iduzivatel'] = 1688189316513767;
$_SESSION['postaveni'] = 3;*/


//// Dostupne stranky webu ////

/** Adresar kontroleru. */
const DIRECTORY_CONTROLLERS = "Controllers";
/** Adresar modelu. */
const DIRECTORY_MODELS = "app/Models";
/** Adresar sablon */
const DIRECTORY_VIEWS = "app/Views";

/** Klic defaultni webove stranky. */
const DEFAULT_WEB_PAGE_KEY = "uvod";

/** Dostupne webove stranky. */
const WEB_PAGES = array(

    //// Uvodni stranka ////
    "uvod" => array(
        "title" => "Domů",

        //// kontroler
        "file_name" => "IntroductionController.class.php",
        "class_name" => "IntroductionController",
    ),


    ///Prihlaseni uzivatele///
    "sign_in" => array(
        "title" => "Přihlásit se",

        //// kontroler
        "file_name" => "SignInController.class.php",
        "class_name" => "SignInController",
    ),
   

    //// Registrace uzivatelu ////
    "register" => array(
        "title" => "Registrovat se",

        //// kontroler
        "file_name" => "RegisterController.class.php",
        "class_name" => "RegisterController",
    ),


    ////Odhlaseni Uzivatele//
    "sign_out" => array(
        "title" => "Odhlásit se",

        //// kontroler
        "file_name" => "SignOutController.class.php",
        "class_name" => "SignOutController",
    ),

    //// Prace admina////
    "my_assignments" => array(
        "title" => "Moje práce",

        //// kontroler
        "file_name" => "AdminReviewsController.class.php",
        "class_name" => "AdminReviewsController",
    ),

    //// Prace Recenzenta///
    "my_reviews" => array(
        "title" => "Moje práce",

        //// kontroler
        "file_name" => "ListReviewsController.class.php",
        "class_name" => "ListReviewsController",
    ),
    //// Ohodnoceni clanku Recenzentem///
    "edit_review" => array(
        "title" => "Moje práce",

        //// kontroler
        "file_name" => "EditReviewController.class.php",
        "class_name" => "EditReviewController",
    ),


    ////Zobrazeni clanku////
    "my_articles" => array(
        "title" => "Moje články",

        //// kontroler
        "file_name" => "ListArticlesController.class.php",
        "class_name" => "ListArticlesController",
    ),


    ///Zobrazeni uzivatelu pro admina/////
    "users" => array(
        "title" => "Uživatelé",

        //// kontroler
        "file_name" => "AdminUsersController.class.php",
        "class_name" => "AdminUsersController",
    ),


    //------TODO----
    "rules" => array(
        "title" => "Pravidla fóra",

        //// kontroler
        "file_name" => "UserManagementController.class.php",
        "class_name" => "UserManagementController",
    ),


    //------TODO----
    "about" => array(
        "title" => "O nás",

        //// kontroler
        "file_name" => "UserManagementController.class.php",
        "class_name" => "UserManagementController",
    ),


    //------TODO----
    "contact" => array(
        "title" => "Kontakt",

        //// kontroler
        "file_name" => "UserManagementController.class.php",
        "class_name" => "UserManagementController",
    ),

    //////Vytvoreni clanku////////
    "create_articles" => array(
        "title" => "Vytvořit článek",

        //// kontroler
        "file_name" => "CreateArticleController.class.php",
        "class_name" => "CreateArticleController",
    ),

     //////Otevreni clanku ////////
     "open_article" => array(
        "title" => "",

        //// kontroler
        "file_name" => "OpenArticleController.class.php",
        "class_name" => "OpenArticleController",
    ),

);

?>
