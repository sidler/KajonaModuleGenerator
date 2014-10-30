<?php
/**
 * Created by PhpStorm.
 * User: sidler
 * Date: 30.10.14
 * Time: 16:36
 */

namespace de\mulchprod\kajona\modulegenerator\view;


class ConfigView {

    public function generateView() {
        $strContent = file_get_contents(__DIR__."/configview.html");

        return $strContent;
    }
} 