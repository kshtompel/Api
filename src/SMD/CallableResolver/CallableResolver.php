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
use FiveLab\Component\Api\SMD\Action\CallableAction;
use FiveLab\Component\Exception\UnexpectedTypeException;

/**
 * Closure resolver
 *
 * @author Vitaliy Zhuk <v.zhuk@fivelab.org>
 */
class CallableResolver implements CallableResolverInterface
{
    /**
     * {@inheritDoc}
     */
    public function isSupported(ActionInterface $action)
    {
        return $action instanceof CallableAction;
    }

    /**
     * {@inheritDoc}
     */
    public function resolve(ActionInterface $action)
    {
        if (!$action instanceof CallableAction) {
            throw UnexpectedTypeException::create($action, 'FiveLab\Component\Api\SMD\Action\CallableAction');
        }

        $callable = $action->getCallable();
        $object = null;

        if ($callable instanceof \Closure) {
            $reflection = new \ReflectionFunction($action->getCallable());
        } else if (is_array($callable)) {
            if (is_object($callable[0])) {
                $object = $callable[0];
                $reflection = new \ReflectionMethod(get_class($callable[0]), $callable[1]);
            } else {
                $reflection = new \ReflectionMethod($callable[0], $callable[1]);
            }
        } else if (function_exists($callable)) {
            $reflection = new \ReflectionFunction($callable);
        } else {
            throw new \RuntimeException(sprintf(
                'Could not resolve reflection for callable "%s".',
                is_object($callable) ? get_class($callable) : gettype($callable)
            ));
        }

        return new BaseCallable($reflection, $object);
    }
}
