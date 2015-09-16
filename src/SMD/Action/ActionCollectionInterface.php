<?php

/*
 * This file is part of the Api package
 *
 * (c) FiveLab
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code
 */

namespace FiveLab\Component\Api\SMD\Action;

/**
 * All action collections should be implemented of this interface
 *
 * @author Vitaliy Zhuk <v.zhuk@fivelab.org>
 */
interface ActionCollectionInterface extends \Iterator, \Countable, \Serializable
{
    /**
     * Add action to collection
     *
     * @param ActionInterface $action
     */
    public function addAction(ActionInterface $action);

    /**
     * Add actions
     *
     * @param ActionCollectionInterface $actions
     */
    public function addActions(ActionCollectionInterface $actions);

    /**
     * Get action from collection
     *
     * @param string $name
     *
     * @return ActionInterface
     *
     * @throws \FiveLab\Component\Api\SMD\Exception\ActionNotFoundException
     */
    public function getAction($name);

    /**
     * Has action
     *
     * @param string $name
     *
     * @return bool
     */
    public function hasAction($name);

    /**
     * Remove name
     *
     * @param string $name
     */
    public function removeAction($name);
}
