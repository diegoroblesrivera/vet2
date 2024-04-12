<!-- reports/service-order-invoice.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Order Invoice</title>


</head>
<body>
    <h1>Service Order Invoice</h1>
    
    <!-- Aquí puedes acceder a los datos adicionales -->
    <p>Additional Data:</p>
    <ul>
        <button class="btn btn-info">I'm Just a Button</button>
        <li>Campo 1: {{ $additional_data['campo1'] }}</li>
    </ul>

    <!-- Aquí puedes acceder a los datos de la orden -->
    <p>Order Data:</p>
    <!-- Por ejemplo, si hay una variable $order que contiene los datos de la orden -->
    <p>Order ID: 60</p>
    <!-- Coloca más código para mostrar los detalles de la orden según sea necesario -->

    <!-- Aquí puedes acceder a los datos de la información de la empresa -->
    <p>Company Info:</p>
    <!-- Por ejemplo, si hay una variable $company_info que contiene los datos de la empresa -->
    <p>Company Name: Facil Vet</p>
    <!-- Coloca más código para mostrar los detalles de la empresa según sea necesario -->
</body>
</html>
