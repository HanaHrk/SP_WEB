<?php

class DatabaseModel {

        private $pdo;

        public function __construct() {
             require("statements.php");
              // inicializace DB
             $this->pdo = new Statements();
            // vynuceni kodovani UTF-8
        }

        public function getUserData() :array
        {
                return $this->pdo->select(['*'],TABLE_UZIVATEL, [], []);
        }
        function getData() {
                
                $i = 0;
                $articles = $this->pdo->select(["nazev", "idclanek", "komentar", "cas_pridani" ],TABLE_CLANEK,["status"],[1]);
                foreach($articles as $article) {
                    $authors = $this->pdo->select(["uzivatel_iduzivatel"], TABLE_NAPSAL, ["clanek_idclanek"], [$article[1]]);
                    $names = [];
                    foreach($authors as $author) {
                        $name = $this->pdo->select(['jmeno', 'prijmeni'], TABLE_UZIVATEL, ["iduzivatel"], [$author[0]]);
                        array_push($names, $name[0][0]." ".$name[0][1]); 
                    }
                    $articles[$i]['authors'] = implode(", ", $names);
                    $i++;
                }
                return $articles;
            }
        function registerUser($data) {

            $key = hexdec( uniqid() );
            $email = $data['email'];
            $name = $data['name'];
            $surname = $data['surname'];
            $login = $data['login'];
            $password = $data['password'];

            $e = $this->pdo->select(['*'], TABLE_UZIVATEL, ['prihl_jmeno'], [$login]);
            if(count($e) > 0) {
                echo "<script>
                alert('Uživatel se zadaným jménem již existuje, zkuste znovu');
                window.location.href='';
                </script>";
                return;
            }else if(!$this->validateRegistration($data)) {
                return;
            }
            /**Vlozeni noveho registrovaneho uzivatele do databaze */
            $this->pdo->insert(TABLE_UZIVATEL, ['iduzivatel', 'prihl_jmeno', 'heslo', 'email', 'jmeno', 'prijmeni', 'postaveni'], 
            [$key, $login, $password, $email, $name, $surname, 1]);
            
        }  

        function validateRegistration($data) :bool {
         
            /**Konttola zda je heslo delsi nez ctyri znaky */
            if(strlen($data['password']) < 4) {
                echo "<script>
                alert('Zadejte heslo delší než 3 znaky.');
                window.location.href='#';
                </script>";
                return false;
            }
            return true;
        }

        function sign_in() {
        $username = $_POST['login'];
        $password = $_POST['password'];

        $result = $this->pdo->select(['iduzivatel, postaveni'], 'uzivatel', ['prihl_jmeno', 'heslo'],[$username, $password]);
        

        if(count($result) === 1) {

            $_SESSION['iduzivatel'] = $result[0][0];
            $_SESSION['postaveni'] = $result[0][1];
            if($_SESSION['postaveni'] == -1) {
                    echo "<script>
                alert('Váš účet je zablokovaný.');
                window.location.href='index.php?page=sign_in';
                </script>";
                return false;
            }
            header('Location:index.php?page=uvod');

           
        }
        else if(count($result) === 0) {
            echo "<script>
            alert('Zadané jméno nebo heslo je nesprávné.');
            window.location.href='index.php?page=sign_in';
            </script>";
        }
        else if(count($result) > 1) {
            throw new Exception("Chyba. Přihlašovacím údájům odpovídá více záznamů. Kontaktujte autora");
        }
        }

        function sign_out() {
            session_destroy();
        }




            
}

?>