<?php
/**
 * Created by PhpStorm.
 * User: sidler
 * Date: 27.10.14
 * Time: 10:51
 */

include_once "bootstrap.php";

\de\mulchprod\kajona\modulegenerator\controller\ConfigManager::updateConfigFromRequest();

if(isset($_POST["generate"])) {
    $objGenerator = new \de\mulchprod\kajona\modulegenerator\controller\GenerationController();
    $objGenerator->generateModule();
}

$objView = new \de\mulchprod\kajona\modulegenerator\view\ConfigView();
echo $objView->generateView();

\de\mulchprod\kajona\modulegenerator\controller\ConfigManager::saveCurrentConfig();