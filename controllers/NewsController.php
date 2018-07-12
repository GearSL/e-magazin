<?php

/**
 * Created by PhpStorm.
 * User: Gear
 * Date: 03.07.2018
 * Time: 0:12
 */
include_once ROOT . '/models/News.php';

class NewsController
{
    // action for view list news
    public function actionIndex()
    {
        $newsList = array();
        $newsList = News::getNewsList();

        require_once(ROOT . '/views/news/index.php');

        return true;
    }

    public function actionView($id)
    {
        $newsItem = News::getNewsItemById($id);
        echo '<pre>';
        print_r($newsItem);
        echo '</pre>';

        return true;
    }
}