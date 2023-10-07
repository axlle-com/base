<?php

namespace App\Console\DB;

use Doctrine\DBAL\Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class FillData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:fill-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        Schema::dropAllTables();
        Artisan::call('migrate');
        (new \Database\Seeders\DatabaseSeeder())->run();
    }
}
