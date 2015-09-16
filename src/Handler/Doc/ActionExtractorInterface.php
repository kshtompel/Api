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

use FiveLab\Component\Api\SMD\Action\ActionInterface;

/**
 * All action doc Extractors should be implemented of this interface
 *
 * @author Vitaliy Zhuk <v.zhuk@fivelab.org>
 */
interface ActionExtractorInterface
{
    /**
     * Generate documentation for action
     *
     * @param ActionInterface $action
     *
     * @return Action\Action
     */
    public function extractAction(ActionInterface $action);
}
