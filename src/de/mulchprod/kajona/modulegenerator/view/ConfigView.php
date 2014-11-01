<?php
/**
 * Created by PhpStorm.
 * User: sidler
 * Date: 30.10.14
 * Time: 16:36
 */

namespace de\mulchprod\kajona\modulegenerator\view;


use de\mulchprod\kajona\modulegenerator\model\ConfigManager;
use de\mulchprod\kajona\modulegenerator\model\PropertyConfig;

class ConfigView {

    public function generateView() {
        $strContent = file_get_contents(__DIR__."/configview.html");

        $objCfg = ConfigManager::getCurrentConfig();


        $strPropertyList = "";
        foreach($objCfg->getArrProperties() as $intCounter => $objProperty) {
            $strPropertyList .= $this->getPropertyAsHtml($objProperty, $intCounter);
        }

        //fill all placeholders
        $strContent = str_replace(
            array("XX_RECORD_NAME", "XX_MODULE_NR", "XX_MODULE_AUTHOR", "XX_MODULE_NAME", "XX_PROPERTY_LIST"),
            array($objCfg->getXXRECORDNAME(), $objCfg->getXXMODULENR(), $objCfg->getXXAUTHOREMAIL(), $objCfg->getXXMODULENAME(), $strPropertyList),
            $strContent
        );




        return $strContent;
    }


    private function getPropertyAsHtml(PropertyConfig $objCfg, $intCounter) {

        $strMandatory = $objCfg->isBitMandatory() ? "checked = 'checked'" : "";
        $strIndexable = $objCfg->isBitIndexable() ? "checked = 'checked'" : "";
        $strTemplateexport = $objCfg->isBitTemplateExport() ? "checked = 'checked'" : "";

        return <<<HTML
    <fieldset>
        <div class="formrow"><label for="property_name[{$intCounter}]">Property Name</label><input type="text" name="property_name[{$intCounter}]" id="property_name[{$intCounter}]" value="{$objCfg->getStrName()}"/></div>
        <div class="formrow"><label for="property_indexable[{$intCounter}]">Indexable</label><input type="checkbox" name="property_indexable[{$intCounter}]" id="property_indexable[{$intCounter}]" {$strIndexable}/></div>
        <div class="formrow"><label for="property_mandatory[{$intCounter}]">Mandatory</label><input type="checkbox" name="property_mandatory[{$intCounter}]" id="property_mandatory[{$intCounter}]" {$strMandatory}/></div>
        <div class="formrow"><label for="property_templateexport[{$intCounter}]">Export to Template</label><input type="checkbox" name="property_templateexport[{$intCounter}]" id="property_templateexport[{$intCounter}]" {$strTemplateexport}/></div>
    </fieldset>
HTML;

    }
} 