<?php
/*"******************************************************************************************************
*   (c) 2007-2014 by Kajona, www.kajona.de                                                              *
*       Published under the GNU LGPL v2.1, see /system/licence_lgpl.txt                                 *
********************************************************************************************************/

/**
 * Portal-part of the XX_MODULE_NAME-element
 *
 * @package module_XX_MODULE_NAME
 * @author XX_AUTHOR_EMAIL
 * @targetTable element_universal.content_id
 */
class class_element_XX_MODULE_NAME_portal extends class_element_portal implements interface_portal_element {


    /**
     * Loads the XX_MODULE_NAME-controller and passes control
     *
     * @return string
     */
    public function loadData() {
        $strReturn = "";
        //Load the data
        $objModuleController = class_module_system_module::getModuleByName("XX_MODULE_NAME");
        if($objModuleController != null) {
            $objPortalController = $objModuleController->getPortalInstanceOfConcreteModule($this->arrElementData);
            $strReturn = $objPortalController->action();
        }
        return $strReturn;
    }

}
