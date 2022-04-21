<?php

namespace App\Console\Commands;

use App\Console\Env;
use Exception;
use Illuminate\Console\Command;

class EnvGenerate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'env:generate {--force} {--no-error : Prevent return error code.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Copy .env.example to .env.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            $this->generate();

            return 0;
        } catch (Exception $ex) {
            $this->error($ex->getMessage());

            return $this->option('no-error') ? 0 : 1;
        }
    }

    private function generate()
    {
        if (!Env::exists() || $this->option('force')) {
            Env::replaceExample();
            Env::updateAppKey();

            $this->info('.env file generated sucssfully.');
            $this->info('Application key set successfully.');
        } else {
            throw new Exception('.env file exists. if you want to regenerate use --force.');
        }
    }
}
