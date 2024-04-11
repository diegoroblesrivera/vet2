<!-- reports/service-order-invoice.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Order Invoice</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
     integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"
     integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>

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
