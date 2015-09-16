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

/**
 * All API responses should be implemented of this interface
 *
 * @author Vitaliy Zhuk <v.zhuk@fivelab.org>
 */
interface ResponseInterface
{
    /**
     * Get data
     *
     * @return mixed
     */
    public function getData();

    /**
     * Get http status code
     *
     * @return int
     */
    public function getHttpStatusCode();

    /**
     * Get headers
     *
     * @return \Symfony\Component\HttpFoundation\HeaderBag
     */
    public function getHeaders();
}
