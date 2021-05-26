<?php

namespace PhpSagas\MessengerBridge;

use PhpSagas\Contracts\AMQPCommandHeadersEnum;
use PhpSagas\Contracts\CommandMessageInterface;
use PhpSagas\Contracts\ExchangeMapperInterface;
use PhpSagas\Contracts\MessageProducerInterface;
use PhpSagas\Contracts\RoutingKeyMapperInterface;
use Symfony\Component\Messenger\MessageBusInterface;

/**
 * Can be used for send command messages over AMQP transport based on symfony messenger {@link MessageBusInterface}.
 */
class AMQPMessageProducer implements MessageProducerInterface
{
    /** @var MessageBusInterface */
    private $messageBus;
    /** @var ExchangeMapperInterface */
    private $exchangeMapper;
    /** @var RoutingKeyMapperInterface */
    private $routingKeyMapper;
    /** @var StampProviderInterface */
    private $stampProvider;

    public function __construct(
        MessageBusInterface $messageBus,
        ExchangeMapperInterface $exchangeMapper,
        RoutingKeyMapperInterface $routingKeyMapper,
        StampProviderInterface $stampProvider
    ) {
        $this->messageBus = $messageBus;
        $this->exchangeMapper = $exchangeMapper;
        $this->routingKeyMapper = $routingKeyMapper;
        $this->stampProvider = $stampProvider;
    }

    /**
     * @param CommandMessageInterface $message
     */
    public function send(CommandMessageInterface $message): void
    {
        $replyExchange = $this->exchangeMapper->transformReplyExchange($message);
        $replyRoutingKey = $this->routingKeyMapper->transformReplyRoutingKey($message);

        $message->setHeader(AMQPCommandHeadersEnum::REPLY_EXCHANGE, $replyExchange);
        $message->setHeader(AMQPCommandHeadersEnum::REPLY_ROUTING_KEY, $replyRoutingKey);

        $stamps = $this->stampProvider->getStamps($message);

        $this->messageBus->dispatch($message, $stamps);
    }
}
