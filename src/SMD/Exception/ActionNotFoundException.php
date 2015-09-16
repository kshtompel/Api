<?php

/*
 * This file is part of the Api package
 *
 * (c) FiveLab
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code
 */

namespace FiveLab\Component\Api\SMD\Exception;

use FiveLab\Component\Api\Exception\Exception;

/**
 * Control action not found error
 *
 * @author Vitaliy Zhuk <v.zhuk@fivelab.org>
 */
class ActionNotFoundException extends Exception
{
    /**
     * Create a new exception instance with action name
     *
     * @param string $name
     *
     * @return ActionNotFoundException
     */
    public static function create($name)
    {
        $message = sprintf(
            'Not found action with name "%s".',
            $name
        );

        return new static($message);
    }
}
