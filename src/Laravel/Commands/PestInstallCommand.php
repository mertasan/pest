<?php

declare(strict_types=1);

namespace Pest\Laravel\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Pest\Exceptions\InvalidConsoleArgument;

/**
 * @internal
 */
final class PestInstallCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'pest:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates Pest resources in your current PHPUnit test suite';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        /* @phpstan-ignore-next-line */
        $pest    = base_path('tests/Pest.php');
        /* @phpstan-ignore-next-line */
        $helpers = base_path('tests/Helpers.php');

        foreach ([$pest, $helpers] as $file) {
            if (File::exists($file)) {
                throw new InvalidConsoleArgument(sprintf('%s already exist', $file));
            }
        }

        File::copy(implode(DIRECTORY_SEPARATOR, [
            dirname(__DIR__, 3),
            'stubs',
            'Pest.php',
        ]), $pest);

        File::copy(implode(DIRECTORY_SEPARATOR, [
            dirname(__DIR__, 3),
            'stubs',
            'Helpers.php',
        ]), $helpers);

        $this->output->success('`tests/Pest.php` created successfully.');
        $this->output->success('`tests/Helpers.php` created successfully.');
    }
}
