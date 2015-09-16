<?php

/*
 * This file is part of the Api package
 *
 * (c) FiveLab
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code
 */

namespace FiveLab\Component\Api\Doc;

use FiveLab\Component\Api\Handler\HandlerInterface;

/**
 * All doc generators should be implemented of this interface
 *
 * @author Vitaliy Zhuk <v.zhuk@fivelab.org>
 */
interface DocGeneratorInterface
{
    /**
     * Has formatter
     *
     * @param string $format
     *
     * @return bool
     */
    public function hasFormatter($format);

    /**
     * Generate documentation for handler
     *
     * @param HandlerInterface $handler
     * @param string           $outputFormat
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function generate(HandlerInterface $handler, $outputFormat);
}
