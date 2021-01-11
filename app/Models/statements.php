<?php

class Statements {

    /**Funkce select pro vybrani prvku z databaze
 * Musi obsahovat vybrany prvek, tabulku z ktere chce prvek vybrat a podminky
 */
function select($chosenElements, $table, $conditionsElement, $conditionsResults) {

    if(!is_array($chosenElements)) {
        throw new Exception("Vybírané prvky musí být pole.");
    }else if(!is_string($table)) {
        throw new Exception("Tabulka musí být zadaná jako string.");
    }else if(!is_array($conditionsElement)){
        throw new Exception("Podmínkové prvky musí být pole.");
    }else if(!is_array($conditionsResults)){
        throw new Exception("Podmínkové prvky musí být pole.");
    }else if(count($conditionsElement) !== count($conditionsResults)) {
        throw new Exception("Podmínkové prvky musí být stejně dlouhé.");
    }
    $connect = NULL;
    /**Pripojeni do databaze */
    try {
        $connect = require("connect.php");
    }catch(Exception $e) {
        throw $e;
    }
    
    $chosenElements = implode(",", $chosenElements);
    /**Podmnky jsou zadavany otazniky pro obranu pred SQL utokum */
    $conditions = implode("=? AND ",$conditionsElement);
    $conditions .= '=?';

    /**Kontrola poctu podminek  */
    if(count($conditionsElement) === 0 && count($conditionsResults) === 0) {
        /**Formatovani metody */
        $statement = $connect->prepare('SELECT '.$chosenElements.' FROM '.$table);
        if(!$statement->execute($conditionsResults)) {
            throw new Exception("Chyba při SELECT dotazu.");
        }
        return $statement->fetchAll();
    }

    $statement = $connect->prepare('SELECT '.$chosenElements.' FROM '.$table.' WHERE '.$conditions);
    if(!$statement->execute($conditionsResults)) {
        throw new Exception("Chyba při SELECT dotazu.");
    }
    
    return $statement->fetchAll();
}
/**Funkce update uprabi data v databazi
 * Musi obsahovat tabulku v ktere ma dojit k upravam 
 * Co  chceme upravit podminku pro upraveni  a vysledek
 */
function update($table, $editedName, $conditionsName, $results) {
    for($i = 0; $i < count($results); $i++) {
        if($i >= count($conditionsName)) {
            $values[$i] = htmlspecialchars($results[$i]);
        }
    }
    /**Musi byt ve formatu string */
    if(!is_string($table)) {
        throw new Exception("Table mnení ve formátu string.");
    }
    /**Kontrola zadavani pro pole */
    else if(!is_array($editedName) || !is_array($conditionsName) || !is_array($results) ) {
        throw new Exception("Musí být pole.");
    }
    /**Pocet parametrů podminek a zmen se musi rovnat vysledkum */
    else if(count($editedName)+count($conditionsName) !== count($results)) {
        throw new Exception("Zadejte správný počet parametrů.");
    }
    /**Pripojeni k databazi */
    $connect = NULL;
    try {
        $connect = require("connect.php");
    }catch(Exception $e) {
        throw $e;
    }
       /**Podmnky jsou zadavany otazniky pro obranu pred SQL utokum*/
    $editedName = implode('=?,', $editedName);
    $editedName .= '=?';

       /**Podmnky jsou zadavany otazniky pro obranu pred SQL utokum*/
    $conditionsName = implode('=? AND ',$conditionsName);
    $conditionsName .= '=?';
    
    /**Formatovani metody */
    $statement = $connect->prepare('UPDATE '.$table.' SET ' .$editedName. ' WHERE ' .$conditionsName);
    if(!$statement->execute($results)){
        throw new Exception("Chyba při UPDATE dotazu.");
    }
}


/**Funkce insert pridava do databaze 
 * Musi obsahovat tabulku do ktere chce hodnoty pridat
 * Nazvy atributu a hodnoty
 */
function insert($table, $insertNames, $values) {
    for($i = 0; $i < count($values); $i++) {
        $values[$i] = htmlspecialchars($values[$i]);
    }

    
    /**Kontrola stringu */
    if(!is_string($table)) {
        throw new Exception("Tabulka musí být string.");
    }
    /**Kontorla poli */
    else if(!is_array($insertNames) || !is_array($values)) {
        throw new Exception("Hodnota musí být ve formátu pole.");
    }
    /**Kontrola poctu nazvu atribtu s novymi hodnotami */
    else if(count($insertNames) !== count($values)){
        throw new Exception("Hodnoty se musí rovnat.");
    }

    /**Pripojeni k databazi */
    $connect = NULL;
    try {
        $connect = require("connect.php");
    }catch(Exception $e) {
        throw $e;
    }
    /**Formatovani a kontrola SQL utoku */
    $insertNames = implode(',', $insertNames);
    $value = '';
    for($i = 0; $i<count($values)-1; $i++) {
        $value .= '?,';
    }
    $value .= '?';
    /**Formatovani metody */
    $statement = $connect->prepare('INSERT INTO ' .$table .'('.$insertNames.') VALUES (' .$value.')');

    if(!$statement->execute($values)){
        throw new Exception("Chyba při INSERT dotazu");
    }
}
/**Funkce delete pro odstraneni 
 * Musi obsahovat tabulku z ktere chce odstranit
 * Nazev atributu ktere chce odstranit a jejich hodnoty
 */
function delete($table, $conditionNames, $conditionValues) {
    /**Kontrola stringu */
    if(!is_string($table)) {
        throw new Exception("Tabulka musí být string.");
    }
    /**Kontorla poli */
    else if(!is_array($conditionNames) || !is_array($conditionValues)) {
        throw new Exception("Hodnota musí být pole.");
    }

    /**Pripojeni k databazi */
    $connect = NULL;
    try {
        $connect = require("connect.php");
    }catch(Exception $e) {
        throw $e;
    }

    /**Obrana proti sql utokum */
    $conditionNames = implode('=? AND ', $conditionNames);
    $conditionNames .='=?';

    /**Formatovnai metody */
    $statement = $connect->prepare('DELETE FROM ' .$table. ' WHERE ' .$conditionNames );
    
    if(!$statement->execute($conditionValues)){
        throw new Exception("Chyba při DELETE dotazu");
    }

}

}
?>