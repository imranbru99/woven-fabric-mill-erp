<?php

declare(strict_types=1);

namespace Filament\Commands\Concerns;

/**
 * Compatibility shim. laravel-filament-master references the Filament 4
 * namespace; Filament 3 keeps this trait under Filament\Support.
 */
trait CanManipulateFiles
{
    use \Filament\Support\Commands\Concerns\CanManipulateFiles;
}
