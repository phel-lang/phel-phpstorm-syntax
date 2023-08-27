<?php

declare(strict_types=1);

namespace PhelPhpStorm\PhpStormSyntax\Infrastructure;

use PhelPhpStorm\PhpStormSyntax\Domain\ReadmeFileGenerator;

final class ReadmeFile
{
    private ReadmeFileGenerator $apiMarkdownGenerator;

    private string $appRootDir;

    public function __construct(
        ReadmeFileGenerator $apiMarkdownGenerator,
        string $appRootDir,
    ) {
        $this->apiMarkdownGenerator = $apiMarkdownGenerator;
        $this->appRootDir = $appRootDir;
    }

    public function generate(): void
    {
        $contentLines = $this->apiMarkdownGenerator->generate();

        $updatedReadme = str_replace(
            [
                '%%TAB_1%%',
                '%%TAB_2%%',
                '%%TAB_3%%',
                '%%TAB_4%%',
            ],
            [
                implode(PHP_EOL, $contentLines['tab_1']),
                implode(PHP_EOL, $contentLines['tab_2']),
                implode(PHP_EOL, $contentLines['tab_3']),
                implode(PHP_EOL, $contentLines['tab_4']),
            ],
            file_get_contents(__DIR__ . '/template/README.md')
        );

        file_put_contents(
            $this->appRootDir . '/README.md',
            $updatedReadme
        );
    }
}
