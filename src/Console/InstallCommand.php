<?php

namespace Cherish\Ly\Console;

use Illuminate\Console\Command;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ly:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run the commands necessary to prepare Mojito for use';

    /**
     * Execute the console command.
     *
     * @author moell<moel91@foxmail.com>
     * @return mixed
     */
    public function handle()
    {
        $this->call('vendor:publish', ['--provider' => 'Spatie\Permission\PermissionServiceProvider']);
        $this->call('vendor:publish', ['--provider' => 'Cherish\Ly\Providers\LyServiceProvider']);
        $this->call('vendor:publish', ['--provider' => 'Laravel\Sanctum\SanctumServiceProvider']);
    }
}
