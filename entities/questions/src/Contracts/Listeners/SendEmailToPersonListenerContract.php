<?php

namespace InetStudio\FAQ\Questions\Contracts\Listeners;

/**
 * Interface SendEmailToPersonListenerContract.
 */
interface SendEmailToPersonListenerContract
{
    public function handle($event): void;
}
