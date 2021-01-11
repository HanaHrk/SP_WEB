<?php

class UsersModel {

    public function __construct() {
        require("statements.php");
         // inicializace DB
        $this->pdo = new Statements();

        if(session_status() !== 2) {
            session_start();
        }
       // vynuceni kodovani UTF-8
   }
   function deleteUser($id) {
       //TODO
    $postaveni = $_GET['postaveni'];
    $this->pdo->delete("uzivatel_napsal_clanek", ["uzivatel_iduzivatel"], [$id]);
    $this->pdo->delete("recenze",["uzivatel_iduzivatel"], [$id]);
    $this->pdo->delete("uzivatel", ["iduzivatel"], [$id]);
   }

   function editUser($data){
    $id = $data['iduzivatel']; 
    $postaveni = $data ['postaveni']; 
    
    /*echo $id, "\n";
    echo $postaveni;*/
    
    $this->pdo->update("uzivatel",['postaveni'], ['iduzivatel'], [$postaveni, $id]);
   }

   function getReviewers():array {
    return  $this->pdo->select(['iduzivatel','jmeno','prijmeni'],'uzivatel',['postaveni'],[2]); 
    }

    function getUsersData() {
            $output = [];
            $data = $this->pdo->select(['iduzivatel','jmeno','prijmeni', 'postaveni'],'uzivatel',[],[]);
            for($i = 0; $i < count($data); $i++) {
                $output[$i]['iduzivatel'] = $data[$i][0];
                $output[$i]['jmeno'] = $data[$i][1]. " ". $data[$i][2];
                $output[$i]['postaveni'] = $data[$i][3];
                $output[$i]['pos'] = $data[$i][3];
            }
            return $output;    
        }
    }

?>