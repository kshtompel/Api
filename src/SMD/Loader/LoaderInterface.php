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

/**
 * All SMD loaders should be implemented of this interface
 *
 * @author Vitaliy Zhuk <v.zhuk@fivelab.org>
 */
interface LoaderInterface
{
    /**
     * Get all actions
     *
     * @return \FiveLab\Component\Api\SMD\Action\ActionCollectionInterface
     */
    public function loadActions();
}
