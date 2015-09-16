<?php

/*
 * This file is part of the Api package
 *
 * (c) FiveLab
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code
 */

namespace FiveLab\Component\Api\Doc;

use FiveLab\Component\Api\Handler\Doc\ExtractorInterface;
use FiveLab\Component\Api\Doc\Formatter\FormatterRegistryInterface;
use FiveLab\Component\Api\Handler\HandlerInterface;

/**
 * Generate documentation for API methods
 *
 * @author Vitaliy Zhuk <v.zhuk@fivelab.org>
 */
class DocGenerator implements DocGeneratorInterface
{
    /**
     * @var ExtractorInterface
     */
    private $extractor;

    /**
     * @var FormatterRegistryInterface
     */
    private $formatterRegistry;

    /**
     * Construct
     *
     * @param ExtractorInterface         $extractor
     * @param FormatterRegistryInterface $formatterRegistry
     */
    public function __construct(ExtractorInterface $extractor, FormatterRegistryInterface $formatterRegistry)
    {
        $this->extractor = $extractor;
        $this->formatterRegistry = $formatterRegistry;
    }

    /**
     * {@inheritDoc}
     */
    public function hasFormatter($key)
    {
        return $this->formatterRegistry->hasFormatter($key);
    }

    /**
     * {@inheritDoc}
     */
    public function generate(HandlerInterface $handler, $outputFormat)
    {
        $documentation = $this->extractor->extract($handler);

        return $this->formatterRegistry->render($documentation, $outputFormat);
    }
}
