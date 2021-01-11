<?php

class ArticleModel {

    public function __construct() {
        require("statements.php");
         // inicializace DB
        $this->pdo = new Statements();

        if(session_status() !== 2) {
            session_start();
        }
       // vynuceni kodovani UTF-8
   }

   /**
    * 
    *
    *
    */
   function create_article($postData, $fileData) : bool {
    /**Kontrola delky retezce aby uzivatel nemohl zadat prazdny nazev nebo neprilozil pdf soubor */
    if(strlen($fileData['pdf']['tmp_name']) === 0 || strlen(trim($postData['nazev'])) === 0 ) {
        //TODO alert
        return false;
    }
    /**Nastavenin formatu data */
    $date = date("Y-m-d H:i:s");

    $key = hexdec( uniqid() );

    /**Vytvoreni clanku v databazi clanek pomoci insert */
    $this->pdo->insert('clanek', 
    ['idclanek','nazev','cas_pridani','komentar','status'],
    [$key,$postData['nazev'], $date, $postData['komentar'],0]);
    /**Vytvoreni relace pro propojeni uzivatele a clanku */
    $this->pdo->insert('uzivatel_napsal_clanek',
    ['uzivatel_iduzivatel','clanek_idclanek'],
    [$_SESSION['iduzivatel'],$key]);

    $upload_dir = "PDF";
    /**Formatovani pro upload pdf souboru */
    $uploaded_file = $upload_dir.'/'.$postData['nazev'] . '_' . str_replace(':','-',$date) .'.pdf';
    /**Zobrazeni vybraneho pdf */
    /**Kontrola nahrani pdf souboru */
    if(move_uploaded_file($fileData['pdf']['tmp_name'], $uploaded_file)) {
        return true;
    }else {
       return false;
    }
   }

   /**
    * 
    *
    */
   function openArticle() {
        /**Vybrani clanku pomoci id */
    $id = $_GET['idclanek'];
    $articleInfo =  $this->pdo->select(['nazev','cas_pridani'],'clanek',['idclanek'],[$id]);
    /**Formatovnai pdf */
    $articleName = 'PDF/'.$articleInfo[0][0].'_'.str_replace(':','-',$articleInfo[0][1]).'.pdf';

    echo $articleName;
    /**Kontorla zda slozka existuje */
        if(!file_exists($articleName)) {
            throw new Exception("Složka neexistuje");
        }
        /**Otevreni pdf souboru */
        else {
            header("Content-type: application/pdf");
            readfile($articleName);
    }
   }
   

   /**
    * 
    *
    *
    */
   function getAuthorsArticles():array {
    /**Volani souboru statements */
    $output = [];
    $index = 0;
    /**Vybrani vsech id clanku z relace od jednoho autora pomoci sessionu id_uzivatel*/
    $articles_id = $this->pdo->select(['clanek_idclanek'],TABLE_NAPSAL,['uzivatel_iduzivatel'], [$_SESSION['iduzivatel']]);
    
    /**Prochazeni id pro moznost vypsani vice autoru */
    foreach($articles_id as $id) {
        $article_id = $id[0];
        $authors_id = $this->pdo->select(['uzivatel_iduzivatel'], TABLE_NAPSAL, ['clanek_idclanek'],[$article_id]);
        $authors_names =[];
        foreach($authors_id as $author) {
            $author_name = $this->pdo->select(['prihl_jmeno'],TABLE_UZIVATEL,['iduzivatel'],[$author[0]]);
            array_push($authors_names,$author_name[0][0]);
        }
        /**Formatovani vypsani vice autoru za sebou */
        $authors_names = implode(', ', $authors_names);
        $output[$index]['autor'] = $authors_names;
        /**Vybrani konkretniho clanku pomoci jeho id z databaze */
        $article_prop =$this->pdo->select(['nazev','cas_pridani','komentar','status'],TABLE_CLANEK,['idclanek'],[$article_id]);
        $output[$index]['nazev'] =$article_prop[0][0];
        $output[$index]['cas'] = $article_prop[0][1];
        $output[$index]['komentar'] = $article_prop[0][2];
        $output[$index]['status'] = $article_prop[0][3];
        $output[$index]['idclanek'] = $article_id;
        $output[$index]['recenze'] = $this->pdo->select(["komentar", "tema", "korektnost", "obsah"], TABLE_RECENZE,['clanek_idclanek'], [$article_id]);
        $index++;


    }
    return $output;
    
    }

    /**
     * 
     * 
     * 
     */
    function deleteArticle($data) {
    $articleInfo = $this->pdo->select(['nazev','cas_pridani'],'clanek',['idclanek'],[$data]);
    $articleName = 'PDF/'.$articleInfo[0][0].'_'.str_replace(':','-',$articleInfo[0][1]).'.pdf';

    $this->pdo->delete('uzivatel_napsal_clanek',['clanek_idclanek'], [$data]);
    $this->pdo->delete('recenze',['clanek_idclanek'], [$data]);
    $this->pdo->delete('clanek',['idclanek'],[$data]);
    }

   
    



}

?>