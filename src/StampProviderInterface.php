<?php

namespace PhpSagas\MessengerBridge;

use PhpSagas\Common\Message\CommandMessage;
use Symfony\Component\Messenger\Stamp\StampInterface;

/**
 * Allows to add arbitrary stamps to dispatching message.
 */
interface StampProviderInterface
{
    /**
     * @param CommandMessage $message
     *
     * @return StampInterface[]
     */
    public function getStamps(CommandMessage $message): array;
}
