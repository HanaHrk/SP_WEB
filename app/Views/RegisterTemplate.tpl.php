<?php
global $tplData;


?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="author" content="Hana Hrkalová">
        <link rel="stylesheet" href="styles/style.css">
        <link rel="stylesheet" href="styles/footer.css">
        <link rel="stylesheet" href="styles/sign.css">
        <title><?php echo $tplData['title']?></title>
    </head>
    <body>
        <div id="signDiv">
                <div id="equationImg"> 
                
                </div>
                <div id="AccountA"> 
                    <h1>Math forum</h1>
                    <form id="formID" class="signForm" method="POST" action=''>
                        <div class="rowElement">
                            <input type="text" name="login" placeholder="Přihlačovací jméno">
                        </div>
                        <div class="rowElement">
                            <input type="password" name="password" placeholder="Heslo" >
                        </div>
                        <div class="rowElement">
                            <input type="text" name="name" placeholder="Jméno" >
                        </div>
                        <div class="rowElement">
                            <input type="text" name="surname" placeholder="Příjmení" >
                        </div>
                        <div class="rowElement">
                            <input type="email" name="email" placeholder="E-mail" >
                        </div>
                        <div class="rowElement">
                            <input type="submit" value="Register" name="submit">
                        </div>
                    </form>
                </div>
            </div>      
    </body>
</html>