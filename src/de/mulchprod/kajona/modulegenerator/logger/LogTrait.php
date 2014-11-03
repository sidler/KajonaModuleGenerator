<?php
/**
 * Created by PhpStorm.
 * User: sidler
 * Date: 03.11.14
 * Time: 09:56
 */

namespace de\mulchprod\kajona\modulegenerator\logger;


trait LogTrait {

    private function log($strContent) {
        Logger::getInstance()->log($strContent);
    }
} 