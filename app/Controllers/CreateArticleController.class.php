<?php

require_once("IController.interface.php");
class CreateArticleController implements IController {


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
       // nazev
       $tplData['title'] = $pageTitle;

       if(isset($_POST['createArticle'])) {
        if($_POST['createArticle'] === 'true') {
          
            $this->db->create_article($_POST, $_FILES);
        }
       }

     /* if(isset($_POST)) {
        if($this->db->create_article($_POST)) {
          $tplData['status'] = "<span style='color:green;'>Článek úspěšně vytvořen.</span>";
        }else {
          $tplData['status'] = "<span style='color:green;'>Článek se nepodařilo vytvořit.</span>";
        }
      }*/

       //// vypsani prislusne sablony
       // zapnu output buffer pro odchyceni vypisu sablony
       ob_start();
       // pripojim sablonu, cimz ji i vykonam
       require(DIRECTORY_VIEWS ."/CreateArticleTemplate.tpl.php");
       // ziskam obsah output bufferu, tj. vypsanou sablonu
       $obsah = ob_get_clean();

       // vratim sablonu naplnenou daty
       return $obsah;
   }
    

 }

?>