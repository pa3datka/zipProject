<?php
return [
    '' => [
        'controller' => 'home',
        'action' => 'index'
    ],
    'addZip' => [
        'controller' => 'archive',
        'action' => 'addZip'
    ],
    '([0-9a-zA-Z]{5})' => [
        'controller' => 'file',
        'action' => 'showProject'
    ]
];

