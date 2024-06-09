<?php

declare(strict_types=1);

namespace Pest\ArchPresets;

/**
 * @internal
 */
final class Base extends AbstractPreset
{
    /**
     * Executes the arch preset.
     */
    public function execute(): void
    {
        $this->expectations[] = expect([
            'dd',
            'ddd',
            'dump',
            'ray',
            'die',
            'var_dump',
            'sleep',
            'usleep',
            'exit',
            'phpinfo',
            'echo',
            'print',
            'print_r',
            'var_export',
        ])->not->toBeUsed();
    }
}
