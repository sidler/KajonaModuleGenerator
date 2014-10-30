<?php
/**
 * Created by PhpStorm.
 * User: sidler
 * Date: 27.10.14
 * Time: 10:51
 */

include_once "bootsrap.php";

$objView = new \de\mulchprod\kajona\modulegenerator\view\ConfigView();
echo $objView->generateView();