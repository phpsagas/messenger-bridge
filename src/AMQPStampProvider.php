<?php

namespace PhpSagas\MessengerBridge;

use PhpSagas\Common\AMQP\RoutingKeyMapperInterface;
use PhpSagas\Common\Message\CommandMessage;
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
        $this->routingKeyMapper = $routingKeyMapper;
    }

    /**
     * @inheritDoc
     */
    public function getStamps(CommandMessage $message): array
    {
        $routingKey = $this->routingKeyMapper->transformRoutingKey($message);
        return [
            new AmqpStamp($routingKey, AMQP_NOPARAM),
        ];
    }
}
