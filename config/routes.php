<?php
/**
 * Created by PhpStorm.
 * User: Gear
 * Date: 02.07.2018
 * Time: 22:58
 */
return array(
    'news/([0-9]+)' => 'news/view/$1',
    //'news/([0-9]+)' => 'news/view',     // actionView in NewsController
    'news' => 'news/index',             // actionIndex in NewsController
    //'products' => 'product/list',     // actionList in ProductControllers
);