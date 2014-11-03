<?php
/**
 * Created by PhpStorm.
 * User: sidler
 * Date: 03.11.14
 * Time: 14:33
 */

namespace de\mulchprod\kajona\modulegenerator\zip;


use de\mulchprod\kajona\modulegenerator\logger\LogTrait;
use ZipArchive;

class Zip {
    use LogTrait;

    public function zipDirectory($strSourceDir, $strTargetZip) {
        $objArchive = new \ZipArchive();
        if(!$objArchive->open($strTargetZip, ZIPARCHIVE::OVERWRITE)) {
            $this->log("failed to open zip-file for writing at ".$strTargetZip);
        }

        foreach($this->getFolderContentAsArray($strSourceDir) as $strOnePath) {
            $strTarget = str_replace($strSourceDir, "", $strOnePath);
            if($strTarget[0] == "/")
                $strTarget = substr($strTarget, 1);
            $objArchive->addFile($strOnePath, $strTarget);
            $this->log("adding ".$strTarget." as ".$strOnePath);
        }

        return $objArchive->close();
    }


    private function getFolderContentAsArray($strRootFolder) {
        $arrReturn = array();

        $arrContent = scandir($strRootFolder);
        foreach($arrContent as $strOneEntry) {
            if(in_array($strOneEntry, array(".", "..", ".DS_Store"))) {
                continue;
            }

            if(is_file($strRootFolder."/".$strOneEntry)) {
                $arrReturn[] = $strRootFolder."/".$strOneEntry;
            }

            if(is_dir($strRootFolder."/".$strOneEntry)) {
                $arrReturn = array_merge($arrReturn, $this->getFolderContentAsArray($strRootFolder."/".$strOneEntry));
            }
        }

        return $arrReturn;
    }
} 