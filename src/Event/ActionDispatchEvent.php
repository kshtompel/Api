<?php

/*
 * This file is part of the Api package
 *
 * (c) FiveLab
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code
 */

namespace FiveLab\Component\Api\Event;

use FiveLab\Component\Api\Response\ResponseInterface;
use FiveLab\Component\Api\SMD\Action\ActionInterface;
use FiveLab\Component\Api\SMD\CallableResolver\CallableInterface;
use Symfony\Component\EventDispatcher\Event;

/**
 * Action event
 *
 * @author Vitaliy Zhuk <v.zhuk@fivelab.org>
 */
class ActionDispatchEvent extends Event
{
    /**
     * @var ActionInterface
     */
    private $action;

    /**
     * @var CallableInterface
     */
    private $callable;

    /**
     * @var array
     */
    private $parameters;

    /**
     * @var ResponseInterface
     */
    private $response;

    /**
     * Construct
     *
     * @param ActionInterface   $action
     * @param CallableInterface $callable
     * @param array             $parameters
     * @param ResponseInterface $response
     */
    public function __construct(
        ActionInterface $action,
        CallableInterface $callable,
        array $parameters,
        ResponseInterface $response = null
    ) {
        $this->action = $action;
        $this->callable = $callable;
        $this->parameters = $parameters;
        $this->response = $response;
    }

    /**
     * Get action
     *
     * @return ActionInterface
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * Get callable
     *
     * @return CallableInterface $callable
     */
    public function getCallable()
    {
        return $this->callable;
    }

    /**
     * Get parameters
     *
     * @return array
     */
    public function getParameters()
    {
        return $this->parameters;
    }

    /**
     * Get response. Used only on post dispatch event.
     *
     * @return ResponseInterface|null
     */
    public function getResponse()
    {
        return $this->response;
    }
}
