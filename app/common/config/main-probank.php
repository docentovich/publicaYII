<?php

define("PROJECT", PROBANK);

return [
    'bootstrap' => [
        'modules\probank\BackendBootstrap',
        'modules\probank\Bootstrap',
        'modules\tosee\BackendBootstrap',
        'modules\users\Bootstrap',
    ],
];