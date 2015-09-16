<?php

/*
 * This file is part of the Api package
 *
 * (c) FiveLab
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code
 */

namespace FiveLab\Component\Api\Annotation;

/**
 * Indicate of API action
 *
 * @Annotation
 * @Target("METHOD")
 *
 * @author Vitaliy Zhuk <v.zhuk@fivelab.org>
 */
class Action
{
    /**
     * Action name. As example: "system.ping"
     *
     * @var string @Required
     */
    public $name;

    /**
     * Validation groups. As example: {"Update", "EmailUnique"}
     *
     * @var array
     */
    public $validationGroups = ['Default'];

    /**
     * Construct
     *
     * @param array $values
     */
    public function __construct(array $values)
    {
        if (isset($values['value']) && count($values) == 1) {
            $this->name = $values['value'];
        } else {
            foreach ($values as $key => $value) {
                $this->{$key} = $value;
            }
        }
    }
}
