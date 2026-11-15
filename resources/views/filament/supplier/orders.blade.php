<x-filament-panels::page>
    <table class="w-full text-sm">
        <thead>
            <tr><th class="py-2 text-left">PO</th><th class="text-left">Status</th><th class="text-left">Delivery</th><th class="text-right">Total</th></tr>
        </thead>
        <tbody>
            @forelse ($orders as $order)
                <tr>
                    <td class="border-t py-2">{{ $order->number }}</td>
                    <td class="border-t">{{ $order->status }}</td>
                    <td class="border-t">{{ $order->delivery_date }}</td>
                    <td class="border-t text-right">{{ $order->total }}</td>
                </tr>
            @empty
                <tr><td class="py-4" colspan="4">No purchase orders for this supplier yet.</td></tr>
            @endforelse
        </tbody>
    </table>
</x-filament-panels::page>
