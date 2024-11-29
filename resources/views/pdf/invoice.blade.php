@extends('pdf.layout', ['title' => 'Invoice'])

@section('content')
    <h1 class="title mb-2"> <span> FACTUUR. </span> </h1>
    <table class="from-to mb-2">
        <tr>
            <td> <span> Gegenereerd op: </span> {{ \Carbon\Carbon::now()->format('d-m-Y') }} </p> </td>
            <td> <span> Uren reeks: </span> {{ $invoice->start_date->format('d/m/Y') }} t/m {{ $invoice->end_date->format('d/m/Y') }}  </p> </td>
        </tr>
    </table>
    <table class="from-to mb-2">
        <tr>
            <td> <span> Naar: </span> </td>
            <td> <span> Van: </span> </td>
        </tr>
        <tr>
            <td> {{ $invoice->toCompany->name }} </td>
            <td> {{ $invoice->fromCompany->name }} </td>
        </tr>
        <tr>
            <td> {{ sprintf('%s, %s', $invoice->toCompany->street_address, $invoice->toCompany->city) }} </td>
            <td> {{ sprintf('%s, %s', $invoice->fromCompany->street_address, $invoice->fromCompany->city) }} </td>
        </tr>
        <tr>
            <td> {{ sprintf('%s, %s', $invoice->toCompany->postal_code, $invoice->toCompany->country) }} </td>
            <td> {{ sprintf('%s, %s', $invoice->fromCompany->postal_code, $invoice->fromCompany->country) }} </td>
        </tr>
        <tr>
            <td> {{ $invoice->toCompany->email }} </td>
            <td> {{ $invoice->fromCompany->email }}</td>
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
            @foreach($invoice->body->logs as $log)
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
                <th> {{ sprintf('€%s', number_format($invoice->body->total, decimal_separator: ',', thousands_separator: '.')) }} </th>
            </tr>
        </table>
    </div>
    <div class="footer"> <span> Termen: </span> Gelieve het factuur bedrag binnen 30 dagen betalen. </div>
@endsection
