<?php

require_once("IController.interface.php");
class AdminUsersController implements IController {


     /**
         * Inicializace pripojeni k databazi.
     */
    public function __construct() {
        // inicializace prace s DB
        require_once (DIRECTORY_MODELS ."/UsersModel.class.php");
        $this->db = new UsersModel();
    }


    public function show(string $pageTitle):string {
       //// vsechna data sablony budou globalni
       global $tplData;
       $tplData = [];
       // nazev
       if(isset($_POST['updatePostaveni'])) {
        if($_POST['updatePostaveni'] === 'true') {
            $this->db->editUser($_POST);
            
        }
       }

       if(isset($_GET['deleteUser'])) {
        if($_GET['deleteUser'] === 'true') {
            $this->db->deleteUser($_GET['iduzivatel']);
        }
        }

       $tplData['title'] = $pageTitle;
       $tplData['table'] = $this->db->getUsersData();
       

       //// vypsani prislusne sablony
       // zapnu output buffer pro odchyceni vypisu sablony
       ob_start();
       // pripojim sablonu, cimz ji i vykonam
       require(DIRECTORY_VIEWS ."/AdminUsersTemplate.tpl.php");
       // ziskam obsah output bufferu, tj. vypsanou sablonu
       $obsah = ob_get_clean();

       // vratim sablonu naplnenou daty
       return $obsah;
   }
    

 }

?>