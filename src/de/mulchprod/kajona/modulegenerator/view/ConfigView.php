<?php
/**
 * Created by PhpStorm.
 * User: sidler
 * Date: 30.10.14
 * Time: 16:36
 */

namespace de\mulchprod\kajona\modulegenerator\view;


use de\mulchprod\kajona\modulegenerator\controller\ConfigManager;
use de\mulchprod\kajona\modulegenerator\logger\Logger;
use de\mulchprod\kajona\modulegenerator\model\PropertyConfig;

class ConfigView {

    public static $arrDatatypes = array(
        "int", "long", "double", "char10", "char20", "char100", "char254", "char500", "text", "longtext"
    );

    public static $arrFieldtypes = array(
        "checkbox", "date", "datetime", "dropdown", "month_year_dropdown", "multiselect", "file", "float", "hidden", "image", "page", "password", "template", "text", "toggleonoff", "upload", "user", "textarea", "wysiwyg", "wysiwygsmall", "yesno"
    );

    public function generateView() {
        $strContent = file_get_contents(__DIR__."/configview.html");

        $objCfg = ConfigManager::getCurrentConfig();


        $strPropertyList = "";
        foreach($objCfg->getArrProperties() as $intCounter => $objProperty) {
            $strPropertyList .= $this->getPropertyAsHtml($objProperty, $intCounter);
        }

        $strPropertyTemplate = $this->getPropertyAsHtml(new PropertyConfig(), "x");

        $strPortal = $objCfg->isXXPORTALCODE() ? "checked = 'checked'" : "";

        //fill all placeholders
        $strContent = str_replace(
            array("XX_RECORD_NAME", "XX_MODULE_NR", "XX_MODULE_AUTHOR", "XX_MODULE_NAME", "XX_PROPERTY_LIST", "XX_PORTAL_CODE", "XX_LOG_VIEW", "XX_PROPERTY_TEMPLATE"),
            array($objCfg->getXXRECORDNAME(), $objCfg->getXXMODULENR(), $objCfg->getXXAUTHOREMAIL(), $objCfg->getXXMODULENAME(), $strPropertyList, $strPortal, Logger::getInstance()->getLog(), $strPropertyTemplate),
            $strContent
        );




        return $strContent;
    }




    private function getPropertyAsHtml(PropertyConfig $objCfg, $intCounter) {

        $strMandatory = $objCfg->isBitMandatory() ? "checked = 'checked'" : "";
        $strIndexable = $objCfg->isBitIndexable() ? "checked = 'checked'" : "";
        $strTemplateexport = $objCfg->isBitTemplateExport() ? "checked = 'checked'" : "";



        $strDatatypes = "";
        foreach(self::$arrDatatypes as $strOneType) {
            $strDatatypes .= "<option value='{$strOneType}' ".($objCfg->getStrDatatype() == $strOneType ? "selected" : "").">{$strOneType}</option>";
        }

        $strFieldtypes = "";
        foreach(self::$arrFieldtypes as $strOneType) {
            $strFieldtypes .= "<option value='{$strOneType}' ".($objCfg->getStrFieldType() == $strOneType ? "selected" : "").">{$strOneType}</option>";
        }

        return <<<HTML
    <fieldset>
        <div class="formrow"><label for="property_name[{$intCounter}]">Property Name</label><input type="text" name="property_name[{$intCounter}]" id="property_name[{$intCounter}]" value="{$objCfg->getStrName()}"/></div>
        <div class="formrow"><label for="property_indexable[{$intCounter}]">Indexable</label><input type="checkbox" name="property_indexable[{$intCounter}]" id="property_indexable[{$intCounter}]" {$strIndexable}/></div>
        <div class="formrow"><label for="property_mandatory[{$intCounter}]">Mandatory</label><input type="checkbox" name="property_mandatory[{$intCounter}]" id="property_mandatory[{$intCounter}]" {$strMandatory}/></div>
        <div class="formrow"><label for="property_templateexport[{$intCounter}]">Export to Template</label><input type="checkbox" name="property_templateexport[{$intCounter}]" id="property_templateexport[{$intCounter}]" {$strTemplateexport}/></div>

        <div class="formrow"><label for="property_datatype[{$intCounter}]">Datatype</label>
            <select name="property_datatype[{$intCounter}]" id="property_datatype[{$intCounter}]">
                {$strDatatypes}
            </select>
        </div>
        <div class="formrow"><label for="property_fieldtype[{$intCounter}]">Fieldtype</label>
            <select name="property_fieldtype[{$intCounter}]" id="property_fieldtype[{$intCounter}]">
                {$strFieldtypes}
            </select>
        </div>
    </fieldset>
HTML;

    }
} 