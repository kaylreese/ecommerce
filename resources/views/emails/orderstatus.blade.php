@component('mail::message')
<p>Dear <strong>{{ $order->first_name }}</strong>,</p>

<p>Order Status: <b>
    @if ($order->status == 0)
    Pending
    @elseif ($order->status == 1)
    In Progress
    @elseif ($order->status == 2)
    Delivered
    @elseif ($order->status == 3)
    Completed
    @elseif ($order->status == 4)
    Cancelled
    @endif
    </b>
</p>

<h3>Order Details: </h3>

<ul>
    <li><strong>Order Number:</strong> {{ $order->order_number }}</li>
    <li><strong>Date of Purchase:</strong> {{ $order->created_at }}</li>
    <li style="text-transform: capitalize;"><strong>Payment Method:</strong> {{ $order->payment_method }}</li>
</ul>

<table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
    <thead>
        <tr>
            <th style="border-bottom: 1px; solid #ddd; padding: 8px; text-align: left;">Product Name</th>
            <th style="border-bottom: 1px; solid #ddd; padding: 8px; text-align: left;">Quantity</th>
            <th style="border-bottom: 1px; solid #ddd; padding: 8px; text-align: left;">Total ($)</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($order->items as $item)
            <tr>
                <td style="border-bottom: 1px; solid #ddd; padding: 8px;">
                    {{ $item->product->title }} <br>
                    Color: {{ $item->color_name }} 
                    @if (!empty($item->size_name))
                        <br>
                        Size: {{ $item->size_name }} <br>
                        Size Amount: ${{ $item->size_amount }}
                    @endif
                </td>
                <td style="border-bottom: 1px; solid #ddd; padding: 8px; text-align: center;">{{ $item->quantity }}</td>
                <td style="border-bottom: 1px; solid #ddd; padding: 8px; text-align: right;">{{ number_format($item->price, 2) }}</td>
            </tr>
        @endforeach
        <tr>
            <td colspan="2" style="text-align: right;"><strong>Shipping</strong></td>
            <td class="total" style="text-align: right;">${{ number_format($order->shipping_amount, 2) }}</td>
        </tr>
        <tr>
            <td colspan="2" style="text-align: right;"><strong>Discount</strong></td>
            <td class="total" style="text-align: right;">${{ number_format($order->discount_amount, 2) }}</td>
        </tr>
        <tr>
            <td colspan="2" style="text-align: right;"><strong>Total</strong></td>
            <td class="total" style="text-align: right;">${{ number_format($order->total_amount, 2) }}</td>
        </tr>
    </tbody>
</table>

<p>Shipping Name: <b>{{ $order->shipping_name }} </b></p>
@if (!empty($order->discount_code))
    <p>Discount Code: <b>{{ $order->discount_code }} </b></p>
@endif


@php
    $getSetting = App\Models\SettingModel::getSettings();
@endphp


<p style="text-align: justify;">Please find the attached invoice for your reference. If you have any questions or concerns regarding your order or the invoice, feel free to contact us at If you have any questions, please contact us <strong>{{ $getSetting->email }}</strong></p>

<p>Thank you for choosing! <strong>{{ $getSetting->website_name }}</strong>. We appreciate your business.</p>

Thanks, <br>
{{ $getSetting->website_name }}
@endcomponent