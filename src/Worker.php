<?php


namespace QeeZer\LumenRoadRunner;


use Illuminate\Contracts\Container\Container;
use Illuminate\Http\Request;
use QeeZer\LumenRoadRunner\Contracts\WorkerContract;
use Spiral\RoadRunner\Http\PSR7Worker;
use Symfony\Bridge\PsrHttpMessage\Factory\HttpFoundationFactory;
use Symfony\Bridge\PsrHttpMessage\Factory\PsrHttpFactory;

class Worker implements WorkerContract
{
    private $app;
    private $PSR7Worker;
    private $httpFoundationFactory;
    private $psrHttpFactory;

    public function __construct(
        Container $app,
        PSR7Worker $PSR7Worker,
        HttpFoundationFactory $httpFoundationFactory,
        PsrHttpFactory $psrHttpFactory
    )
    {
        $this->app = $app;
        $this->PSR7Worker = $PSR7Worker;
        $this->httpFoundationFactory = $httpFoundationFactory;
        $this->psrHttpFactory = $psrHttpFactory;
    }

    public function serve(): void
    {
        try {
            while ($request = $this->PSR7Worker->waitRequest()) {
                try {
                    $symfonyRequest = $this->httpFoundationFactory->createRequest($request);

                    $lumenRequest = Request::createFromBase($symfonyRequest);

                    $response = $this->app->handle($lumenRequest);

                    $this->PSR7Worker->respond($this->psrHttpFactory->createResponse($response));
                } catch (\Throwable $e) {
                    $this->PSR7Worker->getWorker()->error($e->getMessage());
                }
            }
        } catch (\JsonException $e) {
            $this->PSR7Worker->getWorker()->error($e->getMessage());
        }
    }

}
