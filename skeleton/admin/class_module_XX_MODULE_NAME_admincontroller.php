<?php
/*"******************************************************************************************************
*   (c) 2007-2014 by Kajona, www.kajona.de                                                              *
*       Published under the GNU LGPL v2.1, see /system/licence_lgpl.txt                                 *
********************************************************************************************************/


/**
 * Admin controller of the XX_MODULE_NAME-module. Handles all admin requests.
 *
 * @package module_XX_MODULE_NAME
 * @author XX_AUTHOR_EMAIL
 *
 * @objectList class_module_XX_MODULE_NAME_XX_RECORD_NAME
 * @objectEdit class_module_XX_MODULE_NAME_XX_RECORD_NAME
 * @objectNew  class_module_XX_MODULE_NAME_XX_RECORD_NAME
 *
 * @autoTestable list,new
 *
 * @module XX_MODULE_NAME
 * @moduleId _XX_MODULE_NAME_module_id_
 */
class class_module_XX_MODULE_NAME_admincontroller extends class_admin_evensimpler implements interface_admin {


    public function getOutputModuleNavi() {
        $arrReturn = array();
        $arrReturn[] = array("view", class_link::getLinkAdmin($this->getArrModule("modul"), "list", "", $this->getLang("commons_list"), "", "", true, "adminnavi"));
        $arrReturn[] = array("", "");
        $arrReturn[] = array("right", class_link::getLinkAdmin("right", "change", "&changemodule=" . $this->getArrModule("modul"), $this->getLang("commons_module_permissions"), "", "", true, "adminnavi"));
        return $arrReturn;
    }


    protected function getOutputNaviEntry(interface_model $objInstance) {
        return class_link::getLinkAdmin($this->getArrModule("modul"), $this->getActionNameForClass("edit", $objInstance), "&systemid=".$objInstance->getSystemid(), $objInstance->getStrDisplayName());
    }

}

