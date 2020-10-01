<?php

namespace InetStudio\FAQ\Questions\Contracts\Listeners;

/**
 * Interface SendEmailToUserListenerContract.
 */
interface SendEmailToUserListenerContract
{
    public function handle($event): void;
}
