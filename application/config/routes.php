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
<<<<<<< HEAD
        'controller' => 'file',
        'action' => 'showProject'
=======
        'controller' => 'zip',
        'action' => 'showZip'
>>>>>>> 13952c4ca0408ef324bb756bd17f17f81e194151
    ]
];

