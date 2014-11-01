<?php
/**
 * Created by PhpStorm.
 * User: sidler
 * Date: 01.11.14
 * Time: 18:59
 */

namespace de\mulchprod\kajona\modulegenerator\model;



use de\mulchprod\kajona\modulegenerator\model\PropertyConfig;

class ConfigManager {

    /**
     * @var BasicConfig;
     */
    private static $objCurrentConfig = null;

    const SESSION_KEY = "ConfigManager_current_config";

    public static function updateConfigFromRequest() {
        $objCfg = self::getCurrentConfig();

        if($_POST["updatecfg"] != "") {
            $objCfg->setXXAUTHOREMAIL($_POST["module_author"]);
            $objCfg->setXXMODULENAME($_POST["module_name"]);
            $objCfg->setXXMODULENR($_POST["module_nr"]);
            $objCfg->setXXRECORDNAME($_POST["record_name"]);

            $arrProperties = array();
            if(isset($_POST["property_name"])) {
                foreach($_POST["property_name"] as $intKey => $strValue) {
                    $objProp = new PropertyConfig();
                    $objProp->setStrName($_POST["property_name"][$intKey]);
                    $objProp->setBitMandatory(isset($_POST["property_mandatory"][$intKey]));
                    $objProp->setBitIndexable(isset($_POST["property_indexable"][$intKey]));
                    $objProp->setBitTemplateExport(isset($_POST["property_templateexport"][$intKey]));

                    $arrProperties[] = $objProp;
                }
            }

            $objCfg->setArrProperties($arrProperties);
        }
    }

    public static function getCurrentConfig() {
        if(isset($_SESSION[self::SESSION_KEY]))
            self::$objCurrentConfig = $_SESSION[self::SESSION_KEY];

        if(self::$objCurrentConfig == null)
            self::$objCurrentConfig = new BasicConfig();

        return self::$objCurrentConfig;
    }

    public static function saveCurrentConfig() {
        $_SESSION[self::SESSION_KEY] = self::$objCurrentConfig;
    }
} 