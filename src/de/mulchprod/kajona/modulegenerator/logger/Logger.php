<?php
/**
 * Created by PhpStorm.
 * User: sidler
 * Date: 03.11.14
 * Time: 09:17
 */

namespace de\mulchprod\kajona\modulegenerator\logger;


class Logger {
    private $arrLogLines = array();

    private static $objInstance = null;

    private function __construct() {

    }

    public function log($strContent) {
        $this->arrLogLines[] = $strContent;
    }

    public function getLog() {
        return implode("<br />", $this->arrLogLines);
    }

    /**
     * @return Logger
     */
    public static function getInstance() {
        if(self::$objInstance == null)
            self::$objInstance = new Logger();

        return self::$objInstance;
    }

} 