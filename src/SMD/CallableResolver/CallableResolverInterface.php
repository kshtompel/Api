<?php

/*
 * This file is part of the Api package
 *
 * (c) FiveLab
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code
 */

namespace FiveLab\Component\Api\SMD\CallableResolver;

use FiveLab\Component\Api\SMD\Action\ActionInterface;

/**
 * Callable resolver. Resolver callbacks by action
 *
 * @author Vitaliy Zhuk <v.zhuk@fivelab.org>
 */
interface CallableResolverInterface
{
    /**
     * Is supported action
     *
     * @param ActionInterface $action
     *
     * @return bool
     */
    public function isSupported(ActionInterface $action);

    /**
     * Get reflection for actions
     *
     * @param ActionInterface $action
     *
     * @return CallableInterface
     */
    public function resolve(ActionInterface $action);
}
