<?php

function getBeautifulDate($date) {
    $monthes = array(
        1 => 'янв', 2 => 'фев', 3 => 'мар', 4 => 'апр',
        5 => 'мая', 6 => 'июн', 7 => 'июл', 8 => 'авг',
        9 => 'сен', 10 => 'окт', 11 => 'ноя', 12 => 'дек'
    );
    $days = array(
        'Вс', 'Пн', 'Вт', 'Ср',
        'Чт', 'Пт', 'Сб'
    );

    $day = $days[date_format(date_create($date), 'w')];
    $dig = date_format(date_create($date), 'j');
    $month = $monthes[date_format(date_create($date), 'n')];
    $year = date_format(date_create($date), 'Y');
    $time = date_format(date_create($date), 'H:i');
    $beautifulDate = "$day, $dig $month $year $time";

    return $beautifulDate;
}