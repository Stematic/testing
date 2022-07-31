<?php

declare(strict_types=1);

namespace Stematic\Testing\Commands;

use function file_exists;
use function getcwd;
use function sprintf;
use function implode;

use const DIRECTORY_SEPARATOR;

class PhpCpdCommand extends BaseCommand
{
    /**
     * The command signature.
     *
     * @var string
     */
    protected $signature = 'cs:cpd';

    /**
     * The command description.
     *
     * @var string
     */
    protected $description = 'Run the PHP Copy Paste Detector (PHPCPD)';

    /**
     * Run php copy/paste detector tool.
     */
    public function handle(): int
    {
        $this->title('PHP Copy Paste Detection');

        return $this->exec([
            implode(DIRECTORY_SEPARATOR, ['.', 'vendor', 'bin', 'phpcpd']),
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
