<?php
/*"******************************************************************************************************
*   (c) 2007-2016 by Kajona, www.kajona.de                                                              *
*       Published under the GNU LGPL v2.1, see https://github.com/kajona/kajonacms/blob/master/LICENCE  *
********************************************************************************************************/

namespace Kajona\XX_MODULE_NAME_UCFIRST\Admin;

use Kajona\System\Admin\AdminEvensimpler;
use Kajona\System\Admin\AdminInterface;
use Kajona\System\System\Link;
use Kajona\System\System\ModelInterface;


/**
 * Admin controller of the XX_MODULE_NAME-module. Handles all admin requests.
 *
 * @author XX_AUTHOR_EMAIL
 *
 * @objectList Kajona\XX_MODULE_NAME_UCFIRST\System\XX_MODULE_NAME_UCFIRSTXX_RECORD_NAME
 * @objectEdit Kajona\XX_MODULE_NAME_UCFIRST\System\XX_MODULE_NAME_UCFIRSTXX_RECORD_NAME
 * @objectNew  Kajona\XX_MODULE_NAME_UCFIRST\System\XX_MODULE_NAME_UCFIRSTXX_RECORD_NAME
 *
 * @autoTestable list,new
 *
 * @module XX_MODULE_NAME
 * @moduleId _XX_MODULE_NAME_module_id_
 */
class XX_MODULE_NAME_UCFIRSTAdminController extends AdminEvensimpler implements AdminInterface
{


    public function getOutputModuleNavi()
    {
        $arrReturn = array();
        $arrReturn[] = array("view", Link::getLinkAdmin($this->getArrModule("modul"), "list", "", $this->getLang("commons_list"), "", "", true, "adminnavi"));
        return $arrReturn;
    }


    protected function getOutputNaviEntry(ModelInterface $objInstance)
    {
        return Link::getLinkAdmin($this->getArrModule("modul"), $this->getActionNameForClass("edit", $objInstance), "&systemid=".$objInstance->getSystemid(), $objInstance->getStrDisplayName());
    }

}

