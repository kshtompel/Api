<?php

/*
 * This file is part of the Api package
 *
 * (c) FiveLab
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code
 */

namespace FiveLab\Component\Api\Handler;

/**
 * All API handlers should be implemented of this interface
 *
 * @author Vitaliy Zhuk <v.zhuk@fivelab.org>
 */
interface HandlerInterface
{
    /**
     * Get errors
     *
     * @return \FiveLab\Component\Error\Errors
     */
    public function getErrors();

    /**
     * Get actions
     *
     * @return \FiveLab\Component\Api\SMD\Action\ActionCollection|\FiveLab\Component\Api\SMD\Action\ActionInterface[]
     */
    public function getActions();

    /**
     * Handle
     *
     * @param string $method     The method name for call
     * @param array  $parameters Named parameters
     *
     * @return \FiveLab\Component\Api\Response\ResponseInterface
     */
    public function handle($method, array $parameters);
}
