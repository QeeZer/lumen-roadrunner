<?php


namespace QeeZer\LumenRoadRunner\Console;


use Illuminate\Console\Command;
use Nyholm\Psr7\Factory\Psr17Factory;
use QeeZer\LumenRoadRunner\Worker;
use Spiral\Goridge\StreamRelay;
use Spiral\RoadRunner\Http\PSR7Worker;
use Spiral\RoadRunner\Worker as RRWorker;
use Symfony\Bridge\PsrHttpMessage\Factory\HttpFoundationFactory;
use Symfony\Bridge\PsrHttpMessage\Factory\PsrHttpFactory;

class RoadRunnerCommand extends Command
{
	protected $signature = 'rr:serve';

    /**
     * serve
     */
	public function handle(): void
    {
        $psrFactory = app(Psr17Factory::class);

		$worker = new Worker(
            $this->getLaravel(),
            new PSR7Worker(new RRWorker(new StreamRelay(STDIN, STDOUT)), $psrFactory, $psrFactory, $psrFactory),
            new HttpFoundationFactory,
            new PsrHttpFactory($psrFactory, $psrFactory, $psrFactory, $psrFactory)
        );

		$worker->serve();
	}
}
