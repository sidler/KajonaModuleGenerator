<?php
/**
 * Created by PhpStorm.
 * User: sidler
 * Date: 03.11.14
 * Time: 09:53
 */

namespace de\mulchprod\kajona\modulegenerator\filesystem;


use de\mulchprod\kajona\modulegenerator\logger\LogTrait;

class FileHelper {

    use LogTrait;

    /**
     * Copies a folder recursive, including all files and folders
     *
     * @param $strSourceDir
     * @param $strTargetDir
     */
    public function copyRecursive($strSourceDir, $strTargetDir) {

        if(!is_writable(dirname($strTargetDir))) {
            $this->log("Target Dir ".dirname($strTargetDir)." not writable!!! Aborting.");
            return;
        }

        $arrEntries = scandir($strSourceDir);
        foreach($arrEntries as $strOneEntry) {
            if($strOneEntry == "." || $strOneEntry == "..") {
                continue;
            }

            if(is_file($strSourceDir."/".$strOneEntry)) {

                if(!is_dir($strTargetDir)) {
                    mkdir($strTargetDir, 0777, true);
                }

                if(is_file($strTargetDir."/".$strOneEntry))
                    unlink($strTargetDir."/".$strOneEntry);

                copy($strSourceDir."/".$strOneEntry, $strTargetDir."/".$strOneEntry);
            }
            else if(is_dir($strSourceDir."/".$strOneEntry)) {
                if(!is_dir($strTargetDir."/".$strOneEntry)) {
                    mkdir($strTargetDir."/".$strOneEntry, 0777, true);
                }

                $this->copyRecursive($strSourceDir."/".$strOneEntry, $strTargetDir."/".$strOneEntry);
            }
        }
    }

}