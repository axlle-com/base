<?php

namespace App\Console\DB;

use Doctrine\DBAL\Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:seed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     * @throws Exception
     */
    public function handle(): void
    {
        Schema::disableForeignKeyConstraints();
        $tableNames = Schema::getConnection()->getDoctrineSchemaManager()->listTableNames();
        foreach ($tableNames as $name) {
            if ($name === 'migrations') {
                continue;
            }
            DB::table($name)->truncate();
        }

        Schema::enableForeignKeyConstraints();
        (new \Database\Seeders\DatabaseSeeder())->run();
    }
}
