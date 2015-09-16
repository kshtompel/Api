<?php

/*
 * This file is part of the Api package
 *
 * (c) FiveLab
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code
 */

namespace FiveLab\Component\Api\EventListener;

use FiveLab\Component\Api\Event\ActionViewEvent;
use FiveLab\Component\Api\ApiEvents;
use FiveLab\Component\Api\Response\EmptyResponse;
use FiveLab\Component\Api\Response\ObjectTransformableResponse;
use FiveLab\Component\Api\Response\Response;
use FiveLab\Component\Exception\UnexpectedTypeException;
use FiveLab\Component\ModelNormalizer\Exception\UnsupportedClassException as NormalizerUnsupportedObjectException;
use FiveLab\Component\ModelNormalizer\ModelNormalizerManagerInterface;
use FiveLab\Component\ModelTransformer\Exception\UnsupportedClassException as TransformerUnsupportedObjectException;
use FiveLab\Component\ModelTransformer\ModelTransformerManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Transform response, if necessary
 * For use this subscriber, the packages "fivelab/model-transformer" and "fivelab/model-normalizer"
 * must be installed.
 *
 * @author Vitaliy Zhuk <v.zhuk@fivelab.org>
 */
class ResponseTransformableSubscriber implements EventSubscriberInterface
{
    /**
     * @var ModelTransformerManagerInterface
     */
    private $transformerManager;

    /**
     * @var ModelNormalizerManagerInterface
     */
    private $normalizerManager;

    /**
     * Construct
     *
     * @param ModelTransformerManagerInterface $transformerManager
     * @param ModelNormalizerManagerInterface  $normalizerManager
     */
    public function __construct(
        ModelTransformerManagerInterface $transformerManager,
        ModelNormalizerManagerInterface $normalizerManager
    ) {
        $this->normalizerManager = $normalizerManager;
        $this->transformerManager = $transformerManager;
    }

    /**
     * Transform object response
     *
     * @param ActionViewEvent $event
     */
    public function transformObjectResponse(ActionViewEvent $event)
    {
        $data = $event->getData();

        if ($data instanceof ObjectTransformableResponse) {
            $response = $this->doTransformObjectResponse($data);
            $event->setResponse($response);
        }
    }

    /**
     * Transform object. Try create a object response via object in response.
     *
     * @param ActionViewEvent $event
     */
    public function transformObject(ActionViewEvent $event)
    {
        $data = $event->getData();

        if (is_array($data)) {
            $data = new \ArrayObject($data);
        }

        if ($this->normalizerManager->supports($data) && !$this->transformerManager->supports($data)) {
            $objectResponse = new ObjectTransformableResponse($data);
            $objectResponse->removeActionTransform();

            $response = $this->doTransformObjectResponse($objectResponse);
            $event->setResponse($response);
        }

        if ($this->transformerManager->supports($data)) {
            $objectResponse = new ObjectTransformableResponse($data);

            $response = $this->doTransformObjectResponse($objectResponse);
            $event->setResponse($response);
        }
    }

    /**
     * Process transform object response
     *
     * @param ObjectTransformableResponse $objectResponse
     *
     * @return Response
     */
    private function doTransformObjectResponse(ObjectTransformableResponse $objectResponse)
    {
        $responseData = $objectResponse;

        if ($objectResponse->isActionTransform()) {
            try {
                $responseData = $this->transformerManager->transform(
                    $responseData->getObject(),
                    $objectResponse->getTransformerContext()
                );

                if (!is_object($responseData)) {
                    throw UnexpectedTypeException::create($responseData, 'object');
                }
            } catch (TransformerUnsupportedObjectException $e) {
                throw new \RuntimeException(sprintf(
                    'Can not transform object with class "%s".',
                    get_class($objectResponse)
                ), 0, $e);
            }
        }

        try {
            $responseData = $this->normalizerManager->normalize(
                $responseData instanceof ObjectTransformableResponse ? $responseData->getObject() : $responseData,
                $objectResponse->getNormalizerContext()
            );

            if (!is_array($responseData)) {
                throw UnexpectedTypeException::create($responseData, 'array');
            }
        } catch (NormalizerUnsupportedObjectException $e) {
            throw new \RuntimeException(sprintf(
                'Can not normalize object with class "%s".',
                get_class($responseData)
            ), 0, $e);
        }

        if ($objectResponse->isEmptyResponse()) {
            $response = new EmptyResponse($responseData, $objectResponse->getHttpStatusCode());
        } else {
            $response = new Response($responseData, $objectResponse->getHttpStatusCode());
        }

        return $response;
    }

    /**
     * {@inheritDoc}
     */
    public static function getSubscribedEvents()
    {
        return [
            ApiEvents::ACTION_VIEW => [
                ['transformObjectResponse'],
                ['transformObject']
            ]
        ];
    }
}
