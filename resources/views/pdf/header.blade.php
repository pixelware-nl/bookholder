<header>
    <table class="top-header">
        <tr>
            <td class="align-left"> <span class="logo-weight-black"> {{ ucfirst($invoice->fromCompany->name) }} </span> </td>
            <td class="align-right"> NO. {{ str_pad($invoice->id, 8, '0', STR_PAD_LEFT) }} </td>
        </tr>
    </table>
</header>
