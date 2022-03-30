<?php

declare(strict_types=1);

namespace Stematic\Testing\Commands;

use function sprintf;
use function implode;

use const DIRECTORY_SEPARATOR;

class CodeSnifferCommand extends BaseCommand
{
    /**
     * The command signature.
     *
     * @var string
     */
    protected $signature = 'cs:code_sniffer';

    /**
     * The command description.
     *
     * @var string
     */
    protected $description = 'Run PHP Code Sniffer validation';

    /**
     * Run php code sniffer detection to find coding standards issues.
     */
    public function handle(): void
    {
        $this->title('PHPCS: Code Sniffer');

        $override = sprintf('%s%sruleset.xml', base_path(), DIRECTORY_SEPARATOR);

        $this->exec(
            [
                implode(DIRECTORY_SEPARATOR, ['.', 'vendor', 'bin', 'phpcs']),
                '--standard=' . $override,
                $this->projectDirectory(),
                '-s',
            ],
        );
    }
}
