<?php

declare(strict_types=1);

namespace Stematic\Testing\Commands;

use function file_exists;
use function getcwd;
use function sprintf;
use function implode;

use const DIRECTORY_SEPARATOR;

class PhpStanAnalyseCommand extends BaseCommand
{
    /**
     * The command signature.
     *
     * @var string
     */
    protected $signature = 'cs:phpstan  {--X|xdebug} {--no-xdebug}';

    /**
     * The command description.
     *
     * @var string
     */
    protected $description = 'Run the "PHPStan" Static Analysis tool';

    /**
     * Run php code sniffer detection to find coding standards issues.
     */
    public function handle(): int
    {
        if (! file_exists(sprintf('%s%sphpstan.neon', getcwd(), DIRECTORY_SEPARATOR))) {
            $this->call(PhpStanCopyConfigurationCommand::class);
        }

        $this->title('PHPStan: Static Analysis');

        $xdebug = ($this->option('xdebug') || phpversion('xdebug'))
            && ! $this->option('no-xdebug');

        return $this->exec([
            implode(DIRECTORY_SEPARATOR, ['.', 'vendor', 'bin', 'phpstan']),
            'analyse',
            '--memory-limit=2G',
            $xdebug ? '--xdebug' : '',
        ]);
    }
}
