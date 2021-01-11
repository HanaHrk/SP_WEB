<?php


require_once("IController.interface.php");
class OpenArticleController implements IController {


     /**
         * Inicializace pripojeni k databazi.
     */
    public function __construct() {
        // inicializace prace s DB
        require_once (DIRECTORY_MODELS ."/ArticleModel.class.php");
        $this->db = new ArticleModel();
    }

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
        
        $this->db->openArticle();
        

        // vratim sablonu naplnenou daty
        return "";
    }
    
}

?>