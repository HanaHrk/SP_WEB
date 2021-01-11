<?php
global $tplData;

        /**Funkce vytvari design okynka pro clanek a uklada do nicj jednotlive clanky */
function createBoxes() {
    global $tplData;
    $data = $tplData['articles'];
   // echo "<script>console.log('".$tplData['articles']."')</script>";
    foreach($data as $article) {
        echo '
            <div class="articleBox">
                <div class="labels">
                    <ul>
                        <li>
                        Jméno: <a href="index.php?page=open_article?idclanek='.$article['idclanek'].'">'.$article["nazev"].'</a>
                        </li>
                        <li>
                        Komentář: '.$article["komentar"].'
                        </li>
                        <li>
                        Autoři: '.$article["autor"].'
                        </li>
                        <li>
                        <a href="index.php?page=edit_review&idclanek='.$article['idclanek'].'">Ohodnotit</a>
                        </li>
                    </ul>
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