<?php

/*
 * This file is part of the Api package
 *
 * (c) FiveLab
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code
 */

namespace FiveLab\Component\Api\Handler\Doc\Handler;

use FiveLab\Component\Api\Handler\Doc\Action\ActionCollection;

/**
 * Handler documentation
 *
 * @author Vitaliy Zhuk <v.zhuk@fivelab.org>
 */
class Handler
{
    /**
     * @var ActionCollection
     */
    protected $actions;

    /**
     * Construct
     *
     * @param ActionCollection $actions
     */
    public function __construct(ActionCollection $actions)
    {
        $this->actions = $actions;
    }

    /**
     * Get actions
     *
     * @return ActionCollection
     */
    public function getActions()
    {
        return $this->actions;
    }
}
