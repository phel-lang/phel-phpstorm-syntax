<?php

declare(strict_types=1);

namespace PhelPhpStorm\PhpStormSyntax\Domain;

final class ReadmeFileGenerator
{
    public function __construct(
        private PhelFunctionRepositoryInterface $phelFunctionRepository
    ) {
    }

    /**
     * @return array{
     *     tab-1:list<string>,
     *     tab-2:list<string>,
     *     tab-3:list<string>,
     *     tab-2:list<string>,
     * }
     */
    public function generate(): array
    {
        $result = [
            'tab-2' => $this->generateTab2(),
            'tab-3' => $this->generateTab3(),
            'tab-4' => $this->generateTab4(),
            'ignore' => $this->generateIgnore(),
        ];

        $result['tab-1'] = $this->generateTab1($result);

        return $result;
    }

    private function canAddToTab1(array $result, string $fnName): bool
    {
        foreach ($result as $tab) {
            foreach ($tab as $fn) {
                if ($fn === $fnName) {
                    return false;
                }
            }
        }

        return true;
    }

    /**
     * @return list<string>
     */
    private function generateTab2(): array
    {
        return [
            '__DIR__',
            '__FILE__',
        ];
    }

    /**
     * @return list<string>
     */
    private function generateTab3(): array
    {
        return [
            ':',
            '::',
            ':require-file',
            ':require',
            ':refer',
            ':export',
            ':use',
            ':as',
        ];
    }

    /**
     * @return list<string>
     */
    private function generateTab4(): array
    {
        return [
            '@',
            '\'',
            ',',
            '`',
            'php/',
            'php/aget',
            'php/apush',
            'php/aset',
            'php/aunset',
            'php/new',
            'php/->',
            'php/::',
            'php/oset',
        ];
    }

    /**
     * @return list<string>
     */
    private function generateIgnore(): array
    {
        return [
            '"',
            '%',
            '*',
            '+',
            '-',
            '/',
            '=',
            '(',
            ')',
            '[',
            ']',
            '{',
            '}',
        ];
    }

    /**
     * @return list<string>
     */
    private function generateTab1(array $result): array
    {
        $phelFunctions = $this->phelFunctionRepository->getAllPhelFunctions();
        $tab1 = [];

        foreach ($phelFunctions as $phelFn) {
            $fnName = $phelFn->fnName();
            if ($this->canAddToTab1($result, $fnName)) {
                if (str_contains($fnName, '/')) {
                    $tab1[] = substr($fnName, strpos($fnName, '/') + 1);
                } else {
                    $tab1[] = $fnName;
                }
            }
        }

        $especialSymbols = [
            'apply',
            'concat',
            'def',
            'defstruct*',
            'do',
            'fn',
            'foreach',
            'if',
            'let',
            'loop',
            'ns',
            'quote',
            'recur',
            'unquote',
            'unquote-splicing',
            'throw',
            'try',
            'list',
            'vector',
            'hash-map',
            'set-var',
            'definterface*',
        ];

        $tab1 = array_merge($tab1, $especialSymbols);
        $tab1 = array_unique($tab1);
        sort($tab1);

        return $tab1;
    }
}
