<?php


namespace QeeZer\LumenRoadRunner\Contracts;


use Illuminate\Contracts\Container\Container;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

interface ModifierContract
{
    /**
     * worker init
     * @param Container $app
     */
    public function init(Container $app): void;

    /**
     * before request callback
     * @param Container $app
     * @param Request $request
     * @return Request
     */
	public function beforeRequest(Container $app, Request $request): Request;

    /**
     * before response callback
     * @param Container $app
     * @param Request $request
     * @param Response $response
     * @return Response
     */
	public function afterRequest(Container $app, Request $request, Response $response): Response;
}
