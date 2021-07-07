<?php


namespace QeeZer\LumenRoadRunner\Console;


use Illuminate\Console\Command;

class RoadRunnerCommand extends Command
{
	protected $signature = 'rr:run';

	public function handle()
	{
		$app = $this->getLaravel();
	}
}