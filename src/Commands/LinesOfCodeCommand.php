<?php

declare(strict_types=1);

namespace Stematic\Testing\Commands;

use function implode;

use const DIRECTORY_SEPARATOR;

class LinesOfCodeCommand extends BaseCommand
{
    /**
     * The command signature.
     *
     * @var string
     */
    protected $signature = 'cs:loc';

    /**
     * The command description.
     *
     * @var string
     */
    protected $description = 'Run the PHP Lines of Code tool';

    /**
     * Run php code sniffer detection to find coding standards issues.
     */
    public function handle(): void
    {
        $this->title('PHP Lines of Code');

        $this->exec([
            implode(DIRECTORY_SEPARATOR, ['.', 'vendor', 'bin', 'phploc']),
            $this->projectDirectory(),
        ]);
    }
}
