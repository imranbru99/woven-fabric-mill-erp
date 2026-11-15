<?php

declare(strict_types=1);

namespace App\Filament\Buyer\Pages;

use App\Models\Party;
use App\Models\SalesOrder;
use Filament\Pages\Page;

class Orders extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    protected static ?string $navigationLabel = 'Orders';

    protected static string $view = 'filament.buyer.orders';

    public static function getRoutePath(): string
    {
        return '/';
    }

    protected function getViewData(): array
    {
        $user = auth()->user();
        $party = Party::query()->where('email', $user->email)->where('type', 'buyer')->first();
        $orders = SalesOrder::query()
            ->when($party, fn ($q) => $q->where('buyer_id', $party->id))
            ->when(! $party && ! $user->hasAnyRole(['owner', 'merchandiser']), fn ($q) => $q->whereRaw('1 = 0'))
            ->latest('id')
            ->limit(40)
            ->get();

        return compact('orders');
    }
}
