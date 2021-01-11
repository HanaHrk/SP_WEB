<?php
global $tplData;

/**Moznost vybrani recenzenta pomoci selectboxu pro prirazeni prace */
function selectBox() {
    global $tplData;
    $text = '<select name="recenzent">';
    $reviewers = $tplData['reviewers'];
    foreach($reviewers as $reviewer) {
      $text .= '<option value="'.$reviewer[0].'">'.$reviewer[1].' '.$reviewer[2].'</option>';
    } 
    $text .= '</select>';
    return $text;
}
/**Moznost vybrani recenzenta pomoci selectboxu pro prirazeni prace */
/**Vytvoreni tabulky do ktere se ukladaji vsechny hodnoty */
function createTable($items):void {
    echo '<table border class="adminTable">';
    foreach($items['label'] as $label) {
        echo '<th>'.$label.'</th>';
    }
    foreach($items['items'] as $article) {
        echo '<tr>';
        //-----------TODOOOO---------
        echo '<td><a href="index.php?page=open_article&idclanek='.$article['idclanek'].'">'.$article['nazev'].'</td>';
        echo '<td>'.$article['autori'].'</td>';
        echo '<td>';
        //start inner table
        echo '<table border>';
        /**Konttorla tri recenzi */
        if(count($article['reviews']) > 3) {
            throw new Exception('Článek nemůže mít více jak tři recenze');
        }
        foreach($article['reviews'] as $review) {
            echo '<tr>';
            if($review['tema'] === NULL && $review['tema'] === NULL && $review['tema'] === NULL) {
                echo '<td>Článek zadán '.$review['autor'].'</td>';
                echo '<td colspan="4"><a href="index.php?page=my_assignments&deleteReview=true&idrecenze='.$review['idrecenze'].'">&#10008</a></td>';
            }else {
                echo '<td>'.$review['autor'].'</td>';
                echo '<td>'.$review['tema'].'</td>';
                echo '<td>'.$review['korektnost'].'</td>';
                echo '<td>'.$review['obsah'].'</td>';
                //-----------------TODO---------------
                echo '<td><a href="index.php?page=my_assignments&returnReview=true&idrecenze='.$review['idrecenze'].'">&#10096</a></td>';
            }
            echo '</tr>';
        }
        for($i = 0; $i < 3 - count($article['reviews']); $i++) {
            echo '<tr>';
            echo '<form method="POST" 
                  action="index.php?page=my_assignments&idclanek='.$article['idclanek'].'">';
            echo '<td>'.selectBox().'</td>
            <input type="hidden" name="assign" value="true">';
            echo '<td colspan="4"><input type="submit" value="Zadat k recenzi"></td>';
            echo '</form>';
            echo '</tr>';
        }
        echo '</table>';
        //end inner table
        echo '</td>';
        echo '<td><a href="index.php?page=my_assignments&accept=true&idclanek='.$article['idclanek'].'">Přijmout</a> 
             / <a href="index.php?page=my_assignments&accept=false&idclanek='.$article['idclanek'].'">Odmítnout</a></td>';
        echo '</tr>';
    }
    echo '</table>';
}
/**Pojmenovani sloupcu tabulky */
function getItems() {
    global $tplData;
    $items['label'][0] = 'Název';
    $items['label'][1] = 'Autoři';
    $items['label'][2] = 'Recenze';
    $items['label'][3] = 'Recenzenti';
    $items['items'] = $tplData['table'];
    return $items;
}
?>
<!-- Vypis obsahu sablony -->
<?php
// muze se hodit: strtotime($d['date'])
// pripojim objekt pro vypis hlavicky a paticky HTML
require("TemplateBasics.class.php");
$tplHeaders = new TemplateBasics();
// hlavicka
$tplHeaders->getHTMLHeader($tplData['title']);

    
createTable(getItems());


// paticka
$tplHeaders->getHTMLFooter()

?>