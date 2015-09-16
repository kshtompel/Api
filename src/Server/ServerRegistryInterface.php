<?php

/*
 * This file is part of the Api package
 *
 * (c) FiveLab
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code
 */

namespace FiveLab\Component\Api\Server;

/**
 * All server registry should be implemented of this interface
 *
 * @author Vitaliy Zhuk <v.zhuk@fivelab.org>
 */
interface ServerRegistryInterface
{
    /**
     * Get server
     *
     * @param string $key
     *
     * @return ServerInterface
     *
     * @throws Exception\ServerNotFoundException
     */
    public function getServer($key);
}
