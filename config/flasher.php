<?php 
return [
    'plugins' => [
        'toastr' => [
            'scripts' => [
                '/vendor/flasher/jquery.min.js',
                '/vendor/flasher/toastr.min.js',
                '/vendor/flasher/flasher-toastr.min.js',
            ],
            'styles' => [
                '/vendor/flasher/toastr.min.css',
            ],
            'options' => [
                'closeClass'  => 'toast-close-button',
                'closeButton' => true,
                'positionClass' => 'toast-top-center',
            ],
        ],
    ],
];