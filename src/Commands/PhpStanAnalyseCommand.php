<?php

declare(strict_types=1);

namespace Stematic\Testing\Commands;

use function file_exists;
use function getcwd;

class PhpStanAnalyseCommand extends AbstractBaseCommand
{
    /**
     * The command signature.
     *
     * @var string
     */
    protected $signature = 'cs:phpstan';

    /**
     * The command description.
     *
     * @var string
     */
    protected $description = 'Run the "PHPStan" Static Analysis tool';

    /**
     * Run php code sniffer detection to find coding standards issues.
     */
    public function handle(): void
    {
        if (! file_exists(getcwd() . '/phpstan.neon')) {
            $this->call(PhpStanCopyConfigurationCommand::class);
        }

        $this->title('PHPStan: Static Analysis');

        $this->exec(['./vendor/bin/phpstan', 'analyse', '--memory-limit=2G']);
    }
}
