<?php

/*
 * This file is part of the Api package
 *
 * (c) FiveLab
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code
 */

namespace FiveLab\Component\Api\EventListener;

use FiveLab\Component\Api\ApiEvents;
use FiveLab\Component\Reflection\Reflection;
use FiveLab\Component\Api\Event\ActionDispatchEvent;
use FiveLab\Component\Api\Event\ActionExceptionEvent;
use FiveLab\Component\Api\Event\ActionViewEvent;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Logger API actions.
 *
 * @author Vitaliy Zhuk <v.zhuk@fivelab.org>
 */
class LoggerSubscriber implements EventSubscriberInterface
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * Construct
     *
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * On pre dispatch event
     *
     * @param ActionDispatchEvent $event
     */
    public function onPreDispatch(ActionDispatchEvent $event)
    {
        $message = sprintf(
            'Match callable "%s" for action "%s".',
            Reflection::getCalledMethod($event->getCallable()->getReflection()),
            $event->getAction()->getName()
        );

        $this->logger->debug($message);
    }

    /**
     * On post dispatch
     *
     * @param ActionDispatchEvent $event
     */
    public function onPostDispatch(ActionDispatchEvent $event)
    {
        $message = sprintf(
            'Complete handle API method "%s". Response object: %s',
            $event->getAction()->getName(),
            get_class($event->getResponse())
        );

        $this->logger->debug($message);
    }

    /**
     * On view event
     *
     * @param ActionViewEvent $event
     */
    public function onView(ActionViewEvent $event)
    {
        $message = sprintf(
            'The action "%s" return not ResponseInterface instance. Try create Response instance via result data...',
            $event->getAction()->getName()
        );

        $this->logger->debug($message);
    }

    /**
     * On exception
     *
     * @param ActionExceptionEvent $event
     */
    public function onException(ActionExceptionEvent $event)
    {
        $e = $event->getException();

        $message = sprintf(
            'API Exception: "%s" (%s) in file %s on line %d',
            $e->getMessage(),
            get_class($e),
            $e->getFile(),
            $e->getLine()
        );

        $this->logger->error($message);
    }

    /**
     * {@inheritDoc}
     */
    public static function getSubscribedEvents()
    {
        return [
            ApiEvents::ACTION_PRE_DISPATCH => [
                ['onPreDispatch', 128]
            ],

            ApiEvents::ACTION_POST_DISPATCH => [
                ['onPostDispatch', 128]
            ],

            ApiEvents::ACTION_VIEW => [
                ['onView', 128]
            ],

            ApiEvents::ACTION_EXCEPTION => [
                ['onException', 128]
            ]
        ];
    }
}
