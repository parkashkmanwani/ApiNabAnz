<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased">
    <h2>Payment Transfer Gateway</h2>
    <form action="/payCreditCard" method="POST">
        {!! csrf_field() !!}
        <label for="number">Credit Card Number: </label>
        {{ Form::input('number', 'credit_card_number') }}<br /><br />
        <label for="name">Credit Card Name: </label>
        {{ Form::input('text', 'credit_card_name') }}<br /><br />
        <label for="cvv">CVV: </label>
        {{ Form::input('number', 'cvv') }}<br /><br />
        <label for="valid">Valid Until: </label>
        {{ Form::date('date', 'credit_card_name') }}<br /><br />
        <label for="valid">Amount: </label>
        {{ Form::input('number', 'amount') }}<br /><br /><br />

        <button type="submit" name="submit" value = "nab">Pay with NAB</button>&nbsp;&nbsp;&nbsp;
        <button type="submit" name="submit" value = "anz">Pay with ANZ</button>
    </form>

    </body>
</html>
