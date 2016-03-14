<?php
/*"******************************************************************************************************
*   (c) 2007-2016 by Kajona, www.kajona.de                                                              *
*       Published under the GNU LGPL v2.1, see https://github.com/kajona/kajonacms/blob/master/LICENCE  *
********************************************************************************************************/

namespace Kajona\XX_MODULE_NAME_UCFIRST\Installer;

use Kajona\Pages\System\PagesElement;
use Kajona\System\System\InstallerBase;
use Kajona\System\System\InstallerRemovableInterface;
use Kajona\System\System\OrmSchemamanager;
use Kajona\System\System\SystemAspect;
use Kajona\System\System\SystemModule;
use Kajona\XX_MODULE_NAME_UCFIRST\System\XX_MODULE_NAME_UCFIRSTXX_RECORD_NAME;


/**
 * Class providing an installer for the XX_MODULE_NAME module
 *
 * @package module_XX_MODULE_NAME
 * @moduleId _XX_MODULE_NAME_module_id_
 */
class InstallerXX_MODULE_NAME_UCFIRST extends InstallerBase implements InstallerRemovableInterface
{

    public function install()
    {
        $strReturn = "";
        $objSchemamanager = new OrmSchemamanager();

        $strReturn .= "Installing tables...\n";
        $objSchemamanager->createTable('Kajona\XX_MODULE_NAME_UCFIRST\System\XX_MODULE_NAME_UCFIRSTXX_RECORD_NAME');


        //register the module
        $this->registerModule("XX_MODULE_NAME", _XX_MODULE_NAME_module_id_, "XX_MODULE_NAME_UCFIRSTPortalController.php", "XX_MODULE_NAME_UCFIRSTAdminController.php", $this->objMetadata->getStrVersion(), true);


        XX_PORTAL_ONLY_START
        //Register the element
        $strReturn .= "Registering XX_MODULE_NAME-element...\n";

        //check, if not already existing
        $objElement = PagesElement::getElement("XX_MODULE_NAME");
        if ($objElement == null) {
            $objElement = new PagesElement();
            $objElement->setStrName("XX_MODULE_NAME");
            $objElement->setStrClassAdmin("ElementXX_MODULE_NAME_UCFIRSTAdmin.php");
            $objElement->setStrClassPortal("ElementXX_MODULE_NAME_UCFIRSTPortal.php");
            $objElement->setIntCachetime(3600);
            $objElement->setIntRepeat(1);
            $objElement->setStrVersion($this->objMetadata->getStrVersion());
            $objElement->updateObjectToDb();
            $strReturn .= "Element registered...\n";
        }
        else {
            $strReturn .= "Element already installed!...\n";
        }
        XX_PORTAL_ONLY_END


        $strReturn .= "Setting aspect assignments...\n";
        if (SystemAspect::getAspectByName("content") != null) {
            $objModule = SystemModule::getModuleByName($this->objMetadata->getStrTitle());
            $objModule->setStrAspect(SystemAspect::getAspectByName("content")->getSystemid());
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
    public function isRemovable()
    {
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
    public function remove(&$strReturn)
    {

        XX_PORTAL_ONLY_START
        //delete the page-element
        $objElement = PagesElement::getElement("XX_MODULE_NAME");
        if ($objElement != null) {
            $strReturn .= "Deleting page-element 'XX_MODULE_NAME'...\n";
            $objElement->deleteObject();
        }
        else {
            $strReturn .= "Error finding page-element 'XX_MODULE_NAME', aborting.\n";
            return false;
        }
        XX_PORTAL_ONLY_END

        //delete all records
        /** @var XX_MODULE_NAME_UCFIRSTXX_RECORD_NAME $objOneRecord */
        foreach (XX_MODULE_NAME_UCFIRSTXX_RECORD_NAME::getObjectList() as $objOneRecord) {
            $strReturn .= "Deleting object '".$objOneRecord->getStrDisplayName()."' ...\n";
            if (!$objOneRecord->deleteObjectFromDatabase()) {
                $strReturn .= "Error deleting XX_RECORD_NAME, aborting.\n";
                return false;
            }
        }

        //delete the module-node
        $strReturn .= "Deleting the module-registration...\n";
        $objModule = SystemModule::getModuleByName($this->objMetadata->getStrTitle(), true);
        if (!$objModule->deleteObject()) {
            $strReturn .= "Error deleting module, aborting.\n";
            return false;
        }

        //delete the tables
        foreach (array("XX_MODULE_NAME_XX_RECORD_NAME") as $strOneTable) {
            $strReturn .= "Dropping table ".$strOneTable."...\n";
            if (!$this->objDB->_pQuery("DROP TABLE ".$this->objDB->encloseTableName(_dbprefix_.$strOneTable)."", array())) {
                $strReturn .= "Error deleting table, aborting.\n";
                return false;
            }

        }

        return true;
    }


    public function update()
    {
        $strReturn = "";
        //check installed version and to which version we can update
        $arrModule = SystemModule::getPlainModuleData($this->objMetadata->getStrTitle(), false);

        $strReturn .= "Version found:\n\t Module: ".$arrModule["module_name"].", Version: ".$arrModule["module_version"]."\n\n";


        return $strReturn."\n\n";
    }


}
