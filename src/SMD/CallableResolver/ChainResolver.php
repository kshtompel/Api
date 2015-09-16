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
use FiveLab\Component\Api\SMD\Exception\ActionNotSupportedException;

/**
 * Chain resolver
 *
 * @author Vitaliy Zhuk <v.zhuk@fivelab.org>
 */
class ChainResolver implements CallableResolverInterface
{
    /**
     * @var array|CallableResolverInterface[]
     */
    private $resolvers = [];

    /**
     * Construct
     *
     * @param array|CallableResolverInterface[] $resolvers
     */
    public function __construct(array $resolvers = [])
    {
        foreach ($resolvers as $resolver) {
            $this->addResolver($resolver);
        }
    }

    /**
     * Add resolver
     *
     * @param CallableResolverInterface $resolver
     *
     * @return ChainResolver
     */
    public function addResolver(CallableResolverInterface $resolver)
    {
        $this->resolvers[spl_object_hash($resolver)] = $resolver;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function isSupported(ActionInterface $action)
    {
        foreach ($this->resolvers as $resolver) {
            if ($resolver->isSupported($action)) {
                return true;
            }
        }

        return false;
    }

    /**
     * {@inheritDoc}
     */
    public function resolve(ActionInterface $action)
    {
        foreach ($this->resolvers as $resolver) {
            if ($resolver->isSupported($action)) {
                return $resolver->resolve($action);
            }
        }

        throw new ActionNotSupportedException(sprintf(
            'Can not resolve callback for action "%s".',
            get_class($action)
        ));
    }
}
