<?php

declare(strict_types=1);

namespace Stematic\Testing\Commands;

use function implode;
use function sprintf;

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
    public function handle(): int
    {
        $this->title('PHP Lines of Code');

        return $this->exec([
            implode(DIRECTORY_SEPARATOR, ['.', 'vendor', 'bin', 'phploc']),
            $this->projectDirectory(),
            ... $this->getDirectoryExclusions(),
        ]);
    }

    /**
     * Returns a list of exclusion parameters.
     *
     * @return array<array-key, string>
     */
    protected function getDirectoryExclusions(): array
    {
        return collect(['coverage', 'node_modules', 'vendor', 'builds', 'resources', 'storage'])
            ->map(fn (string $directory): string => sprintf('--exclude=%s', $this->projectDirectory($directory)))
            ->toArray();
    }
}
