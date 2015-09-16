<?php

/*
 * This file is part of the Api package
 *
 * (c) FiveLab
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code
 */

namespace FiveLab\Component\Api;

/**
 * Available API event list
 *
 * @author Vitaliy Zhuk <v.zhuk@fivelab.org>
 */
final class ApiEvents
{
    /**
     * Allows to override dispatch logic before action invocation.
     *
     * @see \FiveLab\Component\Api\Event\ActionDispatchEvent
     */
    const ACTION_PRE_DISPATCH       = 'FiveLab.api.action.pre_dispatch';

    /**
     * Allows to override dispatch logic after action invocation.
     *
     * @see \FiveLab\Component\Api\Event\ActionDispatchEvent
     */
    const ACTION_POST_DISPATCH      = 'FiveLab.api.action.post_dispatch';

    /**
     * Transform response
     *
     * @see \FiveLab\Component\Api\Event\ActionViewEvent
     */
    const ACTION_VIEW               = 'FiveLab.api.action.view';

    /**
     * Control exception
     *
     * @see \FiveLab\Component\Api\Event\ActionExceptionEvent
     */
    const ACTION_EXCEPTION          = 'FiveLab.api.action.exception';

    /**
     * Disable constructor
     */
    private function __construct()
    {
    }
}
