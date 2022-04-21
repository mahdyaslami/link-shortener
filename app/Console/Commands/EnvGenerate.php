<?php

namespace App\Console\Commands;

use Exception;
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
        try {
            $this->generate();

            return 0;
        } catch (Exception $ex) {
            $this->error($ex->getMessage());

            return 1;
        }
    }

    public function generate()
    {
        if ($this->canCopy()) {
            $this->copyEnvExample();
        }
    }

    private function canCopy()
    {
        if ($this->option('force')) {
            return true;
        }

        if (File::exists($this->envPath)) {
            throw new Exception('.env file exists. if you want to regenerate use --force.');
        }

        return true;
    }

    private function copyEnvExample()
    {
        $result = File::copy(
            base_path('.env.example'),
            $this->envPath
        );

        if ($result) {
            $this->info('.env file generated sucssfully.');
        }

        throw new Exception('Failed to copy .env.example to .env.');
    }
}
