<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INVOICE - {{ $item->no }}</title>
    <style>
        @page {
            /* using padding , still same output */
            margin: 0in;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            font-size: 10pt;
            background-color: black;
            color: white;
        }

        .invoice-container {
            width: 95%;
            padding: 20px;
            position: relative;
            overflow: hidden;
        }

        .watermark img {
            position: absolute;
            top: 35%;
            left: 50%;
            max-width: 80%;
            opacity: 0.1;
            transform: translate(-50%, -50%);
            z-index: -1;
        }

        .invoice-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #ddd;
            padding-bottom: 15px;
        }

        .invoice-header h3 {
            font-size: 22px;
            color: #ddd;
        }

        .company-info {
            text-align: right;
            text-wrap: wrap;
        }

        .company-info h3 {
            color: #fa0;
        }

        .company-logo {
            height: 50px;
            margin-bottom: 10px;
        }

        .customer-info {
            text-align: right;
            padding: 15px;
            border-radius: 5px;
        }

        .customer-info h2 {
            color: #fa0;
        }

        .invoice-details h2 {
            color: #fa0;
        }

        .invoice-details {
            padding: 15px;
            border-radius: 5px;
        }

        .transaction-details {
            margin-top: 20px;
        }

        .transaction-details table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .transaction-details th,
        .transaction-details td {
            border-bottom: 1px solid #ddd;
            padding: 10px;
        }

        .transaction-details th {
            background-color: #f4f4f4;
            font-weight: bold;
        }

        .total {
            color: #fa0;
            text-align: right;
            font-size: 10pt;
            font-weight: bold;
            margin-top: 10px;
        }

        .grandtotal {
            color: #fa0;
            text-align: right;
            font-size: 12pt;
            font-weight: bold;
            margin-top: 10px;
        }

        .thank-you {
            text-align: center;
            margin-top: 30px;
            font-size: 12pt;
            color: #ddd;
            font-style: italic;
        }

        .paid-stamp {
            position: absolute;
            top: 250px;
            left: 90px;
            opacity: 0.8;
        }

        .paid-stamp img {
            width: 200px;
        }
    </style>
</head>

<body>
    <div class="invoice-container">
        <div class="watermark">
            <img src="{{ public_path('app_local/img/jp4.png') }}" alt="">
        </div>

        <div class="invoice-header">
            <table width="100%">
                <tr>
                    <td width="60%">
                        <img src="{{ public_path('app_local/img/logo.png') }}" alt="Company Logo" class="company-logo">
                    </td>
                    <td width="40%">
                        <div class="company-info">
                            <h3><strong>{{ setting('contact_name') }}</strong></h3>
                            <p>{{ setting('contact_email') }}</p>
                            <p>{{ setting('contact_whatsapp') }}</p>
                            <p>{{ setting('contact_alamat') }}</p>
                        </div>
                    </td>
                </tr>
            </table>
        </div>

        <div class="invoice-info">
            <table width="100%">
                <tr>
                    <td style="vertical-align: top;">
                        <div class="invoice-details">
                            <h2>Invoice Details</h2>
                            <p><strong>#{{ $item->no }}</strong></p>
                            <p><strong>Status: </strong>{{ $item->status_str }}</p>
                            <p><strong>Waktu Transaksi: </strong>{{ $item->created_at->format('d F Y H:i:s') }}</p>
                            <p><strong>Jenis Pengiriman: </strong>{{ $item->jenisPengiriman->name ?? '' }} <br>
                                <cite><small>{{ $item->jenisPengiriman->text ?? '' }}</small></cite>
                            </p>

                            @if ($item->jenis_pengiriman_id == 1)
                                <p><strong>Alamat: </strong>{{ $item->alamat_prov ?? '' }}<br>
                                    {{ $item->alamat ?? '' }}<br></p>
                            @endif
                            @if ($item->status == 'closed' && $item->jenis_pengiriman_id == 1)
                                <p><strong>No Resi: </strong>{{ $item->noresi ?? '' }}<br></p>
                            @endif
                            <p><strong>Catatan: </strong><br>
                                <cite><small>{{ $item->text ?? '' }}</small></cite>
                            </p>

                            @if ($item->status == 'rejected')
                                <p><strong>Alasan Pembatalan: </strong><br>
                                    <cite><small>{{ $item->text_reject ?? '' }}</small></cite>
                                </p>
                            @endif
                        </div>
                    </td>
                    <td style="vertical-align: top;">
                        <div class="customer-info">
                            <h2>Customer Information</h2>
                            <p><strong>Name: </strong>{{ $item->customer->name ?? '' }}</p>
                            <p><strong>Email: </strong>{{ $item->customer->email ?? '' }}</p>
                            <p><strong>Whatsapp: </strong>{{ $item->customer->nowa ?? '' }}</p>
                        </div>
                    </td>
                </tr>
            </table>
        </div>

        <div class="transaction-details">
            <table>
                <tbody>
                    @foreach ($item->lines as $line)
                        <tr>
                            <td width="70%">
                                <span
                                    style="font-weight: bold; padding-bottom:0;">{{ $line->merch->name_size }}</span><br>
                                {{ cleanNumber($line->merch->harga) }} x {{ cleanNumber($line->qty) }} Pcs
                            </td>
                            <td style="text-align: right;" class="total">Rp {{ cleanNumber($line->total) }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td width="70%" class="grandtotal">
                            Total
                        </td>
                        <td style="text-align: right;" class="grandtotal">Rp
                            {{ cleanNumber($item->lines->sum('total')) }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="thank-you">
            <strong>Terima kasih atas pembelian merchandise Jatim Pride Vol. 4!</strong>
            <p>Dukungan Anda sangat berarti bagi kami</p>
            <br>
            <p>Salam hangat,</p>
            <strong class="grandtotal">{{ setting('contact_name') }}</strong>
        </div>

        @if ($item->status == 'closed')
            <div class="paid-stamp">
                <img src="{{ public_path('app_local/img/paid.png') }}" alt="PAID Stamp">
            </div>
        @endif
    </div>
</body>

</html>
