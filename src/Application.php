<?php

declare(strict_types=1);

namespace Stematic\Testing;

use LaravelZero\Framework\Application as BaseApplication;

use const DIRECTORY_SEPARATOR;

class Application extends BaseApplication
{
    /**
     * Overrides the default application path to use "src".
     *
     * @param string $path
     */
    public function path($path = ''): string
    {
        $appPath = $this->appPath ?: $this->basePath . DIRECTORY_SEPARATOR . 'src';

        return $appPath . ($path !== '' ? DIRECTORY_SEPARATOR . $path : '');
    }
}
