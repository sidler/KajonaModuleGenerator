<?php
/*"******************************************************************************************************
*   (c) 2007-2014 by Kajona, www.kajona.de                                                              *
*       Published under the GNU LGPL v2.1, see /system/licence_lgpl.txt                                 *
********************************************************************************************************/

/**
 * Class providing an installer for the XX_MODULE_NAME module
 *
 * @package module_XX_MODULE_NAME
 * @moduleId _XX_MODULE_NAME_module_id_
 */
class class_installer_XX_MODULE_NAME extends class_installer_base implements interface_installer_removable {

    public function install() {
		$strReturn = "";
        $objSchemamanager = new class_orm_schemamanager();

		$strReturn .= "Installing tables...\n";
        $objSchemamanager->createTable("class_module_XX_MODULE_NAME_XX_RECORD_NAME");


		//register the module
		$this->registerModule("XX_MODULE_NAME", _XX_MODULE_NAME_module_id_, "class_module_XX_MODULE_NAME_portalcontroller.php", "class_module_XX_MODULE_NAME_admincontroller.php", $this->objMetadata->getStrVersion(), true);

       //Register the element
       $strReturn .= "Registering XX_MODULE_NAME-element...\n";
       //check, if not already existing
       $objElement = class_module_pages_element::getElement("XX_MODULE_NAME");
       if($objElement == null) {
           $objElement = new class_module_pages_element();
           $objElement->setStrName("faqs");
           $objElement->setStrClassAdmin("class_element_XX_MODULE_NAME_admin.php");
           $objElement->setStrClassPortal("class_element_XX_MODULE_NAME_portal.php");
           $objElement->setIntCachetime(3600);
           $objElement->setIntRepeat(1);
           $objElement->setStrVersion($this->objMetadata->getStrVersion());
           $objElement->updateObjectToDb();
           $strReturn .= "Element registered...\n";
       }
       else {
           $strReturn .= "Element already installed!...\n";
       }


        $strReturn .= "Setting aspect assignments...\n";
        if(class_module_system_aspect::getAspectByName("content") != null) {
            $objModule = class_module_system_module::getModuleByName($this->objMetadata->getStrTitle());
            $objModule->setStrAspect(class_module_system_aspect::getAspectByName("content")->getSystemid());
            $objModule->updateObjectToDb();
        }


		return $strReturn;

	}

    /**
     * Validates whether the current module/element is removable or not.
     * This is the place to trigger special validations and consistency checks going
     * beyond the common metadata-dependencies.
     *
     * @return bool
     */
    public function isRemovable() {
        return true;
    }

    /**
     * Removes the elements / modules handled by the current installer.
     * Use the reference param to add a human readable logging.
     *
     * @param string &$strReturn
     *
     * @return bool
     */
    public function remove(&$strReturn) {
        //delete the page-element
        $objElement = class_module_pages_element::getElement("XX_MODULE_NAME");
        if($objElement != null) {
            $strReturn .= "Deleting page-element 'XX_MODULE_NAME'...\n";
            $objElement->deleteObject();
        }
        else {
            $strReturn .= "Error finding page-element 'XX_MODULE_NAME', aborting.\n";
            return false;
        }

        //delete all records
        /** @var class_module_skeleton_record $objOneRecord */
        foreach(class_module_skeleton_record::getObjectList() as $objOneRecord) {
            $strReturn .= "Deleting object '".$objOneRecord->getStrDisplayName()."' ...\n";
            if(!$objOneRecord->deleteObject()) {
                $strReturn .= "Error deleting category, aborting.\n";
                return false;
            }
        }

        //delete the module-node
        $strReturn .= "Deleting the module-registration...\n";
        $objModule = class_module_system_module::getModuleByName($this->objMetadata->getStrTitle(), true);
        if(!$objModule->deleteObject()) {
            $strReturn .= "Error deleting module, aborting.\n";
            return false;
        }

        //delete the tables
        foreach(array("XX_MODULE_NAME_XX_RECORD_NAME") as $strOneTable) {
            $strReturn .= "Dropping table ".$strOneTable."...\n";
            if(!$this->objDB->_pQuery("DROP TABLE ".$this->objDB->encloseTableName(_dbprefix_.$strOneTable)."", array())) {
                $strReturn .= "Error deleting table, aborting.\n";
                return false;
            }

        }

        return true;
    }


	public function update() {
	    $strReturn = "";
        //check installed version and to which version we can update
        $arrModul = class_module_system_module::getPlainModuleData($this->objMetadata->getStrTitle(), false);

        $strReturn .= "Version found:\n\t Module: ".$arrModul["module_name"].", Version: ".$arrModul["module_version"]."\n\n";


        return $strReturn."\n\n";
	}





}
