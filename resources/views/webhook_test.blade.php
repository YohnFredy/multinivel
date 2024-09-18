<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario POST</title>
</head>
<body>
    <form id="postForm" method="POST" action="http://fornuvi.test/webhook/bold/payment-status">
        <label for="id">ID:</label>
        <input type="text" id="id" name="id" value="191850cb-00f8-4f64-aa5f-4975848e9428"><br><br>

        <label for="type">Type:</label>
        <input type="text" id="type" name="type" value="SALE_REJECTED"><br><br>

        <label for="subject">Subject:</label>
        <input type="text" id="subject" name="subject" value="CP332C3C9WZU"><br><br>

        <label for="source">Source:</label>
        <input type="text" id="source" name="source" value="/payments"><br><br>

        <label for="spec_version">Spec Version:</label>
        <input type="text" id="spec_version" name="spec_version" value="1.0"><br><br>

        <label for="time">Time:</label>
        <input type="text" id="time" name="time" value="1711989345347444700"><br><br>

        <h3>Data</h3>
        <label for="payment_id">Payment ID:</label>
        <input type="text" id="payment_id" name="payment_id" value="CP332C3C9WZU"><br><br>

        <label for="merchant_id">Merchant ID:</label>
        <input type="text" id="merchant_id" name="merchant_id" value="CKKA859CGE"><br><br>

        <label for="created_at">Created At:</label>
        <input type="text" id="created_at" name="created_at" value="2024-04-01T11:35:42-05:00"><br><br>

        <h3>Amount</h3>
        <label for="total">Total:</label>
        <input type="number" id="total" name="total" value="111111"><br><br>

        <h4>Taxes</h4>
        <label for="tax_base">Base:</label>
        <input type="number" id="tax_base" name="tax_base" value="96618"><br><br>

        <label for="tax_type">Type:</label>
        <input type="text" id="tax_type" name="tax_type" value="VAT"><br><br>

        <label for="tax_value">Value:</label>
        <input type="number" id="tax_value" name="tax_value" value="4831"><br><br>

        <label for="tip">Tip:</label>
        <input type="number" id="tip" name="tip" value="9662"><br><br>

        <h3>Card</h3>
        <label for="capture_mode">Capture Mode:</label>
        <input type="text" id="capture_mode" name="capture_mode" value="CHIP"><br><br>

        <label for="franchise">Franchise:</label>
        <input type="text" id="franchise" name="franchise" value="VISA"><br><br>

        <label for="cardholder_name">Cardholder Name:</label>
        <input type="text" id="cardholder_name" name="cardholder_name" value="DARIO SUAREZ RUBEN"><br><br>

        <label for="terminal_id">Terminal ID:</label>
        <input type="text" id="terminal_id" name="terminal_id" value="qpos_mini_27000230021050800072"><br><br>

        <label for="user_id">User ID:</label>
        <input type="text" id="user_id" name="user_id" value="b7221e5b-aa8a-4c13-8105-8771a0088d35"><br><br>

        <label for="payment_method">Payment Method:</label>
        <input type="text" id="payment_method" name="payment_method" value="CARD"><br><br>

        <h3>Metadata</h3>
        <label for="reference">Reference:</label>
        <input type="text" id="reference" name="reference" value="66D79A8F6E7E7624"><br><br>

        <label for="datacontenttype">Data Content Type:</label>
        <input type="text" id="datacontenttype" name="datacontenttype" value="application/json"><br><br>

        <button type="submit">Enviar</button>
    </form>
</body>
</html>
