<?php

namespace BCleverly\MigrationUnmake\Console\Commands;

use Illuminate\Console\Command;

class UnmakeMigration extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migration:unmake {--dry-run : If you want to dry run first}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Removes the latest migration in your migrations folder';

    /**
     * Holds the list of migration files.
     *
     * @var array
     */
    protected $migrationFiles = [];

    /**
     * Holds the path of the migration files.
     *
     * @var string
     */
    private $migrationFilesPath;

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();

        $this->getMigrationFiles();
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {
        $this->removeMigrationFile($this->migrationFilesPath.end($this->migrationFiles));
    }

    /**
     * Gets the list of migration files.
     *
     * @return $this
     */
    protected function getMigrationFiles()
    {
        $this->migrationFilesPath = database_path('migrations\\');
        $this->migrationFiles = array_diff(scandir($this->migrationFilesPath), ['.', '..']);
        sort($this->migrationFiles);

        return $this;
    }

    /**
     * Removes the given file.
     *
     * @param string $filePath
     */
    protected function removeMigrationFile(string $filePath): void
    {

        if ($this->option('dry-run')) {
            $this->info('You will be removing: '.$filePath);
            return;
        }

        $this->info('Removing: '.$filePath);

        try {
            unlink($filePath);
            $this->info('Removed file');
        } catch (\Exception $exception) {
            $this->info("Couldn't delete file");
        }
    }
}
