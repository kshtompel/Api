<?php

/*
 * This file is part of the Api package
 *
 * (c) FiveLab
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code
 */

namespace FiveLab\Component\Api\SMD\Loader;

use FiveLab\Component\Api\SMD\Action\ActionCollection;
use FiveLab\Component\Api\SMD\Action\CallableAction;

/**
 * Closure loader
 *
 * @author Vitaliy Zhuk <v.zhuk@fivelab.org>
 */
class CallableLoader implements LoaderInterface
{
    /**
     * @var array|\Closure[]
     */
    private $actions = [];

    /**
     * Add closure action
     *
     * @param string   $name
     * @param callable $callable
     *
     * @return CallableLoader
     */
    public function addCallable($name, $callable)
    {
        $this->actions[$name] = new CallableAction($name, $callable);

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function loadActions()
    {
        return new ActionCollection($this->actions);
    }
}
