<?php

return [
    'sensor_node_types' => [
        'B-Sprouts v1' => [
            'name' => 'B-Sprouts Urban Farming Prototype v1',
            'class' => '',
            'manufacturer' => 'B-Srpouts',
            'sensors' => [
                [
                    'name' => 'Air Temperature',
                    'type' => 'air',
                    'unit' => 'Celcius',
                    'icon' => 'cloud'
                ],
                [
                    'name' => 'Soil Temperature',
                    'type' => 'soil',
                    'unit' => 'Celcius'
                ],
                [
                    'name' => 'Water Temperature',
                    'unit' => 'Celcius',
                    'icon' => 'tint'
                ]
            ]
        ],
        'B-Sprouts v2' => [
            'name' => 'B-Sprouts Urban Farming Prototype v2',
            'manufacturer' => 'B-Srpouts',
            'sensors' => [
                [
                    'name' => 'Solar Lumen',
                    'type' => 'radiation',
                    'unit' => 'lumen',
                    'icon' => 'sun-o'
                ]
            ]
        ]
    ]

];