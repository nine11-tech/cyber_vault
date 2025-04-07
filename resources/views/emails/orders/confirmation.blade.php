@component('mail::message')
# 🛒 Order Confirmed!

Hello **{{ $order->user->name ?? 'Valued Customer' }}**,  
Thank you for shopping with **CyberVault**! 🧠💥

---

## 🧾 Order Summary

@component('mail::table')
| Product        | Quantity | Price |
|----------------|----------|--------|
@foreach ($order->items as $item)
| {{ $item->product_name }} | x{{ $item->quantity }} | ${{ number_format($item->product_price, 2) }} |
@endforeach
@endcomponent

---

### 💰 **Total Paid:** ${{ number_format($order->total, 2) }}

---

We truly appreciate your trust in our service.  
If you have any questions or need support, feel free to reply to this email.

@component('mail::button', ['url' => config('app.url')])
Visit CyberVault
@endcomponent

Thanks again,  
The **CyberVault** Team 💻
@endcomponent
