<?php
global $tplData;

/**Funkce vytvari design okynka pro clanek a uklada do nicj jednotlive clanky */
function createBoxes() {
    global $tplData;
    $data = $tplData['articles'];
    /**Vybrani dat pro jednotlive clanky */
    foreach($data as $article) {
        echo '<div class="articleBox">
        <div class="labels">
            <ul>
                <li>
                   Jméno: <a href="index.php?page=open_article&idclanek='.$article['idclanek'].'">'.$article["nazev"].'</a>
                </li>
                <li>
                   Autoři: '.$article["autor"].'
                </li>
                <li>
                Datum vytvoření: '.$article["cas"].'
                </li>
                <li>
                   Komentář: '.$article["komentar"].'
                </li>
                <li>
                    <span class="show_rev">Zobrazit recenze</span>
                </li>';

    echo '<table border class="rev_table">';
    echo "<th>Téma</th><th>Korektnost</th><th>Obsah</th><th>Komentář</th>";
    foreach($article['recenze'] as $review) {
        echo '<tr>';
        echo '<td>';
        echo $review[1];
        echo '</td>';
        echo '<td>';
        echo $review[2];
        echo '</td>';
        echo '<td>';
        echo $review[3];
        echo '</td>';
        echo '<td>';
        echo $review[0];
        echo '</td>';
        echo '</tr>';
    }
    /**Nastaveni ikonky krizku pro odstraneni clanku autorem 
     * Autor muze odstranit clanek i po publikovani clanku adminem
    */
    echo '</table>';
    echo   '</ul>
            </div>
            <div class="buttons">
                <span id="cross"><a href="index.php?page=my_articles&deleteArticle=true&idclanku='.$article['idclanek'].'">&#10008;</a></span><br>
        ';
    /**Pokud je status clanku v databazi 0 clanek neni dosud publikovany a 
     * status je zobrazen malym krizkem */
    if($article['status'] == 0) {
        echo '<span style="color:green;margin: 50%;">&#10068';
    /**Pokud je publikovan ukaze se zelena fajfka */
    }else if($article['status'] == 1) {
        echo '<span style="color:green;margin: 50%;">&#10004;';
    }else {
        echo '<span style="color:rgb(41, 5, 13);margin: 50%;">&#10008';
    }
    echo '</span>
        </div>
    </div>';
    }
}
// pripojim objekt pro vypis hlavicky a paticky HTML
require("TemplateBasics.class.php");
$tplHeaders = new TemplateBasics();


?>
<!-- ------------------------------------------------------------------------------------------------------- -->

<!-- Vypis obsahu sablony -->
<?php
// muze se hodit: strtotime($d['date'])

// hlavicka
$tplHeaders->getHTMLHeader($tplData['title']);

createBoxes();


// paticka
$tplHeaders->getHTMLFooter()

?>