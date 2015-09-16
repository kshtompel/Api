<?php

/*
 * This file is part of the Api package
 *
 * (c) FiveLab
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code
 */

namespace FiveLab\Component\Api\Handler\Builder;

/**
 * All handler builders should implement of this interface
 */
interface HandlerBuilderInterface
{
    /**
     * Build handler
     *
     * @return \FiveLab\Component\Api\Handler\HandlerInterface
     */
    public function buildHandler();

    /**
     * Build doc extractor for this handler
     *
     * @return \FiveLab\Component\Api\Handler\Doc\ExtractorInterface
     */
    public function buildDocExtractor();
}
