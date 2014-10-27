<?php
/*"******************************************************************************************************
*   (c) 2007-2014 by Kajona, www.kajona.de                                                              *
*       Published under the GNU LGPL v2.1, see /system/licence_lgpl.txt                                 *
********************************************************************************************************/

/**
 * Portal-part of the skeleton-element
 *
 * @package module_skeleton
 * @author XX_AUTHOR_EMAIL
 * @targetTable element_universal.content_id
 */
class class_element_skeleton_portal extends class_element_portal implements interface_portal_element {


    /**
     * Loads the skeleton-controller and passes control
     *
     * @return string
     */
    public function loadData() {
        $strReturn = "";
        //Load the data
        $objModuleController = class_module_system_module::getModuleByName("skeleton");
        if($objModuleController != null) {
            $objFaqs = $objModuleController->getPortalInstanceOfConcreteModule($this->arrElementData);
            $strReturn = $objFaqs->action();
        }
        return $strReturn;
    }

}
