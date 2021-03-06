<?php

namespace InetStudio\FAQ\Console\Commands;

use InetStudio\AdminPanel\Base\Console\Commands\BaseSetupCommand;

/**
 * Class SetupCommand.
 */
class SetupCommand extends BaseSetupCommand
{
    /**
     * Имя команды.
     *
     * @var string
     */
    protected $name = 'inetstudio:faq:setup';

    /**
     * Описание команды.
     *
     * @var string
     */
    protected $description = 'Setup faq package';

    /**
     * Инициализация команд.
     */
    protected function initCommands(): void
    {
        $this->calls = [
            [
                'type' => 'artisan',
                'description' => 'FAQ questions setup',
                'command' => 'inetstudio:faq:questions:setup',
            ],
            [
                'type' => 'artisan',
                'description' => 'FAQ tags setup',
                'command' => 'inetstudio:faq:tags:setup',
            ],
        ];
    }
}
