<?php


namespace QeeZer\LumenRoadRunner\Contracts;


use Illuminate\Contracts\Container\Container;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

interface ModifierContract
{
	public function beforeRequest(Container $app, ServerRequestInterface $request): void;

	public function afterRequest(Container $app, ServerRequestInterface $request, ResponseInterface $response): void;
}