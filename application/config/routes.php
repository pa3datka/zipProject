<?php
return [
    '' => [
        'controller' => 'home',
        'action' => 'index'
    ],
    'addZip' => [
        'controller' => 'zip',
        'action' => 'addZip'
    ],
    '([0-9a-zA-Z]{5})' => [
        'controller' => 'zip',
        'action' => 'showZip'
    ]
];

