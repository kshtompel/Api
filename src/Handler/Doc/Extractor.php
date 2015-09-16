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

use FiveLab\Component\Api\Handler\Doc\Action\ActionCollection;
use FiveLab\Component\Api\Handler\Doc\Handler\Handler;
use FiveLab\Component\Api\Handler\HandlerInterface;

/**
 * Base doc Extractor
 *
 * @author Vitaliy Zhuk <v.zhuk@fivelab.org>
 */
class Extractor implements ExtractorInterface
{
    /**
     * @var ActionExtractorInterface
     */
    private $actionDocExtractor;

    /**
     * Construct
     *
     * @param ActionExtractorInterface $actionDocExtractor
     */
    public function __construct(ActionExtractorInterface $actionDocExtractor)
    {
        $this->actionDocExtractor = $actionDocExtractor;
    }

    /**
     * {@inheritDoc}
     */
    public function extract(HandlerInterface $handler)
    {
        $actionDocCollection = new ActionCollection();

        foreach ($handler->getActions() as $action) {
            $actionDoc = $this->actionDocExtractor->extractAction($action);

            $actionDocCollection->addAction($actionDoc);
        }

        return new Handler($actionDocCollection);
    }
}
