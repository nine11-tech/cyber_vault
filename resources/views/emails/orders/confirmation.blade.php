@component('mail::message')
# 🎉 Order Confirmation

Thank you for your order!

Here is your order summary:

@foreach ($order->items as $item)
- {{ $item->product_name }} (x{{ $item->quantity }}) - ${{ $item->product_price }}
@endforeach

**Total Paid:** ${{ $order->total }}

We appreciate your business!

Thanks,<br>
{{ config('app.name') }}
@endcomponent
