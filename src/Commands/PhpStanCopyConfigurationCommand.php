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
        $file = 'phpstan.neon';

        $code = $this->copyFileToProject($file);

        $this->line(sprintf('Copying PHPStan configuration: <fg=green>%s/%s</>', getcwd(), $file));

        return $code;
    }
}
