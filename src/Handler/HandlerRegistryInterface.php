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
 * All handler managers should be implemented of this interface
 *
 * @author Vitaliy Zhuk <v.zhuk@fivelab.org>
 */
interface HandlerRegistryInterface
{
    /**
     * Get handler keys
     *
     * @return array
     */
    public function getHandlerKeys();

    /**
     * Get handler
     *
     * @param string $handler
     *
     * @return HandlerInterface
     *
     * @throws \FiveLab\Component\Api\Exception\HandlerNotFoundException
     */
    public function getHandler($handler);
}
