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

use FiveLab\Component\Cache\CacheInterface;

/**
 * Cached loader
 *
 * @author Vitaliy Zhuk <v.zhuk@fivelab.org>
 */
class CachedLoader implements LoaderInterface
{
    /**
     * @var CacheInterface
     */
    private $cache;

    /**
     * @var LoaderInterface
     */
    private $loader;

    /**
     * @var string
     */
    private $key;

    /**
     * Construct
     *
     * @param LoaderInterface $loader
     * @param CacheInterface  $cache
     * @param string          $key
     */
    public function __construct(LoaderInterface $loader, CacheInterface $cache, $key = 'fivelab.api.smd.actions')
    {
        $this->cache = $cache;
        $this->loader = $loader;
        $this->key = $key;
    }

    /**
     * {@inheritDoc}
     */
    public function loadActions()
    {
        $actions = $this->cache->get($this->key);

        if ($actions) {
            return $actions;
        }

        $actions = $this->loader->loadActions();

        $this->cache->set($this->key, $actions);

        return $actions;
    }
}
