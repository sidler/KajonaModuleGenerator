<?php
/**
 * Created by PhpStorm.
 * User: sidler
 * Date: 03.11.14
 * Time: 10:52
 */

namespace de\mulchprod\kajona\modulegenerator\filesystem;


use de\mulchprod\kajona\modulegenerator\logger\LogTrait;
use de\mulchprod\kajona\modulegenerator\model\BasicConfig;
use de\mulchprod\kajona\modulegenerator\model\PropertyConfig;

class FileContentWriter {
    use LogTrait;
    /**
     * @var BasicConfig
     */
    private $objConfig = null;

    function __construct($objConfig) {
        $this->objConfig = $objConfig;
    }


    public function processFile($strTargetFile) {
        $this->log("Processing contents of file ".$strTargetFile);

        $strContent = file_get_contents($strTargetFile);

        //swap default entries
        $strContent = $this->processBasicMapping($strContent);
        $strContent = $this->processProperties($strContent);

        if(!$this->objConfig->isXXPORTALCODE()) {
            $strContent = $this->removePortalSections($strContent);
        }
        else {
            $strContent = str_replace(array("XX_PORTAL_ONLY_START", "XX_PORTAL_ONLY_END"), array("", ""), $strContent);
        }

        if(file_put_contents($strTargetFile, $strContent) === false) {
            $this->log(" Error saving new contents to file!");
        }
    }


    private function processBasicMapping($strContent) {
        $this->log(" ...basic variables");
        return str_replace(array_keys($this->objConfig->getMappingTable()), array_values($this->objConfig->getMappingTable()), $strContent);
    }

    private function processProperties($strContent) {

        $strPropertyDefinitions = "";
        foreach($this->objConfig->getArrProperties() as $objOneProperty) {
            $strPropertyDefinitions .= $objOneProperty->getAsPropertyDefinition();
        }

        $strAccessors = "";
        foreach($this->objConfig->getArrProperties() as $objOneProperty) {
            $strAccessors .= $objOneProperty->getAsAccessors();
        }

        $strDisplayName = "No default property set";
        foreach($this->objConfig->getArrProperties() as $objOneProperty) {
            $strDisplayName = "\$this->".$objOneProperty->getPropertyVariableName();
            break;
        }

        $strTemplateProperties = "";
        foreach($this->objConfig->getArrProperties() as $objOneProperty) {
            $strTemplateProperties .= $objOneProperty->getAsTemplateSnippet();
        }

        $strLangEntries = "";
        foreach($this->objConfig->getArrProperties() as $objOneProperty) {
            $strLangEntries .= $objOneProperty->getAsLanguageProperty();
        }

        $arrMapping = array(
            "XX_RECORD_PROPERTIES" => $strPropertyDefinitions,
            "XX_RECORD_ACCESSORS" => $strAccessors,
            "XX_GET_STR_DISPLAYNAME" => $strDisplayName,
            "XX_TEMPLATE_PROPERTY_LIST" => $strTemplateProperties,
            "XX_PROPERTY_LABELS" => $strLangEntries
        );


        $this->log(" ...properties");
        return str_replace(array_keys($arrMapping), array_values($arrMapping), $strContent);
    }


    private function removePortalSections($strContent) {
        $this->log(" ...removing portal-only parts");

        $intStart = strpos($strContent, "XX_PORTAL_ONLY_START");
        $intEnd = strpos($strContent, "XX_PORTAL_ONLY_END");

        while($intStart !== false && $intEnd !== false) {

            $strContent = substr($strContent, 0, $intStart).substr($strContent, $intEnd+strlen("XX_PORTAL_ONLY_END"));


            $intStart = strpos($strContent, "XX_PORTAL_ONLY_START");
            $intEnd = strpos($strContent, "XX_PORTAL_ONLY_END");
        }

        return $strContent;


    }

}