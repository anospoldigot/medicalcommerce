<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Example 1</title>
    <style>
        .clearfix:after {
            content: "";
            display: table;
            clear: both;
        }

        a {
            color: #5D6975;
            text-decoration: underline;
        }

        body {
            position: relative;
            width: 100%;
            height: 100%;
            margin: 0 auto;
            color: #001028;
            background: #FFFFFF;
            font-family: Arial, sans-serif;
            font-size: 12px;
            font-family: Arial;
        }

        header {
            padding: 10px 0;
            margin-bottom: 30px;
        }

        #logo {
            text-align: center;
            margin-bottom: 10px;
        }

        #logo img {
            width: 90px;
        }

        h1 {
            border-top: 1px solid #5D6975;
            border-bottom: 1px solid #5D6975;
            color: #5D6975;
            font-size: 2.4em;
            line-height: 1.4em;
            font-weight: normal;
            text-align: center;
            margin: 0 0 20px 0;
            background: url(dimension.png);
        }

        #project {
            float: left;
        }

        #project span {
            color: #5D6975;
            text-align: right;
            width: 52px;
            margin-right: 10px;
            display: inline-block;
            font-size: 0.8em;
        }

        #company {
            float: right;
            text-align: right;
        }

        #project div,
        #company div {
            white-space: nowrap;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            margin-bottom: 20px;
        }

        table tr:nth-child(2n-1) td {
            background: #F5F5F5;
        }

        table th,
        table td {
            text-align: center;
        }

        table th {
            padding: 5px 20px;
            color: #5D6975;
            border-bottom: 1px solid #C1CED9;
            white-space: nowrap;
            font-weight: normal;
        }

        table .service,
        table .desc {
            text-align: left;
        }

        table td {
            padding: 20px;
            text-align: right;
        }

        table td.service,
        table td.desc {
            vertical-align: top;
        }

        table td.unit,
        table td.qty,
        table td.total {
            font-size: 1.2em;
        }

        table td.grand {
            border-top: 1px solid #5D6975;
            ;
        }

        #notices .notice {
            color: #5D6975;
            font-size: 1.2em;
        }

        footer {
            color: #5D6975;
            width: 100%;
            height: 30px;
            position: absolute;
            bottom: 0;
            border-top: 1px solid #C1CED9;
            padding: 8px 0;
            text-align: center;
        }

        .badge {
            display: inline-block;
            padding: .35em .65em;
            font-size: .75em;
            font-weight: 700;
            line-height: 1;
            text-align: center;
            white-space: nowrap;
            vertical-align: baseline;
            border-radius: .25rem;
        }
        
        /* Warna untuk badge */
        .bg-primary {
        background-color: #007bff;
        color: #fff;
        }
        
        .bg-secondary {
        background-color: #6c757d;
        color: #fff;
        }
        
        .bg-success {
        background-color: #28a745;
        color: #fff;
        }
        
        .bg-danger {
        background-color: #dc3545;
        color: #fff;
        }
        
        .bg-warning {
        background-color: #ffc107;
        color: #fff;
        }
        
        .bg-info {
        background-color: #17a2b8;
        color: #fff;
        }
        
        .bg-light {
        background-color: #f8f9fa;
        color: #343a40;
        }
        
        .bg-dark {
        background-color: #343a40;
        color: #fff;
        }
    </style>
</head>

<body>
    <header class="clearfix">
        <div id="logo">
            <img src="{{ $logo }}">
        </div>
        <h1>{{ $order->transaction->invoice_number }}</h1>
        <div id="company" class="clearfix">
            {{-- <div>Company Name</div>
            <div>455 Foggy Heights,<br /> AZ 85004, US</div>
            <div>(602) 519-0450</div>
            <div><a href="mailto:company@example.com">company@example.com</a></div> --}}
            
        </div>
        <div id="project">
            <div><span>BUYER</span> {{ $order->user->name }}</div>
            <div><span>ADDRESS</span> {{ $order->shipping_address }}</div>
            <div><span>EMAIL</span> <a href="mailto:{{ $order->user->email }}">{{ $order->user->email }}</a></div>
            <div><span>DATE</span> {{ \Carbon\Carbon::create($order->created_at)->format('F d, Y') }}</div>
            <div><span>DUE DATE</span> September 17, 2015</div>
            <div><span>STATUS</span> <label style="inline-block" class="badge bg-{{ $order->order_status_color }}">{{ $order->status_label }}</label></div>
        </div>
        
    </header>
    <main>
        <table>
            <thead>
                <tr>
                    <th class="service">ITEM</th>
                    <th class="desc">WEIGHT</th>
                    <th>PRICE</th>
                    <th>QTY</th>
                    <th>TOTAL</th>
                </tr>
            </thead>
            <tbody>
                {{-- <tr>
                    <td class="service">Design</td>
                    <td class="desc">Creating a recognizable design solution based on the company's existing visual
                        identity</td>
                    <td class="unit">$40.00</td>
                    <td class="qty">26</td>
                    <td class="total">$1,040.00</td>
                </tr> --}}
                @foreach ($order->items as $item)
                    <tr>
                        <td class="service">{{ $item->product->title }}</td>
                        <td class="desc">{{ $item->product->weight }}</td>
                        <td class="unit">{{ number_format ($item->price,2,",",".") }}</td>
                        <td class="qty">{{ $item->quantity }}</td>
                        <td class="total">{{ number_format ($item->price * $item->quantity,2,",",".") }}</td>
                    </tr>
                @endforeach
                {{-- <tr>
                    <td class="service">Development</td>
                    <td class="desc">Developing a Content Management System-based Website</td>
                    <td class="unit">$40.00</td>
                    <td class="qty">80</td>
                    <td class="total">$3,200.00</td>
                </tr>
                <tr>
                    <td class="service">SEO</td>
                    <td class="desc">Optimize the site for search engines (SEO)</td>
                    <td class="unit">$40.00</td>
                    <td class="qty">20</td>
                    <td class="total">$800.00</td>
                </tr>
                <tr>
                    <td class="service">Training</td>
                    <td class="desc">Initial training sessions for staff responsible for uploading web content</td>
                    <td class="unit">$40.00</td>
                    <td class="qty">4</td>
                    <td class="total">$160.00</td>
                 --}}
                </tr>
                <tr>
                    <td colspan="4">SUBTOTAL</td>
                    <td class="total">{{ number_format ($order->items->sum('price_after_disc'),2,",",".") }}</td>
                </tr>

                
                @if (!empty($order->transaction->voucher_amount))
                <tr>
                    <td colspan="4">VOUCHER</td>
                    <td class="total">-{{ number_format ($order->transaction->voucher_amount,2,",",".") }}</td>
                </tr>
                @endif
                <tr>
                    <td colspan="4">SHIPPING</td>
                    <td class="total">{{ number_format ($order->transaction->shipping_amount,2,",",".") }}</td>
                </tr>
                @if (!empty($ppn))
                <tr>
                    <td colspan="4">PPN {{ $ppn }}%</td>
                    <td class="total">{{ number_format ($order->transaction->ppn_amount,2,",",".") }}</td>
                </tr>
                @endif
                <tr>
                    <td colspan="3" class="grand total">GRAND TOTAL</td>
                    <td class="grand total" colspan="2">Rp. {{ number_format ($order->transaction->amount,2,",",".") }}</td>
                </tr>
            </tbody>
        </table>
        <div>
            <div style="text-transform: uppercase">
                <div>KURIR : {{ $order->shipping_courier_name }} - {{ $order->shipping_type }}</div>
                <div></div>
                <div>PAYMENT : {{ $order->transaction->payment_name }}</div>
            </div>
        </div>
        <div id="notices">
            <div>NOTICE:</div>
            <div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>
        </div>
    </main>
    <footer>
        Invoice was created on a computer and is valid without the signature and seal.
    </footer>
</body>

</html>