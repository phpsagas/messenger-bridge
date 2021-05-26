<?php

namespace PhpSagas\MessengerBridge;

use PhpSagas\Contracts\CommandMessageInterface;
use PhpSagas\Contracts\RoutingKeyMapperInterface;
use Symfony\Component\Messenger\Transport\AmqpExt\AmqpStamp;

/**
 * Add necessary AMQP stamps.
 */
class AMQPStampProvider implements StampProviderInterface
{
    /** @var RoutingKeyMapperInterface */
    private $routingKeyMapper;

    public function __construct(RoutingKeyMapperInterface $routingKeyMapper)
    {
        if (!extension_loaded('amqp')) {
            throw new \RuntimeException('Extension amqp is required');
        }

        $this->routingKeyMapper = $routingKeyMapper;
    }

    /**
     * @inheritDoc
     */
    public function getStamps(CommandMessageInterface $message): array
    {
        $routingKey = $this->routingKeyMapper->transformRoutingKey($message);
        return [
            new AmqpStamp($routingKey, AMQP_NOPARAM),
        ];
    }
}
