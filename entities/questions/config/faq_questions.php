<?php

return [

    /*
     * Настройки изображений
     */

    'images' => [
        'quality' => 75,
        'conversions' => [
            'question' => [
                'answer' => [
                    'default' => [
                        [
                            'name' => 'answer_admin',
                            'size' => [
                                'width' => 140,
                            ],
                        ],
                        [
                            'name' => 'answer_front',
                            'quality' => 70,
                            'fit' => [
                                'width' => 768,
                                'height' => 512,
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],

    'mails' => [
        'to' => [
            'bukin@inetstudio.ru',
        ],
        'subject' => 'Новый вопрос',
        'headers' => [],
    ],

    'queue' => [
        'enable' => false,
        'name' => 'faq_questions_notify'
    ],
];
