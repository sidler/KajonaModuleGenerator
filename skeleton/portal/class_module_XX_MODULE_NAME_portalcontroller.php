<?php
/*"******************************************************************************************************
*   (c) 2007-2014 by Kajona, www.kajona.de                                                              *
*       Published under the GNU LGPL v2.1, see /system/licence_lgpl.txt                                 *
********************************************************************************************************/

/**
 * Portal-class of the XX_MODULE_NAME module.
 *
 * @package module_XX_MODULE_NAME
 * @author XX_AUTHOR_EMAIL
 * @module XX_MODULE_NAME
 * @moduleId _XX_MODULE_NAME_module_id_
 */
class class_module_XX_MODULE_NAME_portalcontroller extends class_portal_controller implements interface_portal {


    /**
     * Returns a list of records.
     *
     * @permissions view
     * @return string
     */
    protected function actionList() {
        $strReturn = "";

        $strEntries = "";
        //Check rights
        foreach(class_module_XX_MODULE_NAME_XX_RECORD_NAME::getObjectList() as $objOneRecord) {
            if(!$objOneRecord->rightView())
                continue;

            $objMapper = new class_template_mapper($objOneRecord);
            $strOneRecord = $objMapper->writeToTemplate("/module_".$this->getArrModule("modul")."/".$this->arrElementData["char1"], "XX_MODULE_NAME_record", false);

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
            $strOneRecord = class_element_portal::addPortalEditorCode($strOneRecord, $objOneRecord->getSystemid(), $arrPeConfig);
            $strEntries .= $strOneRecord;
        }

        $strListTemplateID = $this->objTemplate->readTemplate("/module_".$this->getArrModule("modul")."/".$this->arrElementData["char1"], "XX_MODULE_NAME_list");
        $strReturn .= $this->objTemplate->fillTemplate(array("XX_MODULE_NAME_records" => $strEntries), $strListTemplateID);


        return $strReturn;

    }

}
