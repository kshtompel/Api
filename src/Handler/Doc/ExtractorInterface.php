<?php

/*
 * This file is part of the Api package
 *
 * (c) FiveLab
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code
 */

namespace FiveLab\Component\Api\Handler\Doc;

use FiveLab\Component\Api\Handler\HandlerInterface;

/**
 * All doc Extractors should be implemented of this interface
 *
 * @author Vitaliy Zhuk <v.zhuk@fivelab.org>
 */
interface ExtractorInterface
{
    /**
     * Generate documentation for handler
     *
     * @param HandlerInterface $handler
     *
     * @return Handler\Handler
     */
    public function extract(HandlerInterface $handler);
}
