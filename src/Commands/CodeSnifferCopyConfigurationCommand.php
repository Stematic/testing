<?php

declare(strict_types=1);

namespace Stematic\Testing\Commands;

use function getcwd;
use function sprintf;

class CodeSnifferCopyConfigurationCommand extends BaseCommand
{
    /**
     * The command signature.
     *
     * @var string
     */
    protected $signature = 'cs:code_sniffer:copy';

    /**
     * The command description.
     *
     * @var string
     */
    protected $description = 'Copies the base PHPCS ruleset file to the project directory.';

    /**
     * Copies the PHPCS ruleset file into the current project directory.
     */
    public function handle(): int
    {
        $file = 'ruleset.xml';

        $code = $this->copyFileToProject($file);

        $this->line(sprintf('Copying PHPCS ruleset file: <fg=green>%s/%s</>', getcwd(), $file));

        return $code;
    }
}
