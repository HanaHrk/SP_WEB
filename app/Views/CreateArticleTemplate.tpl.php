<?php
global $tplData;

    
    
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

?>

    <form method="POST" class="form" action='' enctype="multipart/form-data">
            <div>
                <input type='hidden' name='createArticle' value='true'>
                <!-- Nastaveni jednotlivych casti pro vytvoreni clanku -->
                <input type="text" name="nazev" placeholder="Název">
                <textarea name="komentar" rows="10" placeholder="Komentář"></textarea>
                <input type="file" accept=".pdf" name="pdf">
                <input type="submit">
                <?php
                if(isset($tplData['status'])) {
                    echo $tplData['status'];
                } 
                ?>
            </div>
</form>

<?php


// paticka
$tplHeaders->getHTMLFooter()

?>