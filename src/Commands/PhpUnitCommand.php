<?php

declare(strict_types=1);

namespace Stematic\Testing\Commands;

use function file_exists;
use function getcwd;

class PhpUnitCommand extends AbstractBaseCommand
{
    /**
     * The command signature.
     *
     * @var string
     */
    protected $signature = 'test';

    /**
     * The command description.
     *
     * @var string
     */
    protected $description = 'Run the PHPUnit test suite';

    /**
     * Run php code sniffer detection to find coding standards issues.
     */
    public function handle(): void
    {
        if (! file_exists(getcwd() . '/phpunit.xml')) {
            $this->call(PhpUnitCopyConfigurationCommand::class);
        }

        $this->title('PHPUnit: Application Test Suite');

        // @todo add code coverage?
        $this->exec(['./vendor/bin/phpunit']);
    }
}
