<?php
$loader = new Phalcon\Loader();
$loader->registerNamespaces(
    array(
        'BuKoli' => dirname(dirname(dirname(__FILE__))) . '/src/BuKoli',
    )
);
$loader->register();
