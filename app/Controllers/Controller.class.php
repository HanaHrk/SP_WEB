<?php
// nactu rozhrani kontroleru
require_once("IController.interface.php");

/**
 * Ovladac zajistujici vypsani uvodni stranky.
 */
abstract class Controller implements IController {

    /** @var DatabaseModel $db  Sprava databaze. */
    protected $db;

    /**
     * Inicializace pripojeni k databazi.
     */
    public function __construct() {
        // inicializace prace s DB
        require_once (DIRECTORY_MODELS ."/DatabaseModel.class.php");
        $this->db = new DatabaseModel();
    }
}
?>