<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cotización</title>

    <style> 

        body {
            font-family: Arial, Helvetica, sans-serif;
        }

        html {
            width:100%;
            margin: 60px 60px;
            font-size: 12px;
        }

        img{
            max-width: 100%;
        }

        .d-inline-block {
            display: inline-block;
        }
        
        
        .bold {
            font-weight: bold;
        }
    
        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .text-left {
            text-align: left;
        }

        table {
            width: 100%;
        } 

        table, tr, td {
            padding-left: 0;
        }

        td {
            /* text-align: center; */
            /* vertical-align: middle; */
        }



        .logo-container {
            width: 25%;
        }

        .header-text {
            width: 50%;
            margin-left: 10px;
            text-align: center;
            font-size: 15px;
            padding-top: 0; 
        }

        .nombre {
            font-size: 15px;
        }

        .titulo {
            width: 25%;
            color: rgb(126, 126, 126) ;
            font-size: 30px;
            text-align: right
        }

        .datos {
            width: 100%;
        }

        .fecha {
            width: 100%;
        }

        .fiscales, p {
            margin-top: 0px;
            margin-bottom: 2px;
        }

        .cotizacion {
            padding: 0;
            vertical-align:top;
        }

        .lista td, .lista th {
            border: 1px solid rgb(104, 103, 103);
            border-collapse: collapse;
            padding: 2px 4px;
            height: 15px;
        }

    </style>
</head>
<body>
    <header>
        <table>
            <tr>
                <td class="logo-container">
                    <img class="logo" src="https://i.ibb.co/gTQ9MSn/329102213-755773929293558-3488322884504947897-n.jpg" alt="Logotipo de neongonz">
                </td>
                
                <td class="header-text">
                    <h1 class="nombre bold">Carlos Ramón González Oloarte</h1>
                    <P class="bold">RFC: GOOC021121EX0</P>
                </td>
        
                <td class="titulo">
                    <p>Cotización</p>
                </td>
            </tr>
        </table>
    </header>


    <table class="datos">
        <tr>
            <td colspan="2" class="fecha"><p class="text-right"><span class="bold">Fecha: </span>{{ $fecha }}</p></td>
        </tr>
        <tr>
            <td class="fiscales">
                <p>Domicilio fiscal: Calle 1, MZ 1, LT 15, Col. Xalpa, Alc. Iztapalapa. Ciudad de México.</p>
                <p>Teléfonos: 55 3026 3911, 55 1503 4980, 55 3026 3958</p>
                <p>Correo electrónico: neongonz@hotmail.com</p>
            </td>
            <td class="cotizacion">
                <p><span class="bold">Cotización No.</span> 218</p>
            </td>
        </tr>
    </table>

    <main>

        <br>
        <p class="bold">Cotización para:</p>
        <table class="destinatario">
            <tr>
                <td style="width: 505px">
                    BIMBO, S.A DE C.V
                </td>
                <td><span class="bold">AT'N:</span> {{ $agencia->responsable }} </td>
            </tr>
            <tr>
                <td>
                    {{ $agencia->nombre }}
                </td>
            </tr>
        </table>
    
        <br>
    
        <br>
        <p class="bold">Comentarios o instrucciones especiales:</p>
        <table class="lista" cellspacing="0" cellpadding="0">
            <tr>
                <th class="bold">Cantidad</th>
                <th class="bold">Descripción</th>
                <th class="bold">Precio</th>
                <th class="bold">Total</th>
            </tr>

            @foreach ($servicios as $servicio)                
                <tr>
                    <td class="text-center" style="min-width: 70px">{{ $servicio->cantidad }}</td>
                    <td class="text-center">
                        {{ $servicio->concepto . '. ECO. ' }}
                        @foreach ($servicio->listaEconomicos as $economico)
                            {{ $economico->economico . ',' }}
                        @endforeach
                    </td>
                    <td class="text-right" style="min-width: 70px"><span class="text-left">$</span> {{ $servicio->costoUnitario }}</td>
                    <td class="text-right" style="min-width: 70px"><span class="text-left">$</span> {{ number_format($servicio->total, 2) }}</td>
                </tr>
            @endforeach

                <tr><td></td><td></td><td></td> <td></td></tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td class="text-right">SUBTOTAL</td>
                    <td class="text-right"><span class="text-left">$</span> {{ number_format($servicios->subtotal, 2)}} </td>
                </tr>
        </table>
    </main>

    <br>

    <footer>
        <p class="bold">NOTA: Los precios antes mencionados no incluyen IVA.</p>
        <p>Si tiene alguna duda con respecto a esta cotización, favor de comunicarse al 55 3026 3958 con atención a Jazmín.</p>
    </footer>

</body>
</html>