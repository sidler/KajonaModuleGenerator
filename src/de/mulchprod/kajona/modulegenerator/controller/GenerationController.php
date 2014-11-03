<?php
/**
 * Created by PhpStorm.
 * User: sidler
 * Date: 01.11.14
 * Time: 18:58
 */

namespace de\mulchprod\kajona\modulegenerator\controller;



use de\mulchprod\kajona\modulegenerator\filesystem\FileContentWriter;
use de\mulchprod\kajona\modulegenerator\filesystem\FileHelper;
use de\mulchprod\kajona\modulegenerator\filesystem\FileNameWriter;
use de\mulchprod\kajona\modulegenerator\logger\LogTrait;
use de\mulchprod\kajona\modulegenerator\zip\Zip;

class GenerationController {
    use LogTrait;

    private $strDir = "";


    /**
     * Basic start method
     */
    public function generateModule() {
        $objCfg = ConfigManager::getCurrentConfig();
        $this->strDir = BASE_PATH."/output/".md5($objCfg->getXXMODULENR().$objCfg->getXXMODULENAME());

        $this->log("Creating target directory ".$this->strDir);

        $objFileHelper = new FileHelper();
        $objFileHelper->copyRecursive(BASE_PATH."/skeleton", $this->strDir);

        $this->log("Changing filenames");
        $objFileWriter = new FileNameWriter(ConfigManager::getCurrentConfig());

        $arrFinalFiles = array();

        foreach(ConfigManager::getCurrentConfig()->getArrBaseFiles() as $strBasePath => &$strTargetPath) {
            $strTargetPath = $objFileWriter->processFilename($this->strDir.$strTargetPath);
            $arrFinalFiles[] = $strTargetPath;
        }


        if($objCfg->isXXPORTALCODE()) {
            foreach(ConfigManager::getCurrentConfig()->getArrPortalFiles() as $strBasePath => &$strTargetPath) {
                $strTargetPath = $objFileWriter->processFilename($this->strDir.$strTargetPath);
                $arrFinalFiles[] = $strTargetPath;
            }
        }
        else {
            foreach(ConfigManager::getCurrentConfig()->getArrPortalFiles() as $strBasePath => &$strTargetPath) {
                if(is_file($this->strDir.$strTargetPath))
                    unlink($this->strDir.$strTargetPath);
            }
        }



        $objContentWriter = new FileContentWriter(ConfigManager::getCurrentConfig());
        foreach($arrFinalFiles as $strOneFile) {
            $objContentWriter->processFile($strOneFile);
        }

        $this->log("Cleaning module...");
        $objFileHelper->deleteEmptyDirs($this->strDir);

        //and generate a zip
        $this->log("Generating ZIP-Archive...");
        $strZipName = "module_".$objCfg->getXXMODULENAME().".zip";
        $objZip = new Zip();
        $objZip->zipDirectory($this->strDir, BASE_PATH."/output/".$strZipName);
        $this->log("created zip-file at ".BASE_PATH."/output/".$strZipName);

        $this->log("direct download: <a href='http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['SCRIPT_NAME'])."/output/".$strZipName."'>".$strZipName."</a>");
        $this->log("");
    }







} 