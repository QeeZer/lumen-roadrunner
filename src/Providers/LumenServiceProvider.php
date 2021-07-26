<?php


namespace QeeZer\LumenRoadRunner\Providers;

use Illuminate\Console\Command;
use Illuminate\Support\ServiceProvider;
use QeeZer\LumenRoadRunner\Console\RoadRunnerCommand;

class LumenServiceProvider extends ServiceProvider
{
    /**
     * register
     */
    public function register(): void
    {
        $this->registerCommand();

        $this->commands('qeezer.road-runner.cmd');
    }

    /**
     * register command
     */
    protected function registerCommand(): void
    {
        $this->app->singleton('qeezer.road-runner.cmd', function () {
            return new RoadRunnerCommand;
        });
    }
}
