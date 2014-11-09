<?php
/**
 * Created by PhpStorm.
 * User: sidler
 * Date: 09.11.14
 * Time: 14:29
 */


// create with alias "project.phar"
$phar = new Phar('project.phar', 0, 'project.phar');
// add all files in the project
$phar->buildFromDirectory(dirname(__FILE__));
$phar->setStub('<?php
Phar::webPhar();
__HALT_COMPILER(); ?>');