<?php

declare(strict_types=1);

namespace Stematic\Testing\Commands;

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
        $this->title('PHP Mess Detector');

        $this->exec(['./vendor/bin/phpmd', './src', 'ansi', 'codesize,controversial,design']);
    }
}
