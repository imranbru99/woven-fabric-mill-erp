<?php

declare(strict_types=1);

namespace App\Filament\Supplier\Pages;

use App\Models\Party;
use App\Models\PurchaseOrder;
use Filament\Pages\Page;

class PurchaseOrders extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-truck';

    protected static ?string $navigationLabel = 'Purchase orders';

    protected static string $view = 'filament.supplier.orders';

    public static function getRoutePath(): string
    {
        return '/';
    }

    protected function getViewData(): array
    {
        $user = auth()->user();
        $party = Party::query()->where('email', $user->email)->where('type', 'supplier')->first();
        $orders = PurchaseOrder::query()
            ->when($party, fn ($q) => $q->where('supplier_id', $party->id))
            ->when(! $party && ! $user->hasRole('purchase-manager'), fn ($q) => $q->whereRaw('1 = 0'))
            ->latest('id')
            ->limit(40)
            ->get();

        return compact('orders');
    }
}
