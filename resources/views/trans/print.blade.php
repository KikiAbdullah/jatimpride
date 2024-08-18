<html>

<head>
    <meta charset="utf-8" />
    <title>INVOICE - {{ $item->no }}</title>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:inter,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap');

        body {
            background-color: #0000
        }

        /** RTL **/
        .invoice-box.rtl {
            direction: rtl;
            font-family: "Inter", sans-serif;
        }

        .invoice-box.rtl table {
            text-align: right;
        }

        .invoice-box.rtl table tr td:nth-child(3) {
            text-align: left;
        }

        .invoice-box {
            max-width: 640px;
            margin: auto;
            padding: 50px;
            border: 1px solid #cccccc;
            box-shadow: 0 0 40px rgba(0, 0, 0, 0.15);
            line-height: 24px;
            font-family: "Inter", sans-serif;
            color: #444;
            font-size: 8pt !important;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
        }

        .small-head {
            text-transform: uppercase;
            font-weight: 700;
            line-height: 40px;
            letter-spacing: 1px;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }

        .text-right {
            text-align: right;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 10px;
        }

        .invoice-box table tr.top table td.title {
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
            padding: 5px 5px 8px 5px;

        }

        .invoice-box table tr.details td {
            padding-bottom: 80px;
        }

        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
            padding: 10px;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td {
            border-top: 2px solid #eee;
            font-weight: bold;
            padding-bottom: 40px;
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
                                <img src="{{ public_path('app_local/img/logo.png') }}" style="max-height: 50px;" />
                            </td>

                            <td class="text-right">
                                <strong>{{ $item->no }}</strong><br />
                                {{ $item->created_at->format('d/m/Y H:i:s') }}
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
                                <span class="small-head">Customer:</span><br />
                                {{ $item->customer->name ?? '' }}<br />
                                {{ $item->customer->email ?? '' }}<br />
                                {{ $item->customer->nowa ?? '' }}<br />
                            </td>

                            <td class="text-right">
                                <span class="small-head">Detail:</span><br />
                                {{ $item->jenisPengiriman->name ?? '' }}<br />
                                {{ $item->text ?? '' }}<br />
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>



            <tr class="heading">
                <td>Item</td>
                <td class="text-right">Harga</td>
            </tr>
            @foreach ($item->lines as $line)
                <tr class="item">
                    <td>
                        <span style="font-weight: bold; padding-bottom:0;">{{ $line->merch->name_size }}</span><br>
                        <small>{{ cleanNumber($line->merch->harga) }} x {{ cleanNumber($line->qty) }}</small>
                    </td>
                    <td class="text-right">{{ cleanNumber($line->total) }}</td>
                </tr>
            @endforeach

            <tr class="total">
                <td class="text-right">Total</td>
                <td class="text-right">{{ cleanNumber($item->lines->sum('total')) }}</td>
            </tr>
        </table>
    </div>
</body>

</html>
