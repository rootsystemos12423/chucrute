<!DOCTYPE html>
@php
    $order_customer_data = $order->customer_data ? json_decode($order->customer_data, true) : [];
    $order_shipping_data = $order->shipping_data ? json_decode($order->shipping_data, true) : [];
    $order_payment_data = $order->payment_data ? json_decode($order->payment_data, true) : [];
    $customization = json_decode($order->store->customizations->settings, true);
@endphp
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagamento via Pix</title>
    <style>
        body {
            font-family: 'Roboto', Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .wrapper {
            width: 100%;
            overflow-x: hidden;
            text-align: center;
            padding: 10px;
        }
        .content {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border-radius: 12px;
        }
        .header img {
            width: 150px;
            margin-bottom: 20px;
        }
        .body {
            text-align: left;
        }
        .highlight {
                padding: 15px;
                background: #f3f3f3;
                border: 2px dashed #666;
                font-size: 14px;
                text-align: center;
                border-radius: 8px;
                word-break: normal; /* Mantém palavras inteiras */
                overflow-wrap: anywhere; /* Quebra apenas no final da linha */
            }


        .button {
            display: block;
            width: fit-content;
            margin: 20px auto;
            padding: 12px 20px;
            background-color: #4cd286;
            color: #fff;
            text-decoration: none;
            font-weight: bold;
            border-radius: 6px;
            text-align: center;
            transition: 0.3s;
        }
        .button:hover {
            background-color: #3dbf72;
        }
        .summary {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
            padding: 15px;
            border-radius: 10px;
        }
        .summary th, .summary td {
            padding: 15px;
            text-align: left;
        }
        .summary img {
            border-radius: 6px;
        }
        .total {
            text-align: right;
            font-size: 18px;
        }
        .total-value {
            color: #4cd286;
            font-size: 20px;
            font-weight: 700;
        }
        .footer {
            margin-top: 30px;
            font-size: 12px;
            color: #888;
            text-align: center;
        }

        .msg-4020034663961969013 p {
            color: #74787e !important;
            font-size: 16px !important;
            line-height: 1.5em !important;
            margin-top: 0 !important;
            text-align: left !important;
        }

        .header {
            background: #ececec
        }

    </style>
</head>
<body>
    <div class="wrapper">
        <div class="content">
            <div class="header">
                <img src="{{ $customization['cabecalho_logo_path'] }}" alt="Logo">
            </div>
            <div class="body msg-4020034663961969013">
                <h1>Oi, {{ $order_customer_data['name'] }}! </h1>
                <p>Seu pedido foi reservado com sucesso! Para garantir sua compra, <strong style="color: #6a6a6a;">efetue o pagamento via Pix</strong> o quanto antes. </p>

                <h3 style="color: #74787e;
                font-size: 16px;
                line-height: 1.5em;
                margin-top: 0;
                text-align: left;
                font-weight: normal;">1. Copie o código abaixo</h3>
                <p class="highlight">
                    <strong style="font-size: 13px;">{{ $order_payment_data['url'] }}</strong>
                </p>

                <p>2. Abra seu aplicativo de pagamento onde você utiliza o Pix, escolha a opção <strong style="color: #6a6a6a;">Pix Copia e Cola</strong> e insira o código copiado.</p>

                <h3 style="color: #74787e;
                font-size: 11px;
                line-height: 1.5em;
                margin-top: 0;
                text-align: left;
                font-weight: normal;">Seu Pix expira dia <strong style="color: #6a6a6a;">{{ $order_payment_data['expirationDate'] }}</strong>. A confirmação de pagamento é realizada em poucos minutos. Se você já realizou o pagamento, desconsidere esta mensagem.</h3>

                <table class="summary msg-4020034663961969013">
                    <thead>
                        <tr>
                            <th colspan="2" style="color: #725bc2;     border-bottom: 1px solid #edeff2;
                                padding-bottom: 8px;
                                margin: 0;"><h3 style="color: #725bc2;
                                font-size: 14px;
                                font-weight: bold;
                                margin-top: 0;
                                text-align: left;">Resumo da Compra</h3></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->cart->items as $item)
                            <tr>
                                <td width="80">
                                    <img src="{{ $item->image }}" width="70" alt="Produto">
                                </td>
                                <td>
                                    <p style="color: #74787e;
                                        font-size: 13px;
                                        line-height: 1.5em;
                                        margin-top: 0;
                                        text-align: left;">{{ $item->title }}</p>
                                    <p style="color: #74787e;
                                    font-size: 13px;
                                    line-height: 1.5em;
                                    margin-top: 0;
                                    text-align: left;">R$ {{ number_format($item->price / 100, 2, ',', '.') }} x {{ $item->quantity }} <strong style="color: #4cd286;">R$ {{ number_format(($item->price * $item->quantity) / 100, 2, ',', '.') }}</strong></p>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <table style="margin-top: 20px;
                        background: #f8f8f8;
                        padding: 30px 20px;
                        width: 100%;">
                    <tr>
                        <td style="text-align:right;font-size:20px" class="m_-4020034663961969013color-green" valign="top">Total</td>
                        <td style="padding-left:10px" valign="top">
                        <strong style="font-size:20px; color: #4cd286;" class="m_-4020034663961969013color-green"> 1x de R$ {{ number_format($order->total_value / 100, 2, ',', '.') }} </strong>
                        </td>
                    </tr>
                </table>

            </div>
            <div class="footer">
                <p>Se precisar de ajuda, entre em contato com nosso suporte. 📩</p>
            </div>
        </div>
    </div>
</body>
</html>
