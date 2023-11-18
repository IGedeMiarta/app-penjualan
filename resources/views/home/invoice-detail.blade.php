<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>{{ $title ?? '' }}</title>

    <style>
        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            font-size: 16px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }

        .invoice-box table tr td:nth-child(2) {
            text-align: right;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }

        /** RTL **/
        .invoice-box.rtl {
            direction: rtl;
            font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        }

        .invoice-box.rtl table {
            text-align: right;
        }

        .invoice-box.rtl table tr td:nth-child(2) {
            text-align: left;
        }

        .col {
            float: left;
            width: 50%;
        }

        /* Clear floats after the columns */
        .row:after {
            content: "";
            display: table;
            clear: both;
        }
    </style>
</head>

<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title">
                                <img src="{{ asset('logo.png') }}" style="width: 100%; max-width: 300px" />
                            </td>

                            <td>
                                <strong> Invoice #{{ $order->Invoice }}<br /></strong>

                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>
                            <td>
                                <strong> Invoice To: </strong><br>
                                <span>{{ auth()->user()->name }}</span><br />
                                {{ auth()->user()->email }}
                            </td>

                            <td>
                                Created: <strong>{{ df($order->created_at) }}</strong><br />
                                Due: <strong>{{ due($order->created_at) }}</strong>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="heading">
                <td>Bank Transfer</td>

                <td>Rek.</td>
            </tr>
            @foreach (app_data('bank_account') as $bank)
                <tr class="details">
                    <td>{{ $bank['bank'] }}</td>

                    <td>{{ $bank['no'] }} <br><small>{{ $bank['detail'] }}</small></td>
                </tr>
            @endforeach

            <tr class="heading">
                <td>Item</td>

                <td>Price</td>
            </tr>
            @foreach ($order->details as $item)
                <tr class="item">
                    <td>{{ $item->product->product_name }}</td>

                    <td>{{ nb($item->price) }}</td>
                </tr>
            @endforeach



            <tr class="total">
                <td></td>

                <td>Total: {{ nb($order->amount) }}</td>
            </tr>
        </table>

        {{-- <hr> --}}
        <br><br>
        Notes: <br>

        <small>
            {!! app_data('invoice_note') !!}
        </small>
        <hr>
        <div class="row">
            <div class="col">
                <img src="{{ asset('logo.png') }}" style="width: 100%; max-width: 200px" /><br>
            </div>
            <div class="col" style="text-align: end;">
                <strong>Phone: </strong> {{ app_data('phone') }}<br>
                <small>{!! app_data('address') !!}
                </small>
            </div>
        </div>
    </div>

</body>

</html>
