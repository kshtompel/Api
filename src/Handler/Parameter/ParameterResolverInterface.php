<?php

/*
 * This file is part of the Api package
 *
 * (c) FiveLab
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code
 */

namespace FiveLab\Component\Api\Handler\Parameter;

use FiveLab\Component\Api\SMD\Action\ActionInterface;
use FiveLab\Component\Api\SMD\CallableResolver\CallableInterface;

/**
 * All parameter resolvers should be implemented of this interface
 *
 * @author Vitaliy Zhuk <v.zhuk@fivelab.org>
 */
interface ParameterResolverInterface
{
    /**
     * Resolve arguments
     *
     * @param ActionInterface   $action
     * @param CallableInterface $callable
     * @param array             $inputParameters
     *
     * @return array
     */
    public function resolve(ActionInterface $action, CallableInterface $callable, array $inputParameters);
}
