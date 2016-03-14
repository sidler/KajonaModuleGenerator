<?php
/*"******************************************************************************************************
*   (c) 2007-2016 by Kajona, www.kajona.de                                                              *
*       Published under the GNU LGPL v2.1, see https://github.com/kajona/kajonacms/blob/master/LICENCE  *
********************************************************************************************************/

namespace Kajona\XX_MODULE_NAME_UCFIRST\Portal\Elements;

use Kajona\Pages\Portal\ElementPortal;
use Kajona\Pages\Portal\PortalElementInterface;
use Kajona\System\System\SystemModule;


/**
 * Portal-part of the XX_MODULE_NAME-element
 *
 * @package module_XX_MODULE_NAME
 * @author XX_AUTHOR_EMAIL
 * @targetTable element_universal.content_id
 */
class ElementXX_MODULE_NAME_UCFIRSTPortal extends ElementPortal implements PortalElementInterface {


    /**
     * Loads the XX_MODULE_NAME-controller and passes control
     *
     * @return string
     */
    public function loadData() {
        $strReturn = "";
        //Load the data
        $objModuleController = SystemModule::getModuleByName("XX_MODULE_NAME");
        if($objModuleController != null) {
            $objPortalController = $objModuleController->getPortalInstanceOfConcreteModule($this->arrElementData);
            $strReturn = $objPortalController->action();
        }
        return $strReturn;
    }

}
