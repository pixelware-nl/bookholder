@extends('pdf.layout', ['title' => 'Invoice'])

@section('content')
    <h1 class="title mb-2"> <span> FACTUUR. </span> </h1>
    <table class="from-to mb-2">
        <tr>
            <td> <span> Gegenereerd op: </span> {{ \Carbon\Carbon::now()->format('d-m-Y') }} </p> </td>
            <td> <span> Uren reeks: </span> {{ $start_date->format('d/m/Y') }} - {{ $end_date->format('d/m/Y') }}  </p> </td>
        </tr>
    </table>
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
            <td> {{ sprintf('%s, %s', $toCompany->street_address, $toCompany->city) }} </td>
            <td> {{ sprintf('%s, %s', $fromCompany->street_address, $fromCompany->city) }} </td>
        </tr>
        <tr>
            <td> {{ sprintf('%s, %s', $toCompany->postal_code, $toCompany->country) }} </td>
            <td> {{ sprintf('%s, %s', $fromCompany->postal_code, $fromCompany->country) }} </td>
        </tr>
        <tr>
            <td> {{ $toCompany->email }} </td>
            <td> {{ $fromCompany->email }}</td>
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
            @foreach($body->logs as $log)
                <tr>
                    <td> {{ $log->name }} </td>
                    <td> {{ $log->hours }} </td>
                    <td> {{ sprintf('€%s', number_format($log->rate, decimal_separator: ',', thousands_separator: '.')) }} </td>
                    <td> {{ sprintf('€%s', number_format($log->rate * $log->hours, decimal_separator: ',', thousands_separator: '.')) }} </td>
                </tr>
            @endforeach
            <tr>
                <th></th>
                <th></th>
                <th> Totaal </th>
                <th> {{ sprintf('€%s', number_format($body->total, decimal_separator: ',', thousands_separator: '.')) }} </th>
            </tr>
        </table>
    </div>
    <div class="footer"> <span> Termen: </span> Gelieve het factuur bedrag binnen 30 dagen betalen. </div>
@endsection
