<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Transaksi Berhasil - {{ $item->no }}</title>
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap");

        body {
            color: black;
            font-family: "Inter", sans-serif;
            line-height: 1.4;
            word-wrap: break-word;
        }

        .container {
            width: 500px;
            margin: 0 auto;
            border-collapse: collapse;
            border-spacing: 0;
            text-align: inherit;
            vertical-align: top;
        }

        .logo img {
            clear: both;
            display: block;
            max-width: 100%;
            outline: 0;
            text-decoration: none;
            width: 140px;
        }

        .header {
            font-size: 20px;
            font-weight: 500 !important;
            line-height: 26px;
        }

        .header-strong {
            font-size: 28px;
            font-weight: 800 !important;
            line-height: 34px;
        }

        .transaction-box {
            border: black;
            color: black;
            width: 500px;
            margin: 0 auto;
            text-align: left;
        }

        .transaction-box th {
            padding: 5px;
            color: black;
            line-height: 1.4;
        }

        .transaction-no {
            font-size: 14px;
            font-weight: 800 !important;
            line-height: 20px;
            padding-bottom: 6px !important;
            padding-top: 6px !important;
        }

        .divider {
            border-bottom-width: 1px;
            border-bottom-color: #d6d6d6;
            border-bottom-style: solid;
            font-weight: 400;
            height: 1px !important;
        }

        .transaction-details {
            font-size: 14px;
            font-weight: 800 !important;
            line-height: 20px;
            padding-bottom: 6px !important;
            padding-top: 6px !important;
        }

        .footer {
            color: #5e5e5e !important;
            font-size: 12px;
            font-weight: 400;
            line-height: 16px;
        }
    </style>
</head>

<body>
    <center style="min-width: 500px; width: 100%">
        <table class="container" bgcolor="#fff" width="100%">
            <tbody>
                <tr style="vertical-align: top" align="left">
                    <td valign="top">
                        <!-- LOGO -->
                        <table class="container" bgcolor="#fff" width="100%">
                            <tbody>
                                <tr style="vertical-align: top" align="left">
                                    <td valign="top" align="center" class="logo">
                                        <img src="{{ $logo }}" alt="JATIMPRIDE" class="CToWUd" data-bit="iit" />
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <!-- LOGO -->

                        <!-- HEADER -->
                        <br />
                        <table class="container" bgcolor="#fff" width="100%">
                            <tbody>
                                <tr style="vertical-align: top" align="left">
                                    <th>
                                        <div class="header">
                                            Hai {{ $item->customer->name ?? '' }},
                                        </div>
                                        <div class="header-strong">
                                            {{ $subject }}
                                        </div>
                                        <div style="text-align: justify;">
                                            <small>{{ $text }}</small>
                                        </div>
                                    </th>
                                </tr>
                            </tbody>
                        </table>
                        <!-- HEADER -->

                        <!-- BOX -->
                        <br />
                        <table class="transaction-box" bgcolor="#fff" width="100%">
                            <tbody>
                                <tr style="vertical-align: top" align="left">
                                    <th colspan="2">
                                        <div class="transaction-no">No #{{ $item->no }}</div>
                                    </th>
                                </tr>
                                <tr style="vertical-align: top" align="left">
                                    <th colspan="2">
                                        <div class="divider"></div>
                                    </th>
                                </tr>
                                <tr style="vertical-align: top" align="left">
                                    <th style="width: 140px">Status</th>
                                    <th>: {!! $item->status_formatted !!}</th>
                                </tr>
                                <tr style="vertical-align: top" align="left">
                                    <th style="width: 140px">Waktu Transaksi</th>
                                    <th>: {{ $item->created_at->format('d F Y H:i:s') }}</th>
                                </tr>
                                <tr style="vertical-align: top" align="left">
                                    <th style="width: 140px">Jenis Pengiriman</th>
                                    <th>: {{ $item->jenisPengiriman->name ?? '' }}<br>
                                        {{ $item->alamat_prov ?? '' }}<br>
                                        {{ $item->alamat ?? '' }}<br>
                                    </th>
                                </tr>
                                @if ($item->status == 'closed' && $item->jenis_pengiriman_id == 1)
                                    <tr style="vertical-align: top" align="left">
                                        <th style="width: 140px">No Resi</th>
                                        <th>: {{ $item->noresi ?? '' }}</th>
                                    </tr>
                                @endif
                                <tr style="vertical-align: top" align="left">
                                    <th style="width: 140px">Catatan</th>
                                    <th>: {{ $item->text ?? '' }}</th>
                                </tr>
                                @if ($item->status == 'rejected')
                                    <tr style="vertical-align: top" align="left">
                                        <th style="width: 140px">Alasan Pembatalan</th>
                                        <th>: {{ $item->text_reject ?? '' }}</th>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                        <!-- BOX -->

                        <br />
                        <table class="container" bgcolor="#fff" width="100%">
                            <tbody>
                                <tr style="vertical-align: top" align="left">
                                    <th colspan="2">
                                        <div class="header">Detail transaksi</div>
                                    </th>
                                </tr>
                                <tr style="vertical-align: top" align="left">
                                    <th colspan="2">
                                        <div class="divider"></div>
                                    </th>
                                </tr>
                                @foreach ($item->lines as $line)
                                    <tr style="vertical-align: top" align="left">
                                        <th>
                                            <div class="transaction-details">
                                                {{ $line->merch->name }}
                                                <br />
                                                <small>{{ $line->harga_formatted }} x {{ $line->qty }}</small>
                                            </div>
                                        </th>
                                        <th style="text-align: end; vertical-align: middle">
                                            <div class="transaction-details">
                                                {{ $line->total_formatted }}
                                            </div>
                                        </th>
                                    </tr>
                                @endforeach

                                <tr style="vertical-align: top" align="left">
                                    <th>
                                        <div class="transaction-details">Total:</div>
                                    </th>
                                    <th style="text-align: end">
                                        <div class="transaction-details" align="right">
                                            Rp {{ cleanNumber($item->total) }}
                                        </div>
                                    </th>
                                </tr>
                            </tbody>
                        </table>

                        <br />
                        <table class="container" bgcolor="#fff" width="100%">
                            <tbody>
                                <tr style="vertical-align: top" align="left">
                                    <th>
                                        <div class="footer">
                                            {{ setting('contact_name') }}<br />
                                            {{ setting('contact_alamat') }}<br />
                                            © {{ date('Y') }} JATIMPRIDE.
                                        </div>
                                    </th>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
        <br /><br />
    </center>
</body>

</html>
