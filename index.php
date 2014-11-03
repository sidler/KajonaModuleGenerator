<?php
/**
 * Created by PhpStorm.
 * User: sidler
 * Date: 27.10.14
 * Time: 10:51
 */

include_once "bootstrap.php";

\de\mulchprod\kajona\modulegenerator\model\ConfigManager::updateConfigFromRequest();

$objView = new \de\mulchprod\kajona\modulegenerator\view\ConfigView();
echo $objView->generateView();

\de\mulchprod\kajona\modulegenerator\model\ConfigManager::saveCurrentConfig();