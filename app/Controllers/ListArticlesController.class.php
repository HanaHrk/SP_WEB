<?php

require_once("IController.interface.php");
class ListArticlesController implements IController {


     /**
         * Inicializace pripojeni k databazi.
     */
    public function __construct() {
        // inicializace prace s DB
        require_once (DIRECTORY_MODELS ."/ArticleModel.class.php");
        $this->db = new ArticleModel();
    }
    public function show(string $pageTitle):string {
        //// vsechna data sablony budou globalni
        global $tplData;
        $tplData = [];

        if(isset($_GET['deleteArticle'])) {
            if($_GET['deleteArticle'] === 'true') {
                $this->db->deleteArticle($_GET['idclanku']);
            }
        }
        // nazev
        $tplData['title'] = $pageTitle;
        // data pohadek
        $tplData['articles'] = $this->db->getAuthorsArticles(); 


        //// vypsani prislusne sablony
        // zapnu output buffer pro odchyceni vypisu sablony
        ob_start();
        // pripojim sablonu, cimz ji i vykonam
        require(DIRECTORY_VIEWS ."/ListArticleTemplate.tpl.php");
        // ziskam obsah output bufferu, tj. vypsanou sablonu
        $obsah = ob_get_clean();

        // vratim sablonu naplnenou daty
        return $obsah;
    }
}
?>