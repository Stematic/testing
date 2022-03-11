<?php

declare(strict_types=1);

namespace Stematic\Testing\Commands;

use function dirname;
use function sprintf;
use function getcwd;

class PhpStanCopyConfigurationCommand extends BaseCommand
{
    /**
     * The command signature.
     *
     * @var string
     */
    protected $signature = 'cs:phpstan:copy';

    /**
     * The command description.
     *
     * @var string
     */
    protected $description = 'Copies the base PHPStan configuration file to the project directory.';

    /**
     * Copies the PHP Stan configuration file into the current project directory.
     */
    public function handle(): int
    {
        $base = dirname(__DIR__, 2) . '/phpstan.neon';
        $destination = getcwd() . '/phpstan.neon';

        if ($base === $destination) {
            return 0;
        }

        $code = $this->exec(['cp', '-f', $base, $destination]);

        $this->line(sprintf('Copying PHPStan configuration: <fg=green>%s</>', $destination));

        return $code;
    }
}
