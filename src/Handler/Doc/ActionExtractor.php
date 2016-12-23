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

use FiveLab\Component\Api\Handler\Doc\Action\Action;
use FiveLab\Component\Api\Handler\Parameter\ParameterExtractorInterface;
use FiveLab\Component\Api\SMD\Action\ActionInterface;
use FiveLab\Component\Api\SMD\CallableResolver\CallableResolverInterface;
use phpDocumentor\Reflection\DocBlock;
use phpDocumentor\Reflection\DocBlockFactory;

/**
 * Base action doc Extractor
 *
 * @author Vitaliy Zhuk <v.zhuk@fivelab.org>
 */
class ActionExtractor implements ActionExtractorInterface
{
    /**
     * @var CallableResolverInterface
     */
    private $callableResolver;

    /**
     * @var ParameterExtractorInterface
     */
    private $parameterExtractor;

    /**
     * Construct
     *
     * @param CallableResolverInterface   $callableResolver
     * @param ParameterExtractorInterface $parameterExtractor
     */
    public function __construct(
        CallableResolverInterface $callableResolver,
        ParameterExtractorInterface $parameterExtractor = null
    ) {
        $this->callableResolver = $callableResolver;
        $this->parameterExtractor = $parameterExtractor;
    }

    /**
     * {@inheritDoc}
     */
    public function extractAction(ActionInterface $action)
    {
        $callable = $this->callableResolver->resolve($action);

        if ($this->parameterExtractor) {
            $parameters = $this->parameterExtractor->extract($action, $callable);
        } else {
            $parameters = [];
        }

        $reflection = $callable->getReflection();
        $docBlockFactory = DocBlockFactory::createInstance();

        /** @var DocBlock $docBlock */
        $docBlock = $docBlockFactory->create($reflection->getDocComment());

        $description = $docBlock->getSummary();
//        $description = $docBlock->getDescription()->render();
        $actionDoc = new Action($action->getName(), $description, $parameters);

        return $actionDoc;
    }
}
