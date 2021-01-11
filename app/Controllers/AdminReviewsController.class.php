<?php

require_once("IController.interface.php");
class AdminReviewsController implements IController {

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
       if(isset($_POST['assign'])) {
        if($_POST['assign'] === 'true') {
         $this->db->assignReview($_POST['recenzent'], $_GET['idclanek']);
        }
    }
     
    if(isset($_GET['deleteReview'])) {
        if($_GET['deleteReview'] === 'true') {
             $this->db->deleteReview($_GET);
        }
    }

    if(isset($_GET['returnReview'])) {
        if($_GET['returnReview'] === 'true') {
             $this->db->returnReview();
        }
    }

    if(isset($_GET['accept'])) {
        if($_GET['accept'] === 'true') {
            $_GET['status'] = 1;
            $this->db->acceptArticle($_GET);
        }
        else if($_GET['accept'] === 'false') {
            $_GET['status'] = -1;
            $this->db->acceptArticle($_GET);
            header("location:index.php?=my_assignments");
        }
    }

       $tplData['title'] = $pageTitle;
       $tplData['reviewers'] = $this->db->getReviewers(); 
       $tplData['table'] = $this->db->getData();
        
       
       //// vypsani prislusne sablony
       // zapnu output buffer pro odchyceni vypisu sablony
       ob_start();
       // pripojim sablonu, cimz ji i vykonam
       require(DIRECTORY_VIEWS ."/AdminReviewsTemplate.tpl.php");
       // ziskam obsah output bufferu, tj. vypsanou sablonu
       $obsah = ob_get_clean();

       // vratim sablonu naplnenou daty
       return $obsah;
   }
    

 }

?>