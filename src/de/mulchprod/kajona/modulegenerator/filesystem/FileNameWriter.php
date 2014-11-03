<?php
/**
 * Created by PhpStorm.
 * User: sidler
 * Date: 30.10.14
 * Time: 16:01
 */

namespace de\mulchprod\kajona\modulegenerator\filesystem;


use de\mulchprod\kajona\modulegenerator\logger\LogTrait;
use de\mulchprod\kajona\modulegenerator\model\BasicConfig;

class FileNameWriter  {
    use LogTrait;

    private $objConfig;

    function __construct(BasicConfig $objConfig) {
        $this->objConfig = $objConfig;
    }


    public function processFilename($strPath) {
        $strTargetName = str_replace(array_keys($this->objConfig->getMappingTable()), array_values($this->objConfig->getMappingTable()), $strPath);

        if(is_file($strTargetName) && $strTargetName != $strPath) {
            unlink($strTargetName);
        }


        $strFolder = dirname($strTargetName);
        if(!is_dir($strFolder))
            mkdir($strFolder, 0777, true);

        $this->log("Renaming ".$strPath." to ".$strTargetName);
        rename($strPath, $strTargetName);

        $strSourceDir = dirname($strPath);

        if(count(scandir($strSourceDir)) == 2) {
            rmdir($strSourceDir);
        }

        chmod($strTargetName, 0777);
        return $strTargetName;
    }

}