<?php

declare(strict_types=1);

namespace Stematic\Testing\Commands;

use function dirname;
use function sprintf;

class CodeSnifferCommand extends AbstractBaseCommand
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

        $override = dirname(__DIR__, 2) . '/ruleset.xml';
        $ruleset = sprintf('%s/stematic/coding-standards/ruleset.xml,%s', $this->vendorPath(), $override);

        $this->exec(
            [
                './vendor/bin/phpcs',
                '--standard=' . $ruleset,
                'src',
                '-s',
            ]
        );
    }
}
