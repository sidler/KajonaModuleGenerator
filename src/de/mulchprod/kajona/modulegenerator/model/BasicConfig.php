<?php
namespace de\mulchprod\kajona\modulegenerator\model;

class BasicConfig {

    private $XX_MODULE_NR = 0;
    private $XX_AUTHOR_EMAIL = "demo@kajona.de";
    private $XX_MODULE_NAME = "demo";
    private $XX_RECORD_NAME = "record";
    private $XX_PORTAL_CODE = true;

    /**
     * @var PropertyConfig[]
     */
    private $arrProperties = array();
    private $arrSerializedProperties = array();

    public function __sleep() {
        $this->arrSerializedProperties = array();
        foreach($this->arrProperties as $objOneProp) {
            $this->arrSerializedProperties[] = serialize($objOneProp);
        }


        return array(
            "XX_MODULE_NR",
            "XX_AUTHOR_EMAIL",
            "XX_MODULE_NAME",
            "XX_RECORD_NAME",
            "XX_PORTAL_CODE",
            "arrSerializedProperties"
        );
    }

    public function __wakeup() {
        $this->arrProperties = array();
        foreach($this->arrSerializedProperties as $strOneProp) {
            $this->arrProperties[] = unserialize($strOneProp);
        }
    }


    public function __construct() {
        $this->XX_MODULE_NR = time();
    }




    private $arrBaseFiles = array(
        "admin_controller" => "/admin/XX_MODULE_NAME_UCFIRSTAdminController.php",
        "installer" => "/installer/InstallerXX_MODULE_NAME_UCFIRST.php",
        "lang_de" => "/lang/module_XX_MODULE_NAME/lang_XX_MODULE_NAME_de.php",
        "lang_en" => "/lang/module_XX_MODULE_NAME/lang_XX_MODULE_NAME_en.php",
        "system_config_moduleid" => "/system/config/module_XX_MODULE_NAME_id.php",
        "system_record" => "/system/XX_MODULE_NAME_UCFIRSTXX_RECORD_NAME.php",
        "metadata" => "/metadata.xml"
    );

    private $arrPortalFiles = array(
        "admin_element_class" => "/admin/elements/ElementXX_MODULE_NAME_UCFIRSTAdmin.php",
        "portal_element_class" => "/portal/elements/ElementXX_MODULE_NAME_UCFIRSTPortal.php",
        "portal_controller" => "/portal/XX_MODULE_NAME_UCFIRSTPortalController.php",
        "templates_tpl" => "/templates/default/tpl/module_XX_MODULE_NAME/default.tpl"
    );


    public function getMappingTable() {
        return array(
            "XX_MODULE_NR" => $this->XX_MODULE_NR,
            "XX_AUTHOR_EMAIL" => $this->XX_AUTHOR_EMAIL,
            "XX_MODULE_NAME_UCFIRST" => ucfirst($this->XX_MODULE_NAME),
            "XX_MODULE_NAME" => $this->XX_MODULE_NAME,
            "XX_RECORD_NAME_LOWER" => strtolower($this->XX_RECORD_NAME),
            "XX_RECORD_NAME" => ucfirst($this->XX_RECORD_NAME),
        );
    }

    /**
     * @return array
     */
    public function getArrBaseFiles() {
        return $this->arrBaseFiles;
    }

    /**
     * @return array
     */
    public function getArrPortalFiles() {
        return $this->arrPortalFiles;
    }



    /**
     * @return string
     */
    public function getXXMODULENAME() {
        return $this->XX_MODULE_NAME;
    }

    /**
     * @param string $XX_MODULE_NAME
     */
    public function setXXMODULENAME($XX_MODULE_NAME) {
        $this->XX_MODULE_NAME = strtolower($XX_MODULE_NAME);
    }

    /**
     * @return string
     */
    public function getXXAUTHOREMAIL() {
        return $this->XX_AUTHOR_EMAIL;
    }

    /**
     * @param string $XX_AUTHOR_EMAIL
     */
    public function setXXAUTHOREMAIL($XX_AUTHOR_EMAIL) {
        $this->XX_AUTHOR_EMAIL = $XX_AUTHOR_EMAIL;
    }

    /**
     * @return int
     */
    public function getXXMODULENR() {
        return $this->XX_MODULE_NR;
    }

    /**
     * @param int $XX_MODULE_NR
     */
    public function setXXMODULENR($XX_MODULE_NR) {
        $this->XX_MODULE_NR = $XX_MODULE_NR;
    }

    /**
     * @return string
     */
    public function getXXRECORDNAME() {
        return $this->XX_RECORD_NAME;
    }

    /**
     * @param string $XX_RECORD_NAME
     */
    public function setXXRECORDNAME($XX_RECORD_NAME) {
        $this->XX_RECORD_NAME = strtolower($XX_RECORD_NAME);
    }

    /**
     * @return boolean
     */
    public function isXXPORTALCODE() {
        return $this->XX_PORTAL_CODE;
    }

    /**
     * @param boolean $XX_PORTAL_CODE
     */
    public function setXXPORTALCODE($XX_PORTAL_CODE) {
        $this->XX_PORTAL_CODE = $XX_PORTAL_CODE;
    }




    /**
     * @return PropertyConfig[]
     */
    public function getArrProperties() {
        return $this->arrProperties;
    }

    /**
     * @param PropertyConfig[] $arrProperties
     */
    public function setArrProperties($arrProperties) {
        $this->arrProperties = $arrProperties;
    }





}