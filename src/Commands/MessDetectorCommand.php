<?php

declare(strict_types=1);

namespace Stematic\Testing\Commands;

use function file_exists;
use function getcwd;

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
        if (! file_exists(getcwd() . '/phpmd.xml')) {
            $this->call(MessDetectorCopyConfigurationCommand::class);
        }

        $this->title('PHP Mess Detector');

        $this->exec(['./vendor/bin/phpmd', $this->projectDirectory(), 'ansi']);
    }
}
