<p align="center"><a href="https://www.stematic.co.uk/" target="_blank" rel="noopener"><img src="https://raw.githubusercontent.com/Stematic/testing/develop/art/stematic-testing-banner.png" width="276"></a></p>

## About Stematic Testing

Provides a binary application to validate any coding standards issues (using PHP Code Sniffer) and runs the PHPUnit test suites.

## Installation

Add the testing module to your develop dependencies in your package / Laravel application.

```shell
composer require --dev stematic/testing
```

Alternatively, you can add it as a global package as a binary is provided `testing`.

```shell
composer global require stematic/testing
```

## Usage

```shell
vendor/bin/testing cs
vendor/bin/testing test
```

The `cs` command will run all Coding Standards related checks and outputs the status. The rules are configured to use a subset of the [Slevomat Coding Standard](https://github.com/slevomat/coding-standard) with some additional quality of life sniffs.
