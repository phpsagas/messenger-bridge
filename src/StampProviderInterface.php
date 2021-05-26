<?php

namespace PhpSagas\MessengerBridge;

use PhpSagas\Contracts\CommandMessageInterface;
use Symfony\Component\Messenger\Stamp\StampInterface;

/**
 * Allows to add arbitrary stamps to dispatching message.
 */
interface StampProviderInterface
{
    /**
     * @param CommandMessageInterface $message
     *
     * @return StampInterface[]
     */
    public function getStamps(CommandMessageInterface $message): array;
}
