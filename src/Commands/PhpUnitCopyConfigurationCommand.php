<?php

declare(strict_types=1);

namespace Stematic\Testing\Commands;

use function dirname;
use function sprintf;
use function getcwd;

class PhpUnitCopyConfigurationCommand extends AbstractBaseCommand
{
    /**
     * The command signature.
     *
     * @var string
     */
    protected $signature = 'test:copy';

    /**
     * The command description.
     *
     * @var string
     */
    protected $description = 'Copies the base PHPUnit configuration file to the project directory.';

    /**
     * Copies the PHPUnit configuration file into the current project directory.
     */
    public function handle(): int
    {
        $base = dirname(__DIR__, 2) . '/phpunit.xml';
        $destination = getcwd() . '/phpunit.xml';

        if ($base === $destination) {
            return 0;
        }

        $code = $this->exec(['cp', '-f', $base, $destination]);

        $this->line(sprintf('Copying PHPUnit configuration: <fg=green>%s</>', $destination));

        return $code;
    }
}
