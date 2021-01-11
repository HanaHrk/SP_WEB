
<?php
global $tplData;


// pripojim objekt pro vypis hlavicky a paticky HTML



?>
<!-- ------------------------------------------------------------------------------------------------------- -->

<!-- Vypis obsahu sablony -->
<?php
// muze se hodit: strtotime($d['date'])

// hlavicka

?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="author" content="Hana Hrkalová">
        <link rel="stylesheet" href="styles/style.css">
        <link rel="stylesheet" href="styles/footer.css">
        <link rel="stylesheet" href="styles/sign.css">
        <title>Matematické fórum</title>
    </head>
    <body>
    <div id="signDiv">
        <div id="equationImg"> 
        
        </div>
        <div id="AccountA"> 
            <h1>Math forum</h1>
            <form id="formID" class="signForm" method="POST" action=''>
                <div class="rowElement">
                    <input type="text" name="login" placeholder="Login">
                </div>
                <div class="rowElement">
                    <input type="password" name="password" placeholder="Password" >
                </div>
                <div class="rowElement">
                    <input type="submit" name= "submits" value="Sign in" name="Log in">
                </div>
            </form>
        </div>
    </div>

<?php

// paticka
$tplHeaders->getHTMLFooter();

?>