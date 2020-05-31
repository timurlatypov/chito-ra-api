<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        body {
            font-size: 14px;
        }

        .text-center {
            text-align: center;
        }

        @media only screen and (max-width: 800px) {
            .inner-body {
                width: 100% !important;
            }

            .footer {
                width: 100% !important;
            }
        }

        @media only screen and (max-width: 700px) {
            .button {
                width: 100% !important;
            }
        }

        /* Base */

        body, body *:not(html):not(style):not(br):not(tr):not(code) {
            font-family: Helvetica, sans-serif;
            box-sizing: border-box;
        }

        body {
            background-color: #f5f8fa;
            color: #313131;
            height: 100%;
            hyphens: auto;
            line-height: 1.4;
            margin: 0;
            -moz-hyphens: auto;
            -ms-word-break: break-all;
            width: 100% !important;
            -webkit-hyphens: auto;
            -webkit-text-size-adjust: none;
            word-break: break-all;
            word-break: break-word;
        }

        p,
        ul,
        ol,
        blockquote {
            line-height: 1.4;
            text-align: left;
        }

        a {
            color: #ca9f5e;
            text-decoration: none;
        }

        a img {
            border: none;
        }

        /* Typography */

        h1 {
            color: #2F3133;
            font-size: 19px;
            font-weight: bold;
            margin-top: 0;
            text-align: left;
        }

        h2 {
            color: #2F3133;
            font-size: 16px;
            font-weight: bold;
            margin-top: 0;
            text-align: left;
        }

        h3 {
            color: #2F3133;
            font-size: 14px;
            font-weight: bold;
            margin-top: 0;
            text-align: left;
        }

        p {
            color: inherit;
            font-size: 14px;
            line-height: 1.5em;
            margin-top: 0;
            text-align: left;
        }

        p.sub {
            font-size: 12px;
        }

        img {
            max-width: 100%;
        }

        /* Layout */

        .wrapper {
            background-color: #f5f8fa;
            margin: 0;
            padding: 0;
            width: 100%;
            -premailer-cellpadding: 0;
            -premailer-cellspacing: 0;
            -premailer-width: 100%;
        }

        .content {
            margin: 0;
            padding: 0;
            width: 100%;
            -premailer-cellpadding: 0;
            -premailer-cellspacing: 0;
            -premailer-width: 100%;
        }

        /* Header */

        .header {
            padding: 25px 0;
            text-align: center;
        }

        .header a {
            color: #bbbfc3;
            font-size: 19px;
            font-weight: bold;
            text-decoration: none;
            text-shadow: 0 1px 0 white;
        }

        /* Body */

        .body {
            background-color: #FFFFFF;
            border-bottom: 1px solid #EDEFF2;
            border-top: 1px solid #EDEFF2;
            margin: 0;
            padding: 0;
            width: 100%;
            -premailer-cellpadding: 0;
            -premailer-cellspacing: 0;
            -premailer-width: 100%;
        }

        .inner-body {
            background-color: #FFFFFF;
            margin: 0 auto;
            padding: 0;
            width: 770px;
            -premailer-cellpadding: 0;
            -premailer-cellspacing: 0;
            -premailer-width: 770px;
        }

        /* Subcopy */

        .subcopy {
            border-top: 1px solid #EDEFF2;
            margin-top: 25px;
            padding-top: 25px;
        }

        .subcopy p {
            font-size: 12px;
        }

        /* Footer */

        .footer {
            margin: 0 auto;
            padding: 0;
            text-align: center;
            width: 770px;
            -premailer-cellpadding: 0;
            -premailer-cellspacing: 0;
            -premailer-width: 770px;
        }

        .footer p {
            color: inherit;
            font-size: 12px;
            text-align: center;
        }

        /* Tables */

        .table table {
            margin: 30px auto;
            width: 100%;
            -premailer-cellpadding: 0;
            -premailer-cellspacing: 0;
            -premailer-width: 100%;
        }

        .table th {
            border-bottom: 1px solid #EDEFF2;
            padding-bottom: 8px;
            margin: 0;
        }

        .table td {
            color: #000000;
            font-size: 14px;
            line-height: 18px;
            padding: 10px 0;
            margin: 0;
        }

        .content-cell {
            padding: 35px;
        }

        /* Buttons */

        .action {
            margin: 30px auto;
            padding: 0;
            text-align: center;
            width: 100%;
            -premailer-cellpadding: 0;
            -premailer-cellspacing: 0;
            -premailer-width: 100%;
        }

        .button {
            border-radius: 3px;
            box-shadow: 0 2px 3px rgba(0, 0, 0, 0.16);
            color: #FFF;
            display: inline-block;
            text-decoration: none;
            -webkit-text-size-adjust: none;
        }

        .button-blue {
            background-color: #3097D1;
            border-top: 10px solid #3097D1;
            border-right: 18px solid #3097D1;
            border-bottom: 10px solid #3097D1;
            border-left: 18px solid #3097D1;
        }

        .button-green {
            background-color: #2ab27b;
            border-top: 10px solid #2ab27b;
            border-right: 18px solid #2ab27b;
            border-bottom: 10px solid #2ab27b;
            border-left: 18px solid #2ab27b;
        }

        .button-red {
            background-color: #bf5329;
            border-top: 10px solid #bf5329;
            border-right: 18px solid #bf5329;
            border-bottom: 10px solid #bf5329;
            border-left: 18px solid #bf5329;
        }

        /* Panels */

        .panel {
            margin: 0 0 21px;
        }

        .panel-content {
            background-color: #EDEFF2;
            padding: 16px;
        }

        .panel-item {
            padding: 0;
        }

        .panel-item p:last-of-type {
            margin-bottom: 0;
            padding-bottom: 0;
        }

        /* Promotions */

        .promotion {
            background-color: #FFFFFF;
            border: 2px dashed #9BA2AB;
            margin: 0;
            margin-bottom: 25px;
            margin-top: 25px;
            padding: 24px;
            width: 100%;
            -premailer-cellpadding: 0;
            -premailer-cellspacing: 0;
            -premailer-width: 100%;
        }

        .promotion h1 {
            text-align: center;
        }

        .promotion p {
            font-size: 14px;
            text-align: center;
        }
    </style>
</head>
<body>

<table class="wrapper" width="100%" cellpadding="0" cellspacing="0">
    <tr>
        <td align="center">
            <table class="content" width="100%" cellpadding="0" cellspacing="0">

                <!-- Email Body -->
                <tr>
                    <td class="body" width="100%" cellpadding="0" cellspacing="0">

                        Новый заказ <b>{{ $order->id }}</b>
                        <br><br>
                        Клиент: <b>{{ $order->user->name }}</b><br>
                        Телефон: <b>{{ $order->address->phone }}</b><br>
                        Email: <b>{{ $order->user->email }}</b>
                        <br><br>
                        <b>Адрес доставки:</b> {{ $order->address->address }}
                        <br><br>
                        <b>Комментарий:</b> {{ $order->address->comment }}
                        <br><br>

                        Заказ:
                        <table class="table" width="100%" cellpadding="4px" cellspacing="2px">
                            <thead>
                            <tr style="background-color: #dddddd">
                                <th></th>
                                <th>Название</th>
                                <th>Кол-во</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($order->products as $item)
                                <tr style="background-color: #f9f9f9">
                                    <td class="width:130px">
                                        <img width="120px"
                                             src="https://api.chito-ra.ru/storage/{{ $item->product->images->first()->name }}">
                                    </td>
                                    <td>
                                        <b>{{ $item->product->name }}</b>
                                    </td>
                                    <td class="text-center">{{ $item->pivot->quantity }} шт.</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <br>
                        <h4 class="uppercase text-gray-700 text-md font-bold mb-2">Общая стоимость</h4>
                        <b>{!! $order->formattedSubtotal !!}</b>
                    </td>
                </tr>
            </table>
        </td>
    </tr>

    <tr>
        <td>
            <table class="footer" align="center" width="570" cellpadding="0" cellspacing="0">
                <tr>
                    <td class="content-cell" align="center">
                        <div>
                            <p>Чито-ра - Ресторан грузинской кухни в Москве</p>
                            <a href="tel:74994447474">+7 (499) 444-74-74</a>
                            <br><br>
                            <p>&copy; {{ date('Y') }} <a href="www.chito-ra.ru">www.chito-ra.ru</a></p>
                        </div>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</td>
</tr>
</table>

</body>
</html>
