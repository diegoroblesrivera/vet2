<!-- reports/service-order-invoice.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Order Invoice</title>
    <style>
        table {
            width: 100%;
        }
        * {
  margin: 0;
  padding: 0;
}

body {
  font-family: roboto;
  background: white;
}

.material-icons {
  cursor: pointer;
}

.invoice-container {
  margin: auto;
  padding: 0px 20px;
}

.invoice-header {
  display: flex;
  padding: 70px 0%;
  width: 100%;
}

.title {
  font-size: 18px;
  letter-spacing: 3px;
  color: rgb(66, 66, 66);
}

.date {
  padding: 5px 0px;
  font-size: 14px;
  letter-spacing: 3px;
  color: rgb(156, 156, 156);
}

.invoice-number {
  font-size: 17px;
  letter-spacing: 2px;
  color: rgb(156, 156, 156);
}

.space {
  width: 50%;
}

table {
  table-layout: auto;
  width: 100%;
}
table, th, td {
  border-collapse: collapse;
}

th {
  padding: 10px 0px;
  border-bottom: 1px solid rgb(187, 187, 187);
  border-bottom-style: dashed;
  font-weight: 400;
  font-size: 13px;
  letter-spacing: 2px;
  color: gray;
  text-align: left;

}

td {
  padding: 10px 0px;
  border-bottom: 0.5px solid rgb(226, 226, 226);
  text-align: left;
}

.dashed {
  border-bottom: 1px solid rgb(187, 187, 187);
  border-bottom-style: dashed;
}

.total {
  font-weight: 800;
  font-size: 20px !important;
  color: black;
}

input[type=number] {
  text-align: center ;
  max-width: 50px;
  font-size: 15px;
  padding: 10px;
  border: none;
  outline: none;
}

input[type=text] {
  max-width: 170px;
  text-align: left;
  font-size: 15px;
  padding: 10px;
  border: none;
  outline: none;
}

input[type=text]:focus {
  border-radius: 5px;
  background: #ffffff;
  box-shadow:  11px 11px 22px #d9d9d9,
           -11px -11px 22px #ffffff;
}

input[type=number]:focus {
  border-radius: 5px;
  background: #ffffff;
  box-shadow:  11px 11px 22px #d9d9d9,
           -11px -11px 22px #ffffff;
}

input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
-webkit-appearance: none;
margin: 0;
}
/* Firefox */
input[type=number] {
-moz-appearance: textfield;
}

.float{
  width:40px;
  height:40px;
  background-color:#FF1D89;
  color:#FFF;
  border-radius:100%;
  text-align:center;
  box-shadow:
0 2.8px 2.2px rgba(0, 0, 0, 0.048),
0 6.7px 5.3px rgba(0, 0, 0, 0.069),
0 12.5px 10px rgba(0, 0, 0, 0.085),
0 22.3px 17.9px rgba(0, 0, 0, 0.101),
0 41.8px 33.4px rgba(0, 0, 0, 0.122),
0 100px 80px rgba(0, 0, 0, 0.17);
}

.float:hover {
  background-color:#ff057e;
}

.plus{
  margin-top:10px;
}

#sum {
  text-align: right;
  width: 100%;
}

#sum input[type=text] {
  width: 100%;
  font-size: 33px !important;
  color: black;
  text-align: right !important;

}

/* Medium devices (landscape tablets, 768px and up) */
@media only screen and (min-width: 768px) {
  body {
      background: lemonchiffon;
  }
  .invoice-container {
      border: solid 1px gray;
      width: 60%;
      margin: 50px auto;
      padding: 40px;
      padding-bottom: 100px;
      border-radius: 5px;
      background: white;
      box-shadow:
0 2.8px 2.2px rgba(0, 0, 0, 0.02),
0 6.7px 5.3px rgba(0, 0, 0, 0.028),
0 12.5px 10px rgba(0, 0, 0, 0.035),
0 22.3px 17.9px rgba(0, 0, 0, 0.042),
0 41.8px 33.4px rgba(0, 0, 0, 0.05),
0 100px 80px rgba(0, 0, 0, 0.07);
  }

  .title-date {
      width: 20%;
  }
  .invoice-number {
      width: 20%;
  }
  .space {
      width: 80%;
  }
}
    </style>

</head>
<body>
    
    <table>
        <tbody>
            <tr>
                <td><h1>Receta Fácil Vet N° {{ $additional_data['campo2'] }} </h1></td>
                <td>Aca Va el Logo</td>
            </tr>
        </tbody>
    </table>
    <br><br><br>
    <table>
        <tbody>
            <tr>
                <td WIDTH="80" ><b>Nombre Cliente</b></td>
                <td>{{ $customer['full_name'] }}</td>
                <td><b>RUN</b></td>
                <td>{{ $customer['run'] }}</td>
            </tr>
            <tr>
                <td><b>Email</b></td>
                <td>{{ $customer['email'] }}</td>
                <td><b>Cel</b></td>
                <td>{{ $customer['phone_no'] }}</td>
            </tr>
            
            <tr>
                <td><b>Nombre mascota</b></td>
                <td>{{ $pet['nombre'] }}</td>
                <td><b>Especie</b></td>
                <td>{{ $pet['especie'] }}</td>
            </tr>
            <tr>
                <td><b>Sexo</b></td>
                <td>{{ $pet['sexo'] }}</td>
                <td><b>Castrado</b></td>
                <td>{{ $pet['estado_repro'] }}</td>
            </tr>
            {{-- <tr>
                <td>Cell 1x5</td>
                <td>Cell 2x5</td>
                <td>Cell 3x5</td>
                <td>Cell 4x5</td>
            </tr> --}}
        </tbody>
    </table>
    
    <!-- Aquí puedes acceder a los datos adicionales -->
    <p>Intruncciones Veterinario:</p>
    <ul>
        
        <li> {{ $additional_data['campo1'] }}</li>
    </ul>

    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    <!-- Aquí puedes acceder a los datos de la información de la empresa -->
    <p>Fecha : {{date('now')}}</p>
    <!-- Por ejemplo, si hay una variable $company_info que contiene los datos de la empresa -->
    <p>Company Name: Facil Vet</p>
    <!-- Coloca más código para mostrar los detalles de la empresa según sea necesario -->
</body>
</html>
