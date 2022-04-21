<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class EnvGenerate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'env:generate {--force}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Copy .env.example to .env.';

    private $envPath;

    public function __construct()
    {
        parent::__construct();

        $this->envPath = base_path('.env');
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $envPath = base_path('.env');

        if (File::exists($envPath) 
            && !$this->option('force')) {
            $this->info('.env file exists. if you want to regenerate use --force.');
        } else {
            $this->copyEnvExample();
        }

        return 0;
    }

    private function copyEnvExample()
    {
        $result = File::copy(
            base_path('.env.example'),
            $this->envPath
        );

        if ($result) {
            $this->info('.env file generated sucssfully.');
        } else {
            $this->error('Failed.');
        }
    }
}
