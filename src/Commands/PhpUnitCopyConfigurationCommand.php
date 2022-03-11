<?php

declare(strict_types=1);

namespace Stematic\Testing\Commands;

use function dirname;
use function sprintf;
use function getcwd;

class PhpUnitCopyConfigurationCommand extends BaseCommand
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
        $file = 'phpunit.xml';

        $code = $this->copyFileToProject($file);

        $this->line(sprintf('Copying PHPUnit configuration: <fg=green>%s/%s</>', getcwd(), $file));

        return $code;
    }
}
