<?php
global $tplData;

function createBoxes() {
    global $tplData;
    $data = $tplData['articles'];
    foreach($data as $article) {
        echo '<div class="articleBox">
        <div class="labels">
            <ul>
                <li>
                   Jméno: <a href="index.php?page=open_article&idclanek='.$article[1].'">'.$article[0].'</a>
                </li>
                <li>
                    Autoři: '.$article['authors'].'
                </li>
                <li>
                Datum vytvoření: '.$article[3].'
                </li>
                <li>
                   Komentář: '.$article[2].'
                </li>
            </ul>
        </div></div>';
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