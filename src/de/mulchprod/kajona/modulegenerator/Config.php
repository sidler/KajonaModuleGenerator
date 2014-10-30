<?php
namespace de\mulchprod\kajona\modulegenerator;

class Config {

    private $XX_MODULE_NR = 0;
    private $XX_AUTHOR_EMAIL = "demo@kajona.de";
    private $XX_TEMPLATE_PROPERTY_LIST = "";
    private $XX_GET_STR_DISPLAYNAME = "";
    private $XX_RECORD_GETTER_SETTER = "";
    private $XX_MODULE_NAME = "";
    private $XX_RECORD_NAME = "";
    private $XX_RECORD_PROPERTIES = "";


    private $arrBaseFiles = array(
        "admin_element_class" => "/admin/elements/class_element_XX_MODULE_NAME_admin.php",
        "admin_controller" => "/admin/class_module_XX_MODULE_NAME_admincontroller.php",
        "installer" => "/installer/class_installer_XX_MODULE_NAME.php",
        "lang_de" => "/lang/module_XX_MODULE_NAME/lang_XX_MODULE_NAME_de.php",
        "lang_en" => "/lang/module_XX_MODULE_NAME/lang_XX_MODULE_NAME_en.php",
        "system_config_moduleid" => "/system/config/module_XX_MODULE_NAME_id.php",
        "system_record" => "/system/class_module_XX_MODULE_NAME_XX_RECORD_NAME.php",
        "metadata" => "metadata.xml"
    );

    private $arrPortalFiles = array(
        "portal_element_class" => "/portal/elements/class_element_XX_MODULE_NAME_portal.php",
        "portal_controller" => "/portal/class_module_XX_MODULE_NAME_portalcontroller.php",
        "templates_tpl/default" => "/templates/default/tpl/module_XX_MODULE_NAME/default.tpl"
    );


    public function getMappingTable() {
        return array(
            "XX_MODULE_NR" => $this->XX_MODULE_NR,
            "XX_AUTHOR_EMAIL" => $this->XX_AUTHOR_EMAIL,
            "XX_MODULE_NAME" => $this->XX_MODULE_NAME,
            "XX_RECORD_NAME" => $this->XX_RECORD_NAME
        );
    }
}