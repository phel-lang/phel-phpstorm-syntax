<?php

declare(strict_types=1);

namespace PhelPhpStorm\PhpStormSyntax\Domain;

use PhelNormalizedInternal\PhelNormalizedInternalFacadeInterface;

final class ReadmeFileGenerator
{
    private PhelNormalizedInternalFacadeInterface $phelInternalFacade;

    public function __construct(PhelNormalizedInternalFacadeInterface $phelInternalFacade)
    {
        $this->phelInternalFacade = $phelInternalFacade;
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
    private function generateTab3(): array
    {
        return [
            ':',
            ':require',
            ':use',
        ];
    }

    /**
     * @return list<string>
     */
    private function generateTab4(): array
    {
        return [
            '"',
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
            '%',
            '*',
            '+',
            '-',
            '/',
            '=',
        ];
    }

    /**
     * @return list<string>
     */
    private function generateTab1(array $result): array
    {
        $groupedPhelFns = $this->phelInternalFacade->getNormalizedGroupedFunctions();
        $tab1 = [];
        foreach ($groupedPhelFns as $values) {
            foreach ($values as $value) {
                $fnName = $value->fnName();
                if ($this->canAddToTab1($result, $fnName)) {
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
