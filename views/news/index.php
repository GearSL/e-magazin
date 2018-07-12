<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <?php foreach ($newsList as $newsItem): ?>
        <a href="/news/<?php echo $newsItem['id'];?>"><?php echo $newsItem['title'];?></a>
    <div class="item"><p><?php echo $newsItem['id'];?></p></div>
    <div class="item"><p><?php echo $newsItem['title'];?></p></div>
    <div class="item"><p><?php echo $newsItem['date'];?></p></div>
    <div class="item"><p><?php echo $newsItem['short_content'];?></p></div>
    <?php endforeach;?>
</body>
</html>