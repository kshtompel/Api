<?php

/*
 * This file is part of the Api package
 *
 * (c) FiveLab
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code
 */

namespace FiveLab\Component\Api\Doc\Formatter\JsonRpc;

use FiveLab\Component\Api\Handler\Doc\Action\Action;
use FiveLab\Component\Api\Doc\Formatter\FormatterInterface;
use FiveLab\Component\Api\Handler\Doc\Action\ResponseProperty;
use FiveLab\Component\Api\Handler\Doc\Handler\Handler;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * JSON-RPC documentation formatter
 *
 * @author Vitaliy Zhuk <v.zhuk@fivelab.org>
 */
class JsonRpcFormatter implements FormatterInterface
{
    /**
     * {@inheritDoc}
     */
    public function format(Handler $handlerDoc)
    {
        $json = [
            'transport' => 'POST',
            'envelope' => 'JSON-RPC-2.0',
            'contentType' => 'application/json-rpc',
            'SMDVersion' => '2.0',
            'description' => null,
            'methods' => []
        ];

        foreach ($handlerDoc->getActions() as $action) {
            $actionInfo = $this->formatAction($action);

            $json['methods'][$action->getName()] = $actionInfo;
        }

        return $json;
    }

    /**
     * {@inheritDoc}
     */
    public function render(Handler $handlerDoc)
    {
        $json = $this->format($handlerDoc);

        return new JsonResponse($json);
    }

    /**
     * Format action
     *
     * @param Action $action
     *
     * @return array
     */
    private function formatAction(Action $action)
    {
        $info = [
            'envelope' => 'JSON-RPC-2.0',
            'transport' => 'POST',
            'name' => $action->getName(),
            'description' => $action->getDescription(),
            'parameters' => []
        ];

        foreach ($action->getParameters() as $parameter) {
            $parameterInfo = [
                'name' => $parameter->getName(),
                'type' => $parameter->getType(),
                'description' => $parameter->getDescription(),
                'required' => $parameter->isRequired()
            ];

            if (!$parameter->isRequired()) {
                $parameterInfo['default'] = $parameter->getDefault();
            }

            $info['parameters'][] = $parameterInfo;
        }

        return $info;
    }
}
