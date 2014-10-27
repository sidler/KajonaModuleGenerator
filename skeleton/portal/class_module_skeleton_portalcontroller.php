<?php
/*"******************************************************************************************************
*   (c) 2007-2014 by Kajona, www.kajona.de                                                              *
*       Published under the GNU LGPL v2.1, see /system/licence_lgpl.txt                                 *
********************************************************************************************************/

/**
 * Portal-class of the skeleton module.
 *
 * @package module_skeleton
 * @author XX_AUTHOR_EMAIL
 * @module skeleton
 * @moduleId _skeleton_module_id_
 */
class class_module_skeleton_portalcontroller extends class_portal_controller implements interface_portal {


    /**
     * Returns a list of records.
     *
     * @permissions view
     * @return string
     */
    protected function actionList() {
        $strReturn = "";


        //Check rights
        foreach(class_module_skeleton_record::getObjectList() as $objOneRecord) {
            if(!$objOneRecord->rightView())
                continue;

            $objMapper = new class_template_mapper($objOneRecord);
            $strOneRecord = $objMapper->writeToTemplate("/module_skeleton/".$this->arrElementData["char1"], "skeleton", false);

            //Add pe code
            $arrPeConfig = array(
                "pe_module"               => $this->getArrModule("modul"),
                "pe_action_edit"          => "edit",
                "pe_action_edit_params"   => "&systemid=".$objOneRecord->getSystemid(),
                "pe_action_new"           => "new",
                "pe_action_new_params"    => "",
                "pe_action_delete"        => "delete",
                "pe_action_delete_params" => "&systemid=".$objOneRecord->getSystemid()
            );
            $strOneRecord .= class_element_portal::addPortalEditorCode($strOneRecord, $objOneRecord->getSystemid(), $arrPeConfig);

            $strReturn .= $strOneRecord;
        }

        return $strReturn;

    }

}
