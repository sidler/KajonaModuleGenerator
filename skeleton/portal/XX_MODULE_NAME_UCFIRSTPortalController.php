<?php
/*"******************************************************************************************************
*   (c) 2007-2016 by Kajona, www.kajona.de                                                              *
*       Published under the GNU LGPL v2.1, see https://github.com/kajona/kajonacms/blob/master/LICENCE  *
********************************************************************************************************/

namespace Kajona\XX_MODULE_NAME_UCFIRST\Portal;

use Kajona\Pages\Portal\PagesPortaleditor;
use Kajona\Pages\System\PagesPortaleditorActionEnum;
use Kajona\Pages\System\PagesPortaleditorSystemidAction;
use Kajona\System\Portal\PortalController;
use Kajona\System\Portal\PortalInterface;
use Kajona\System\System\Link;
use Kajona\System\System\TemplateMapper;
use Kajona\XX_MODULE_NAME_UCFIRST\System\XX_MODULE_NAME_UCFIRSTXX_RECORD_NAME;


/**
 * Portal-class of the XX_MODULE_NAME module.
 *
 * @package module_XX_MODULE_NAME
 * @author XX_AUTHOR_EMAIL
 * @module XX_MODULE_NAME
 * @moduleId _XX_MODULE_NAME_module_id_
 */
class XX_MODULE_NAME_UCFIRSTPortalController extends PortalController implements PortalInterface
{


    /**
     * Returns a list of records.
     *
     * @permissions view
     * @return string
     */
    protected function actionList()
    {
        $strReturn = "";

        $strEntries = "";
        //Check rights
        foreach (XX_MODULE_NAME_UCFIRSTXX_RECORD_NAME::getObjectList() as $objOneRecord) {
            if (!$objOneRecord->rightView() || $objOneRecord->getIntRecordStatus() == 0) {
                continue;
            }

            $objMapper = new TemplateMapper($objOneRecord);
            $strEntries .= $objMapper->writeToTemplate("/module_".$this->getArrModule("modul")."/".$this->arrElementData["char1"], "XX_MODULE_NAME_record", false);


            PagesPortaleditor::getInstance()->registerAction(
                new PagesPortaleditorSystemidAction(PagesPortaleditorActionEnum::EDIT(), Link::getLinkAdminHref($this->getArrModule("module"), "edit", "&pe=1&systemid={$objOneRecord->getSystemid()}"), $objOneRecord->getSystemid())
            );

            PagesPortaleditor::getInstance()->registerAction(
                new PagesPortaleditorSystemidAction(PagesPortaleditorActionEnum::DELETE(), Link::getLinkAdminHref($this->getArrModule("module"), "delete", "&systemid={$objOneRecord->getSystemid()}"), $objOneRecord->getSystemid())
            );

            PagesPortaleditor::getInstance()->registerAction(
                new PagesPortaleditorSystemidAction(PagesPortaleditorActionEnum::CREATE(), Link::getLinkAdminHref($this->getArrModule("module"), "new", "&pe=1"), $objOneRecord->getSystemid())
            );
        }

        return $this->objTemplate->fillTemplateFile(array("XX_MODULE_NAME_records" => $strEntries), "/module_".$this->getArrModule("modul")."/".$this->arrElementData["char1"], "XX_MODULE_NAME_list");
    }

}
