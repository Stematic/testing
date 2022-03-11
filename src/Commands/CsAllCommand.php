<?php

declare(strict_types=1);

namespace Stematic\Testing\Commands;

use function array_reduce;

class CsAllCommand extends BaseCommand
{
    /**
     * The command signature.
     *
     * @var string
     */
    protected $signature = 'cs';

    /**
     * The command description.
     *
     * @var string
     */
    protected $description = 'Runs all coding standards validation checks';

    /**
     * Runs all commands in the cs namespace in sequence.
     */
    public function handle(): int
    {
        $commands = [
            LinesOfCodeCommand::class,
            CodeSnifferCommand::class,
            PhpStanAnalyseCommand::class,
        ];

        return array_reduce(
            $commands,
            function (int $carry, string $command): int {
                return $carry + $this->call($command);
            },
            0,
        );
    }
}
