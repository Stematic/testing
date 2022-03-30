<?php

declare(strict_types=1);

namespace Stematic\Testing\Commands;

use function file_exists;
use function getcwd;
use function sprintf;
use function implode;

use const DIRECTORY_SEPARATOR;

class MessDetectorCommand extends BaseCommand
{
    /**
     * The command signature.
     *
     * @var string
     */
    protected $signature = 'cs:mess_detector';

    /**
     * The command description.
     *
     * @var string
     */
    protected $description = 'Run the PHP Mess Detector tool';

    /**
     * Run php code sniffer detection to find coding standards issues.
     */
    public function handle(): void
    {
        if (! file_exists(sprintf('%s%sphpmd.xml', getcwd(), DIRECTORY_SEPARATOR))) {
            $this->call(MessDetectorCopyConfigurationCommand::class);
        }

        $this->title('PHP Mess Detector');

        $this->exec([
            implode(DIRECTORY_SEPARATOR, ['.', 'vendor', 'bin', 'phpmd']),
            $this->projectDirectory(),
            'ansi',
        ]);
    }
}
