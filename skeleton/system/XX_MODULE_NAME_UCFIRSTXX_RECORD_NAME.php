<?php
/*"******************************************************************************************************
*   (c) 2007-2016 by Kajona, www.kajona.de                                                              *
*       Published under the GNU LGPL v2.1, see https://github.com/kajona/kajonacms/blob/master/LICENCE  *
********************************************************************************************************/

namespace Kajona\XX_MODULE_NAME_UCFIRST\System;

use Kajona\System\System\Model;
use Kajona\System\System\ModelInterface;
use Kajona\System\System\AdminListableInterface;

/**
 * Model for a XX_MODULE_NAME record object itself
 *
 * @author XX_AUTHOR_EMAIL
 * @targetTable XX_MODULE_NAME_XX_RECORD_NAME_LOWER.XX_RECORD_NAME_id
 *
 * @module XX_MODULE_NAME
 * @moduleId _XX_MODULE_NAME_module_id_
 */
class XX_MODULE_NAME_UCFIRSTXX_RECORD_NAME extends Model implements ModelInterface, AdminListableInterface {

XX_RECORD_PROPERTIES

    /**
     * Returns the icon the be used in lists.
     * Please be aware, that only the filename should be returned, the wrapping by getImageAdmin() is
     * done afterwards.
     *
     * @return string the name of the icon, not yet wrapped by getImageAdmin(). Alternatively, you may return an array containing
     *         [the image name, the alt-title]
     */
    public function getStrIcon() {
        return "icon_dot";
    }

    /**
     * In nearly all cases, the additional info is rendered left to the action-icons.
     *
     * @return string
     */
    public function getStrAdditionalInfo() {
        return "";
    }

    /**
     * If not empty, the returned string is rendered below the common title.
     *
     * @return string
     */
    public function getStrLongDescription() {
        return "";
    }

    /**
     * Returns the name to be used when rendering the current object, e.g. in admin-lists.
     *
     * @return string
     */
    public function getStrDisplayName() {
        return uniStrTrim(XX_GET_STR_DISPLAYNAME, 150);
    }

XX_RECORD_ACCESSORS
}
