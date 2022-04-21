<?php

namespace App\Console\Commands;

use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class EnvUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'env:update {key} {value}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update an environment variable.';

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
            $this->update();

            return 0;
        } catch (Exception $ex) {
            $this->error($ex->getMessage());

            return 1;
        }
    }

    private function update()
    {
        if (File::exists($this->envPath)) {
            $this->updateKeyValue();
        }
    }

    private function updateKeyValue()
    {
        $content = $this->getEnv();
        $key = $this->argument('key');
        $value = $this->argument('value');

        if (Str::contains($content, $key, true)) {
            $content = $this->replaceKeyValue(
                $content,
                $key,
                $value
            );

            $this->saveEnv($content);

            $this->info("the \"{$key}\" value update to \"{$value}\"");
        } else {
            throw new Exception('key does not exists.');
        }
    }

    private function replaceKeyValue($content, $key, $value)
    {
        return preg_replace("/({$key}=).*/", "$1\"{$value}\"", $content);
    }

    private function getEnv()
    {
        return File::get($this->envPath);
    }

    private function saveEnv($content)
    {
        File::replace($this->envPath, $content);
    }
}
