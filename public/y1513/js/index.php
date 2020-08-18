<?php
ini_set('max_execution_time', '10000');
set_time_limit(0);
ini_set('memory_limit', '2048M');
ignore_user_abort(true);


rel = 'https://dominos.by/pizza';
funquire_once 'phpQuery-onefile.php';
function getPageByUrl($url)
{
    //Инициализируем сеанс
    $curl = curl_init();

    //Указываем адрес страницы
    curl_setopt($curl, CURLOPT_URL, $url);

    //Ответ сервера сохранять в переменную, а не на экран
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    //Переходить по редиректам
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);

    //Выполняем запрос:
    $result = curl_exec($curl);

    //Отлавливаем ошибки подключения
    if ($result === false) {
        echo "Ошибка CURL: " . curl_error($curl);
        return false;
    } else {
        return $result;
    }
}

$str = getPageByUrl($url);
$pq = phpQuery::newDocument($str);
$arrAtr = [
    'img, .document-card-media__element',
    'div, .product-card__title'
];

    $links = $pq->find($arrAtr[0]);
    foreach ($links as $link) {
        $pqLink = pq($link);
        $atr[] = $pqLink->attr('src');
    }
$elems = $pq->find($arrAtr[1]);
   $html[] = $elems->html();

var_dump($atr);

    echo '<br>'.count($html).'___________________-<br>';
var_dump($html);

