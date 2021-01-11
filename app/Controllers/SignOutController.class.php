<?php

// nactu rozhrani kontroleru
require_once("Controller.class.php");

/**
 * Ovladac zajistujici vypsani uvodni stranky.
 */
class SignOutController extends Controller {

 
    /**
     * Vrati obsah uvodni stranky.
     * @param string $pageTitle     Nazev stranky.
     * @return string               Vypis v sablone.
     */
    public function show(string $pageTitle):string {
        //// vsechna data sablony budou globalni
        global $tplData;
        $tplData = [];
        // nazev
        $tplData['title'] = $pageTitle;
        session_destroy();
        header("location:index.php");

        // vratim sablonu naplnenou daty
        return "";
    }
    
}

?>