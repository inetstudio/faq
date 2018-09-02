<?php

return [

    /*
     * Расширение файла конфигурации app/config/filesystems.php
     * добавляет локальные диски для хранения лого сайтов
     */

    'faq_questions' => [
        'driver' => 'local',
        'root' => storage_path('app/public/faq_questions'),
        'url' => env('APP_URL').'/storage/faq_questions',
        'visibility' => 'public',
    ],

];
