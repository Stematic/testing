<?php

declare(strict_types=1);

namespace Stematic\Testing\Commands;

use function sprintf;
use function implode;
use function getcwd;

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

        // Always copy the ruleset before running (prevents abuse).
        $this->call(CodeSnifferCopyConfigurationCommand::class);

        $this->exec(
            [
                implode(DIRECTORY_SEPARATOR, ['.', 'vendor', 'bin', 'phpcs']),
                sprintf('--standard=%s%sruleset.xml', getcwd(), DIRECTORY_SEPARATOR),
                $this->projectDirectory(),
                sprintf('--ignore=%s', './coverage,./vendor,./storage,./resources,./builds,./bootstrap/cache'),
                '-s',
            ],
        );
    }
}
