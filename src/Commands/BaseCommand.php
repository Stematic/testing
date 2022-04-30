<?php

declare(strict_types=1);

namespace Stematic\Testing\Commands;

use Illuminate\Support\Str;
use LaravelZero\Framework\Commands\Command;
use Symfony\Component\Console\Helper\Helper;
use Symfony\Component\Process\Process;

use function str_repeat;
use function sprintf;
use function getcwd;
use function file_put_contents;
use function file_get_contents;

use const DIRECTORY_SEPARATOR;

abstract class BaseCommand extends Command
{
    /**
     * Run a shell command with real time output.
     *
     * @param string[] $command
     * @param null|string[] $env
     */
    public function exec(
        array $command,
        ?string $cwd = null,
        ?array $env = null,
        mixed $input = null,
        ?float $timeout = 60,
    ): int {
        $process = new Process($command, $cwd, $env, $input, $timeout);

        if (Process::isTtySupported()) {
            $process->setTty(true);
        }

        $this->newLine();
        $this->comment($process->getCommandLine());
        $this->newLine();

        /** @phpcsSuppress SlevomatCodingStandard.Functions.UnusedParameter */
        $process->run(fn (string $type, string $buffer) => $this->output->write($buffer));

        return (int) $process->getExitCode();
    }

    /**
     * Outputs a title for a command step.
     */
    public function title(string $title): self
    {
        $title = '↪ ' . $title;

        $size = Helper::width($title);
        $linePadding = str_repeat(' ', 120);
        $textPadding = str_repeat(' ', 118 - $size);

        $this->output->newLine();
        $this->output->writeln(sprintf('<bg=magenta;fg=white>%s</>', $linePadding));
        $this->output->writeln(sprintf('<bg=magenta;fg=white>%s%s%s</>', '  ', $title, $textPadding));
        $this->output->writeln(sprintf('<bg=magenta;fg=white>%s</>', $linePadding));
        $this->output->newLine();

        return $this;
    }

    /**
     * Returns the composer vendor directory path.
     */
    protected function vendorPath(): string
    {
        return sprintf('%s%svendor', getcwd(), DIRECTORY_SEPARATOR);
    }

    /**
     * Returns the qualified project directory path.
     */
    protected function projectDirectory($directory = null): string
    {
        // @phpcs:ignore
        $pwd = $_SERVER['PWD'];

        $suffix = $directory !== null
            ? Str::finish($directory, DIRECTORY_SEPARATOR)
            : '';

        return sprintf('%s%s%s', $pwd, DIRECTORY_SEPARATOR, $suffix);
    }

    /**
     * Copies a configuration file from this project into the calling projects root
     * when the command is executed.
     */
    protected function copyFileToProject(string $file): int
    {
        $base = sprintf('%s%s%s', base_path(), DIRECTORY_SEPARATOR, $file);
        $destination = sprintf('%s%s%s', getcwd(), DIRECTORY_SEPARATOR, $file);

        if ($base === $destination) {
            return 0;
        }

        $source = file_get_contents($base);

        return file_put_contents($destination, $source);
    }
}
