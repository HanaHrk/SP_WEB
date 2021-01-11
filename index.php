<?php


// nactu vlastni nastaveni webu
require_once("settings.inc.php");

// nactu tridu spoustejici aplikaci
require_once("app/ApplicationStart.class.php");


if(isset($_GET["page"]) && array_key_exists($_GET["page"], WEB_PAGES)){
    $pageKey = $_GET["page"]; // nastavim pozadovane
} else {
    $pageKey = DEFAULT_WEB_PAGE_KEY; // defaulti klic
}
// pripravim si data ovladace
$pageInfo = WEB_PAGES[$pageKey];
// spustim aplikaci
$app = new ApplicationStart();
$app->appStart();

?>