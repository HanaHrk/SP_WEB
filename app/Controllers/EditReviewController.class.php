<?php

require_once("IController.interface.php");
class EditReviewController implements IController {


     /**
         * Inicializace pripojeni k databazi.
     */
    public function __construct() {
        // inicializace prace s DB
        require_once (DIRECTORY_MODELS ."/ReviewsModel.class.php");
        $this->db = new ReviewsModel();
    }


    public function show(string $pageTitle):string {
       //// vsechna data sablony budou globalni
       global $tplData;
       $tplData = [];
       // nazev

       if(isset($_POST['recenzovani'])) {
        if($_POST['recenzovani'] === 'true') {
         $this->db->editReview($_GET['idclanek'],$_POST);
         header("location:index.php?page=my_reviews");
        }
    }

       $tplData['title'] = $pageTitle;
       

       //// vypsani prislusne sablony
       // zapnu output buffer pro odchyceni vypisu sablony
       ob_start();
       // pripojim sablonu, cimz ji i vykonam
       require(DIRECTORY_VIEWS ."/EditReviewTemplate.tpl.php");
       // ziskam obsah output bufferu, tj. vypsanou sablonu
       $obsah = ob_get_clean();

       // vratim sablonu naplnenou daty
       return $obsah;
   }
    

 }

?>