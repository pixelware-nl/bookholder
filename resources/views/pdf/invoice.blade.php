@extends('pdf.layout', ['title' => 'Invoice'])

@section('content')
<table class="header mb-1">
    <tr>
        <td class="align-left"> <span> PIXELWARE™ </span> </td>
        <td class="align-right"> NO. 000031 </td>
    </tr>
</table>
<h1 class="title mb-2"> <span> FACTUUR. </span> </h1>
<p class="date mb-2"> <span> Datum: </span> 08/07/2024 </p>
<table class="from-to mb-2">
    <tr>
        <td> <span> Naar: </span> </td>
        <td> <span> Van: </span> </td>
    </tr>
    <tr>
        <td> Inshared B.V. </td>
        <td> Pixelware </td>
    </tr>
    <tr>
        <td> 56 Leusderend, Leusden </td>
        <td> Huidenclubplein 4C, Rotterdam </td>
    </tr>
    <tr>
        <td> Utrecht, 3832RC </td>
        <td> Zuid-Holland, 3029PB </td>
    </tr>
    <tr>
        <td> invoice@inshared.nl </td>
        <td> o.ozbek@pixelware.nl </td>
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
        <tr>
            <td> Development (Team Finance) </td>
            <td> 10 </td>
            <td> €80 </td>
            <td> €800 </td>
        </tr>
        <tr>
            <td> Development (Team Infra) </td>
            <td> 4 </td>
            <td> €80 </td>
            <td> €400 </td>
        </tr>
        <tr>
            <th></th>
            <th></th>
            <th> Totaal </th>
            <th> €1200 </th>
        </tr>
    </table>
</div>
<div class="footer"> <span> Termen: </span> Gelieve het factuur bedrag binnen 30 dagen betalen. </div>
@endsection
