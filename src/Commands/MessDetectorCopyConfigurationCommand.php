<?php

declare(strict_types=1);

namespace Stematic\Testing\Commands;

use function sprintf;

class MessDetectorCopyConfigurationCommand extends BaseCommand
{
    /**
     * The command signature.
     *
     * @var string
     */
    protected $signature = 'cs:mess_detector:copy';

    /**
     * The command description.
     *
     * @var string
     */
    protected $description = 'Copies the base PHPMD configuration file to the project directory.';

    /**
     * Copies the PHP Mess Detector configuration file into the current project directory.
     */
    public function handle(): int
    {
        $file = 'phpmd.xml';

        $code = $this->copyFileToProject($file);

        $this->line(sprintf('Copying PHP Mess Detector configuration: <fg=green>%s/%s</>', getcwd(), $file));

        return $code;
    }
}
