<?php

/*
 * This file is part of the Api package
 *
 * (c) FiveLab
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code
 */

namespace FiveLab\Component\Api\Response;

use FiveLab\Component\Exception\UnexpectedTypeException;
use FiveLab\Component\ModelTransformer\ContextInterface as TransformerContextInterface;
use FiveLab\Component\ModelTransformer\Context as TransformerContext;
use FiveLab\Component\ModelNormalizer\ContextInterface as NormalizerContextInterface;
use FiveLab\Component\ModelNormalizer\Context as NormalizerContext;

/**
 * Object response. You can set the transform and normalization context and
 * other options for generate real response.
 * The packages "fivelab/model-transformer" and "fivelab/model-normalizer" must be installed.
 *
 * @author Vitaliy Zhuk <v.zhuk@fivelab.org>
 */
class ObjectTransformableResponse
{
    const ACTION_TRANSFORM      = 0b00000001;
    const ACTION_NORMALIZE      = 0b00000010;

    /**
     * @var int
     */
    private $action;

    /**
     * @var object
     */
    private $object;

    /**
     * @var NormalizerContextInterface
     */
    private $normalizerContext;

    /**
     * @var TransformerContextInterface
     */
    private $transformerContext;

    /**
     * @var int
     */
    private $httpStatusCode = 200;

    /**
     * @var bool
     */
    private $emptyResponse = false;

    /**
     * Construct
     *
     * @param object                      $object
     * @param TransformerContextInterface $transformerContext
     * @param NormalizerContextInterface  $normalizerContext
     *
     * @throws UnexpectedTypeException
     */
    public function __construct(
        $object,
        TransformerContextInterface $transformerContext = null,
        NormalizerContextInterface $normalizerContext = null
    ) {
        if (!is_object($object)) {
            throw UnexpectedTypeException::create($object, 'object');
        }

        $this->action = self::ACTION_TRANSFORM | self::ACTION_NORMALIZE;
        $this->object = $object;
    }

    /**
     * Get object
     *
     * @return object
     */
    public function getObject()
    {
        return $this->object;
    }

    /**
     * Add transform action
     *
     * @return ObjectTransformableResponse
     */
    public function addActionTransform()
    {
        $this->action = $this->action | self::ACTION_TRANSFORM;

        return $this;
    }

    /**
     * Remove transform action
     *
     * @return ObjectTransformableResponse
     */
    public function removeActionTransform()
    {
        $this->action = $this->action & ~self::ACTION_TRANSFORM;

        return $this;
    }

    /**
     * Is transform action
     *
     * @return bool
     */
    public function isActionTransform()
    {
        return $this->action & self::ACTION_TRANSFORM;
    }

    /**
     * Is normalize action
     *
     * @return bool
     */
    public function isActionNormalize()
    {
        return $this->action & self::ACTION_NORMALIZE;
    }

    /**
     * Set normalizer context
     *
     * @param NormalizerContextInterface $context
     *
     * @return ObjectTransformableResponse
     */
    public function setNormalizerContext(NormalizerContextInterface $context)
    {
        $this->normalizerContext = $context;

        return $this;
    }

    /**
     * Get normalizer context
     *
     * @return NormalizerContextInterface
     */
    public function getNormalizerContext()
    {
        if ($this->normalizerContext) {
            return $this->normalizerContext;
        }

        return new NormalizerContext();
    }

    /**
     * Set transformer context
     *
     * @param TransformerContextInterface $context
     *
     * @return ObjectTransformableResponse
     */
    public function setTransformerContext(TransformerContextInterface $context)
    {
        $this->transformerContext = $context;

        return $this;
    }

    /**
     * Get transformer context
     *
     * @return TransformerContextInterface
     */
    public function getTransformerContext()
    {
        if ($this->transformerContext) {
            return $this->transformerContext;
        }

        return new TransformerContext();
    }

    /**
     * Set http status code
     *
     * @param int $statusCode
     *
     * @return ObjectTransformableResponse
     */
    public function setHttpStatusCode($statusCode)
    {
        $this->httpStatusCode = $statusCode;

        return $this;
    }

    /**
     * Get http status code
     *
     * @return int
     */
    public function getHttpStatusCode()
    {
        return $this->httpStatusCode;
    }

    /**
     * Set empty response
     *
     * @param bool $emptyResponse
     *
     * @return ObjectTransformableResponse
     */
    public function setEmptyResponse($emptyResponse)
    {
        $this->emptyResponse = (bool) $emptyResponse;

        return $this;
    }

    /**
     * Get empty response
     *
     * @return bool
     */
    public function isEmptyResponse()
    {
        return $this->emptyResponse;
    }
}
