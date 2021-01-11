<?php

class ReviewsModel {

    public function __construct() {
        require("statements.php");
         // inicializace DB
        $this->pdo = new Statements();

        if(session_status() !== 2) {
            session_start();
        }
       // vynuceni kodovani UTF-8
   }
   /**Funkce pro ziskani a ulozeni recenzentu do pole pomoci postaveni */
    function getReviewers():array {
    return $this->pdo->select(['iduzivatel','jmeno','prijmeni'],TABLE_UZIVATEL,['postaveni'],[2]); 
    }

    /**ziskani jmen autoru clanku pomoci id clanku */
    function getAuthors($articleID) {
    $authors = $this->pdo->select(['uzivatel_iduzivatel'],'uzivatel_napsal_clanek',['clanek_idclanek'],[$articleID]);
    $names = [];
    foreach($authors as $author_id) {
        $name = $this->pdo->select(['jmeno','prijmeni'],'uzivatel',['iduzivatel'],[$author_id[0]]);
        array_push($names, $name[0][0]. ' '. $name[0][1]);
    }
    return implode(', ', $names);
    }

    /**Zobrazeni hotovyhc recenzi recenzentu */
    function getReviews($articleID): array {
    $output = [];
    $reviews = $this->pdo->select(['idrecenze','tema','korektnost','obsah','komentar','uzivatel_iduzivatel'],'recenze',['clanek_idclanek'],[$articleID]);
    for($i = 0; $i < count($reviews); $i++) {
        $output[$i]['idrecenze'] = $reviews[$i][0];
        $output[$i]['tema'] = $reviews[$i][1];

        $output[$i]['korektnost'] = $reviews[$i][2];
        $output[$i]['obsah'] = $reviews[$i][3];
        $output[$i]['komentar'] = $reviews[$i][4];
        $autor = $this->pdo->select(['jmeno', 'prijmeni'], 'uzivatel',['iduzivatel'], [$reviews[$i][5]]);
        $output[$i]['autor'] = $autor[0][0]. ' '. $autor[0][1];
    }
    return $output;
    }

    /**AdminReviewsController pro admina
     * AdminReviewsTemplate
     */
    function getData() :array {
        $output = [];
        $articles = $this->pdo->select(['idclanek','nazev'],'clanek',['status'],[0]);
        for($i = 0; $i < count($articles); $i++) {
            $output[$i]['idclanek'] = $articles[$i][0];
            $output[$i]['nazev'] = $articles[$i][1];
            $output[$i]['autori'] = $this->getAuthors($articles[$i][0]);
            $output[$i]['reviews'] = $this->getReviews($articles[$i][0]);
        }
        return $output;    
    }

    /**AdminReviewsController pro admina
     * AdminReviewsTemplate
     */
    function assignReview($data, $datas) {
        $iduzivatel = $data; //post
        $idclanek = $datas; //get

        /**moznost vlozeni nove recenze clanku */
        $this->pdo->insert('recenze',['idrecenze','uzivatel_iduzivatel','clanek_idclanek','status'],[hexdec(uniqid()),$iduzivatel,$idclanek,0]);
        
    }

    /**AdminReviewsController pro admina */
    function deleteReview($data) {
        $this->pdo->delete('recenze',['idrecenze'], [$data['idrecenze']]);
    }
    
    /**ReviewerController pro recenzenta */
    function editReview($data, $datas) {
    $idclanek = $data; //get
    $iduzivatel = $_SESSION['iduzivatel'];

    $komentar = $datas['komentar']; //post
    $tema = $datas['tema']; //post
    $korektnost = $datas['korektnost']; //post
    $obsah = $datas['obsah']; //post

    $this->pdo->update('recenze',
    ['komentar','tema','korektnost','obsah','status'],
    ['uzivatel_iduzivatel','clanek_idclanek'],
    [$komentar,$tema,$korektnost,$obsah,1,$iduzivatel,$idclanek]);

    }

    function acceptArticle($data) {
        /**Moznost akceptovat ci odmitnout clanek */
        $this->pdo->update('clanek',['status'],['idclanek'],[$data['status'],$data['idclanek']]);
    }

    /**Ziskani dat clanku pro moznost hodnoceni recenzentem */
function getArticlesData() {
    $output = [];
    $index = 0;
    /**Vybrani clanku pomoci id */

    $articles_id = $this->pdo->select(['clanek_idclanek'],'recenze',['uzivatel_iduzivatel','status'], [$_SESSION['iduzivatel'],0]);
    /**Prochazeni clankem pro zobrazeni autoru */
    foreach($articles_id as $id) {
        $article_id = $id[0];
        $authors_id = $this->pdo->select(['uzivatel_iduzivatel'], 'uzivatel_napsal_clanek', ['clanek_idclanek'],[$article_id]);
        $authors_names =[];
        foreach($authors_id as $author) {
            $author_name = $this->pdo->select(['prihl_jmeno'],'uzivatel',['iduzivatel'],[$author[0]]);
            array_push($authors_names,$author_name[0][0]);
        }
        $authors_names = implode(', ', $authors_names);
        $output[$index]['autor'] = $authors_names;
        $article_prop = $this->pdo->select(['nazev','cas_pridani','komentar','status'],'clanek',['idclanek'],[$article_id]);
        $output[$index]['nazev'] = $article_prop[0][0];
        $output[$index]['cas'] = $article_prop[0][1];
        $output[$index]['komentar'] = $article_prop[0][2];
        $output[$index]['status'] = $article_prop[0][3];
        $output[$index]['idclanek'] = $article_id;
        $index++;

    }
    return $output;
} 
    function returnReview() {
        $this->pdo->update("recenze",["status",'komentar','tema','korektnost','obsah'], ["idrecenze"], 
        [0,NULL, NULL, NULL, NULL ,$_GET["idrecenze"]]);
    }
}

?>