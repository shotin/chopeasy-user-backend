<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Invoice - Order #{{ $order->order_number }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .invoice-container {
            background: #fff;
            margin: 30px auto;
            padding: 30px;
            width: 700px;
            border-radius: 6px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .logo img {
            height: 50px;
        }

        .section-title {
            font-weight: bold;
            margin-bottom: 10px;
        }

        .info-box {
            border: 1px solid #ccc;
            padding: 15px;
            border-radius: 5px;
            width: 48%;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            gap: 4%;
            margin-bottom: 30px;
        }

        .order-items img {
            height: 50px;
            width: 50px;
            object-fit: cover;
            border-radius: 4px;
        }

        .order-items table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        .order-items th,
        .order-items td {
            padding: 10px;
            border-bottom: 1px solid #eee;
            text-align: left;
        }

        .totals {
            border-top: 1px solid #ccc;
            padding-top: 10px;
        }

        .totals table {
            width: 100%;
        }

        .totals td {
            padding: 8px 0;
        }

        .totals .label {
            text-align: right;
            color: #555;
        }

        .totals .value {
            text-align: right;
            font-weight: bold;
        }

        .total {
            font-size: 18px;
            color: #000;
        }
    </style>
</head>

<body>
    <div class="invoice-container">
        <div class="header">
            <div class="logo">
                <img src="https://img-va.myshopline.com/image/store/1700140158981/samis-online-logo[42]-2x_300x.png?w=278&h=134" alt="Logo">
            </div>
            <div>
                <strong>Invoice for Order #{{ $order->order_number }}</strong><br>
                Invoice INV-{{ $order->id }}<br>
                {{ $order->created_at->format('F d, Y') }}
            </div>
        </div>

        <div class="info-row">
            <div class="info-box">
                <div class="section-title">Billing Information</div>
                {{ $order->shipping_address_snapshot['first_name'] ?? '' }} {{ $order->shipping_address_snapshot['last_name'] ?? '' }}<br>
                {{ $order->shipping_address_snapshot['address_line_1'] ?? '' }}<br>
                {{ $order->shipping_address_snapshot['city'] ?? '' }}, {{ $order->shipping_address_snapshot['state'] ?? '' }}<br>
                {{ $order->shipping_address_snapshot['country'] ?? '' }}<br>
                {{ $order->shipping_address_snapshot['phone_number'] ?? '' }}<br>
                {{ $order->user->email ?? 'N/A' }}
            </div>

            <div class="info-box">
                <div class="section-title">Delivery Information</div>
                {{ $order->shipping_address_snapshot['first_name'] ?? '' }} {{ $order->shipping_address_snapshot['last_name'] ?? '' }}<br>
                {{ $order->shipping_address_snapshot['address_line_1'] ?? '' }}<br>
                {{ $order->shipping_address_snapshot['city'] ?? '' }}, {{ $order->shipping_address_snapshot['state'] ?? '' }}<br>
                {{ $order->shipping_address_snapshot['country'] ?? '' }}<br>
                {{ $order->shipping_address_snapshot['phone_number'] ?? '' }}<br>
                {{ $order->user->email ?? 'N/A' }}
            </div>
        </div>

        @php
        use Illuminate\Support\Str;

        $localBase = 'http://127.0.0.1:8000/images/products';
        $cdnBase = 'https://api.poahub.com/images/products';
        @endphp

        <div class="order-items">
            <div class="section-title">Order Items</div>
            <table>
                @foreach ($order->items as $item)
                @php
                $rawImage = $item->product_snapshot['image'] ?? null;
                $finalImage = $rawImage
                    ? Str::replaceFirst($localBase, $cdnBase, $rawImage)
                    : asset('images/default-product.png');
                @endphp
                <tr>
                    <td><img src="{{ $finalImage }}" alt="Product Image" width="80"></td>
                    <td>
                        {{ $item->product_snapshot['name'] ?? 'Product' }}<br>
                        Qty: {{ $item->quantity }} × £{{ number_format($item->price_at_order, 2) }}
                    </td>
                    <td style="text-align: right;">
                        £{{ number_format($item->quantity * $item->price_at_order, 2) }}
                    </td>
                </tr>
                @endforeach
            </table>
        </div>

        <div class="totals">
            <table>
                <tr>
                    <td class="label">Subtotal</td>
                    <td class="value">£{{ number_format($order->total_amount, 2) }}</td>
                </tr>
                <tr>
                    <td class="label">Shipping</td>
                    <td class="value">£0.00</td>
                </tr>
                <tr>
                    <td class="label">Discount</td>
                    <td class="value">-£0.00</td>
                </tr>
                <tr>
                    <td class="label total">Total</td>
                    <td class="value total">£{{ number_format($order->total_amount, 2) }}</td>
                </tr>
            </table>
        </div>
    </div>
</body>

</html>
