<?php

/*
 * This file is part of the Api package
 *
 * (c) FiveLab
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code
 */

namespace FiveLab\Component\Api\Server\Exception;

/**
 * Server not found exception
 *
 * @author Vitaliy Zhuk <v.zhuk@fivelab.org>
 */
class ServerNotFoundException extends Exception
{
    /**
     * Create new exception instance with key
     *
     * @param string     $key
     * @param int        $code
     * @param \Exception $prev
     *
     * @return ServerNotFoundException
     */
    public static function create($key, $code = 0, \Exception $prev = null)
    {
        $message = sprintf(
            'Not found server with key "%s".',
            $key
        );

        return new static($message, $code, $prev);
    }
}
