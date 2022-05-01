<?php

declare(strict_types=1);

namespace Stematic\Testing\Commands;

use function file_exists;
use function getcwd;
use function sprintf;
use function implode;
use function array_filter;

use const DIRECTORY_SEPARATOR;

class PhpUnitCommand extends BaseCommand
{
    /**
     * The command signature.
     *
     * @var string
     */
    protected $signature = 'test {--F|filter=} {--C|coverage=text}';

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
        if (! file_exists(sprintf('%s%sphpunit.xml', getcwd(), DIRECTORY_SEPARATOR))) {
            $this->call(PhpUnitCopyConfigurationCommand::class);
        }

        $this->title('PHPUnit: Application Test Suite');

        $filter = $this->option('filter');
        $coverage = $this->option('coverage');

        $this->exec(array_filter([
            implode(DIRECTORY_SEPARATOR, ['.', 'vendor', 'bin', 'phpunit']),
            $filter !== null ? sprintf('--filter=%s', $filter) : null,
            '--coverage-' . $coverage,
            '--testdox',
            '--stop-on-failure',
        ]));
    }
}
