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

use FiveLab\Component\Api\SMD\Loader\LoaderInterface;

/**
 * Base service manager
 *
 * @author Vitaliy Zhuk <v.zhuk@fivelab.org>
 */
class ActionRegistry implements ActionRegistryInterface
{
    /**
     * @var LoaderInterface
     */
    private $loader;

    /**
     * @var \FiveLab\Component\Api\SMD\Action\ActionCollection
     */
    private $actionCollection;

    /**
     * Construct
     *
     * @param LoaderInterface $loader
     */
    public function __construct(LoaderInterface $loader)
    {
        $this->loader = $loader;
    }

    /**
     * {@inheritDoc}
     */
    public function getActions()
    {
        if (null !== $this->actionCollection) {
            return $this->actionCollection;
        }

        $this->actionCollection = $this->loader->loadActions();

        return $this->actionCollection;
    }

    /**
     * {@inheritDoc}
     */
    public function getAction($name)
    {
        return $this->getActions()->getAction($name);
    }

    /**
     * {@inheritDoc}
     */
    public function hasAction($name)
    {
        return $this->getActions()->hasAction($name);
    }
}
