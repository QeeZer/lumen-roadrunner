<?php


namespace QeeZer\LumenRoadRunner\Contracts;


interface WorkerContract
{
	/**
	 * run
	 */
	public function serve() :void;
}