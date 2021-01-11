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

echo "<form method='POST' class='form' action='index.php?page=edit_review&idclanek=".$_GET['idclanek']."'>
        <input type='hidden'name='recenzovani'value='true'>"
        ?>
            <div>

                <label for='tema'>Téma</label>
                <select class='review_select' name='tema'>
                    <option value='1'>1</option>
                    <option value='2'>2</option>
                    <option value='3'>3</option>
                    <option value='4'>4</option>
                    <option value='5'>5</option>
                </select>
                <label for='korektnost'>Korektnost</label>
                <select class='review_select' name='korektnost'>
                    <option value='1'>1</option>
                    <option value='2'>2</option>
                    <option value='3'>3</option>
                    <option value='4'>4</option>
                    <option value='5'>5</option>
                </select>
                <label for='obsah'>Obsah</label>
                <select class='review_select' name='obsah'>
                    <option value='1'>1</option>
                    <option value='2'>2</option>
                    <option value='3'>3</option>
                    <option value='4'>4</option>
                    <option value='5'>5</option>
                </select>
                <textarea name="komentar" rows="10" placeholder="Komentář"></textarea>
                <input type="submit">
            </div>
        </form>
    <?php


// paticka
$tplHeaders->getHTMLFooter()

?>
