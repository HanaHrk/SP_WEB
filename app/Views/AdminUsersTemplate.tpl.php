<?php

function selectBox($default,$id) {
    
    if($default == 3) {
        return  '<select name="recenzent"><option value="3">admin</option></select>';
    }
    $text = '<form name="myform" action="" method="POST">';
    $text .= '<select onchange="this.form.submit()" name="postaveni">';
    $postaveni = array(
        array("Blokovaný", -1 ),
        array("Autor", 1),
        array("Recenzent", 2)
    );
    for($i = 0; $i < 3; $i++) {
        if($postaveni[$i][1] == $default) {
            
            $text .= '<option selected="selected" value="'.$postaveni[$i][1].'">'.$postaveni[$i][0].'</option>';
        }else {
            $text .= '<option value="'.$postaveni[$i][1].'">'.$postaveni[$i][0].'</option>';
        }
    }
    
    $text .= '</select>';
    $text .= "<input type='hidden' name='iduzivatel' value='".$id."'>";
    $text .= "<input type='hidden' name='updatePostaveni' value='true'>";
    $text .= '</form>';
    return $text;
}


function createTable($items):void {
    echo '<table border class="adminTable">';
    foreach($items['label'] as $label) {
        echo '<th>'.$label.'</th>';
    }
    foreach($items['items'] as $article) {
        echo '<tr>';
        echo '<td>'.$article['jmeno'].'</td>';
        if($article['postaveni'] == 3) {
            echo '<td colspan="2">'.'admin'.'</td>';
            
        }else {
            echo '<td>'.selectBox($article['postaveni'], $article['iduzivatel']).'</td>';
            echo '<td><a href="index.php?page=users&deleteUser=true&iduzivatel='.$article['iduzivatel'].'">&#10008</a></td>';
        }
        
        echo '</tr>';
    }
    echo '</table>';
}
function getItems() {
    global $tplData;
    $items['label'][0] = 'Jméno';
    $items['label'][1] = 'Role';
    $items['label'][2] = 'Vymazat';
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