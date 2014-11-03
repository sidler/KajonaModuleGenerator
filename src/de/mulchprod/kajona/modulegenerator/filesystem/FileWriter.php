<?php
/**
 * Created by PhpStorm.
 * User: sidler
 * Date: 30.10.14
 * Time: 16:01
 */

namespace de\mulchprod\kajona\modulegenerator\filesystem;


use de\mulchprod\kajona\modulegenerator\model\BasicConfig;
use de\mulchprod\kajona\modulegenerator\logger\Logger;

class FolderWriter {

    private $objConfig;

    function __construct(BasicConfig $objConfig) {
        $this->objConfig = $objConfig;
    }


    public function processFilename($strPath) {
        $strTargetName = str_replace(array_keys($this->objConfig->getMappingTable()), array_values($this->objConfig->getMappingTable()), $strPath);
        Logger::getInstance()->log("Renaming ".$strPath." to ".$strTargetName);
        rename($strPath, $strTargetName);
        return $strTargetName;
    }

}