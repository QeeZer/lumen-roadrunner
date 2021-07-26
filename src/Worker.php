<?php


namespace QeeZer\LumenRoadRunner;


use Illuminate\Contracts\Container\Container;
use Illuminate\Http\Request;
use JsonException;
use QeeZer\LumenRoadRunner\Contracts\WorkerContract;
use Spiral\RoadRunner\Http\PSR7Worker;
use Symfony\Bridge\PsrHttpMessage\Factory\HttpFoundationFactory;
use Symfony\Bridge\PsrHttpMessage\Factory\PsrHttpFactory;
use Throwable;

class Worker implements WorkerContract
{
    /** @var Container $app */
    private $app;

    /** @var PSR7Worker $PSR7Worker */
    private $PSR7Worker;

    /** @var HttpFoundationFactory $httpFoundationFactory */
    private $httpFoundationFactory;

    /** @var PsrHttpFactory $psrHttpFactory */
    private $psrHttpFactory;

    /**
     * Worker constructor.
     * @param Container $app
     * @param PSR7Worker $PSR7Worker
     * @param HttpFoundationFactory $httpFoundationFactory
     * @param PsrHttpFactory $psrHttpFactory
     */
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

    /**
     * serve run
     */
    public function serve(): void
    {
        try {
            while ($request = $this->PSR7Worker->waitRequest()) {
                try {
                    $symfonyRequest = $this->httpFoundationFactory->createRequest($request);

                    $lumenRequest = Request::createFromBase($symfonyRequest);

                    // pre bind instance to container
                    $this->app->instance('request', $lumenRequest);

                    $response = $this->app->handle($lumenRequest);

                    $this->PSR7Worker->respond($this->psrHttpFactory->createResponse($response));
                } catch (Throwable $e) {
                    $this->PSR7Worker->getWorker()->error($e->getMessage());
                }
            }
        } catch (JsonException $e) {
            $this->PSR7Worker->getWorker()->error($e->getMessage());
        }
    }
}
