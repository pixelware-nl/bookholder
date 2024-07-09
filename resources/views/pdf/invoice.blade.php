@extends('pdf.layout', ['title' => 'Invoice'])

@section('content')
<h1 class="title mb-2"> <span> FACTUUR. </span> </h1>
<p class="date mb-2"> <span> Datum: </span> {{ \Carbon\Carbon::now()->format('d-m-Y') }} </p>
<table class="from-to mb-2">
    <tr>
        <td> <span> Naar: </span> </td>
        <td> <span> Van: </span> </td>
    </tr>
    <tr>
        <td> {{ $toCompany->name }} </td>
        <td> {{ $fromCompany->name }} </td>
    </tr>
    <tr>
        <td> {{ sprintf('%s, %s', $fromCompany->street_address, $fromCompany->city) }} </td>
        <td> {{ sprintf('%s, %s', $toCompany->street_address, $toCompany->city) }} </td>
    </tr>
    <tr>
        <td> {{ sprintf('%s, %s', $fromCompany->province, $fromCompany->postal_code) }} </td>
        <td> {{ sprintf('%s, %s', $toCompany->province, $toCompany->postal_code) }} </td>
    </tr>
    <tr>
        <td> {{ $fromCompany->email }} </td>
        <td> {{ $toCompany->email }}</td>
    </tr>
</table>
<div>
    <table class="product-table mb-2">
        <tr>
            <th> Product </th>
            <th> Aantal </th>
            <th> Tarief (€) </th>
            <th> Totaal </th>
        </tr>
        @foreach($logs as $log)
            <tr>
                <td> {{ $log->product->name }} </td>
                <td> {{ $log->hours }} </td>
                <td> {{ sprintf('€%s', number_format($log->rate, decimal_separator: ',', thousands_separator: '.')) }} </td>
                <td> {{ sprintf('€%s', number_format($log->rate * $log->hours, decimal_separator: ',', thousands_separator: '.')) }} </td>
            </tr>
        @endforeach
        <tr>
            <th></th>
            <th></th>
            <th> Totaal </th>
            <th> {{ sprintf('€%s', number_format($total, decimal_separator: ',', thousands_separator: '.')) }} </th>
        </tr>
    </table>
</div>
<div class="footer"> <span> Termen: </span> Gelieve het factuur bedrag binnen 30 dagen betalen. </div>
@endsection
