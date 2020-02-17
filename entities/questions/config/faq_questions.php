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

    'mails_persons' => [
        'send' => false,
        'to' => [],
        'subject' => 'Новый вопрос',
        'headers' => [],
    ],

    'mails_users' => [
        'send' => false,
        'subject' => 'Ответ на вопрос',
        'headers' => [],
    ],

    'queue' => [
        'enable' => false,
        'name' => 'faq_questions_notify',
    ],

    'list_styles' => [
        [
            'text' => 'h2',
            'value' => 'h2',
        ],
        [
            'text' => 'h3',
            'value' => 'h3',
        ],
    ],
];
