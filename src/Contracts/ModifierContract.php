<?php


namespace QeeZer\LumenRoadRunner\Contracts;


use Illuminate\Contracts\Container\Container;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

interface ModifierContract
{
    public function init(Container $app): void;

	public function beforeRequest(Container $app, ServerRequestInterface $request): ServerRequestInterface;

	public function afterRequest(Container $app, ServerRequestInterface $request, ResponseInterface $response): void;
}
