<?php


namespace QeeZer\LumenRoadRunner\Providers;

use Illuminate\Console\Command;
use Illuminate\Support\ServiceProvider;
use QeeZer\LumenRoadRunner\Console\RoadRunnerCommand;

class LumenServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->registerCommand();

        $this->commands('qeezer.road-runner.cmd');
    }

    protected function registerCommand()
    {
        $this->app->singleton('qeezer.road-runner.cmd', function () {
            return new RoadRunnerCommand;
        });
    }
}
