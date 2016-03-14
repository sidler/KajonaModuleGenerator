<?php
/**
 * Created by PhpStorm.
 * User: sidler
 * Date: 14.03.16
 * Time: 13:58
 */

namespace de\mulchprod\kajona\modulegenerator\phar;

use de\mulchprod\kajona\modulegenerator\logger\LogTrait;
use FilesystemIterator;

class Phar
{
    use LogTrait;

    /**
     * @param $strSourceDir string the directory to be included in the phar, absolute paths
     * @param $strTargetPath string the full path including the name of the phar to be generated
     *
     */
    public function generatePhar($strSourceDir, $strTargetPath)
    {
        if(ini_get("phar.readonly") == 1) {
            ini_set("phar.readonly", "0");
        }

        if(ini_get("phar.readonly") == 1) {
            $this->log("Phar generation is not possible, the ini-value phar.readonly is set to 1. Please change the php.ini value to 0 in order to generate a valid phar. See http://php.net/manual/en/phar.configuration.php#ini.phar.readonly for more details.");
            return;
        }



        $objPhar = new \Phar(
            $strTargetPath,
            FilesystemIterator::CURRENT_AS_FILEINFO | FilesystemIterator::KEY_AS_FILENAME,
            basename($strTargetPath)
        );
        $objPhar->buildFromDirectory($strSourceDir);
        $objPhar->setStub($objPhar->createDefaultStub());
    }


}
