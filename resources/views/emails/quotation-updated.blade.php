<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    <title>Quotation Updated</title>
</head>

<body>
    <h2>Quotation Updated</h2>
    <p>Dear {{ $quotation->user->name }},</p>

    <p>vi informiamo che la quotation con ID {{ $quotation->id }} è stata modificata.</p>

    <p>Qui i dettagli:</p>

    <ul>
        <li>Total Price: {{ $quotation->total_price }}</li>
        <li>Taxable Price: {{ $quotation->taxable_price }}</li>
        <li>Tax Price: {{ $quotation->tax_price }}</li>
    </ul>


</body>

</html>
