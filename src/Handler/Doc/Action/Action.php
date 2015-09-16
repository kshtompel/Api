<?php

/*
 * This file is part of the Api package
 *
 * (c) FiveLab
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code
 */

namespace FiveLab\Component\Api\Handler\Doc\Action;

/**
 * Action documentation
 *
 * @author Vitaliy Zhuk <v.zhuk@fivelab.org>
 */
class Action implements \Serializable
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var Parameter[]
     */
    protected $parameters;

    /**
     * Construct
     *
     * @param string            $name
     * @param string            $description
     * @param array|Parameter[] $parameters
     */
    public function __construct($name, $description, array $parameters = [])
    {
        $this->name = $name;
        $this->description = $description;
        $this->parameters = $parameters;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Get request
     *
     * @return array|Parameter[]
     */
    public function getParameters()
    {
        return $this->parameters;
    }

    /**
     * {@inheritDoc}
     */
    public function serialize()
    {
        return serialize([
            $this->name,
            $this->description,
            $this->parameters
        ]);
    }

    /**
     * {@inheritDoc}
     */
    public function unserialize($serialized)
    {
        list(
            $this->name,
            $this->description,
            $this->parameters
        ) = unserialize($serialized);
    }
}
