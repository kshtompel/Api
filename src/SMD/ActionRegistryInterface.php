<?php

/*
 * This file is part of the Api package
 *
 * (c) FiveLab
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code
 */

namespace FiveLab\Component\Api\SMD;

use FiveLab\Component\Api\SMD\Action\ActionInterface;

/**
 * All service managers should be implemented of this interface
 *
 * @author Vitaliy Zhuk <v.zhuk@fivelab.org>
 */
interface ActionRegistryInterface
{
    /**
     * Get action by name
     *
     * @param string $name
     *
     * @return ActionInterface
     *
     * @throws Exception\ActionNotFoundException
     */
    public function getAction($name);

    /**
     * Get all actions
     *
     * @return \FiveLab\Component\Api\SMD\Action\ActionCollectionInterface
     */
    public function getActions();

    /**
     * Has action
     *
     * @param string $name
     *
     * @return bool
     */
    public function hasAction($name);
}
