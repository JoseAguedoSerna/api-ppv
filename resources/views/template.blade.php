<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Formato de alta FRDP-001</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<style>
    h1 {
        font-size:100%;
    }
    th, td {
    padding: 0px;
    }
    td {
            vertical-align: top;
        }
    table {
        padding: 0px;
        margin:0px;
    }
    .tablaTres {
        border-spacing: 15px;
    }

    .tablaUno{
    border-spacing: 8px;
    vertical-align: top;
    }
    .tablaUno td {
        padding: 5px;
        vertical-align: top;
    }

    .tablaDos {
        border-spacing: 2px;
    }

    .tablaDos td {
        padding: 1px;
        vertical-align: top;
    }


    .tablaTres td {
        vertical-align: top;
    }

    .tablaCuatro {
        border-spacing: 2px;
    }

    .tablaCuatro td {
        padding: 1px;
        vertical-align: top;
    }

    .espacio {
    width:60px;
    }
    .espacioUno {
    width:125px;
    }
    .espacioTablaDos {
    width:150px;
    }

    .titulos {
        font-size:100%;
        font-family: Arial, Helvetica, Verdana;
        font-weight:bold;
    }
    .subtitulos {
        font-size:80%;
        font-family: Arial, Helvetica, Verdana;
        font-weight:bold;
    }
    .parrafos {
        font-size:60%;
        font-family: Arial, Helvetica, Verdana;
    }
    .nota {
        font-size:60%;
        font-family: Arial, Helvetica, Verdana;
        font-weight:bold;
    }
    .tips {
        font-size:50%;
        font-family: Arial, Helvetica, Verdana;
        margin-top:0;
        padding-top:0;
        padding-left:60px;
    }

.bordes {
    border:1px solid #000;
    padding:1px 10px;
}

.borde-suave {
  border-collapse: collapse;
  border: 1px solid #000;
}

.borde-suave th, .borde-suave td {
  border: 1px solid #000;
  padding: 8px;
}
</style>
</head>
<body>
    

    <table class="tablaUno">
        <tr>
            <td>
            <img src="{{ asset('logo.jpg') }}"  class="img-fluid" alt="..." width="100px" height="160px">
            </td>
            <td>
            <span class="titulos">Secretaría de Finanzas y Tesorería General del Estado</span><br/>
            <span class="titulos">Dirección de Patrimonio</span>
            </td>
            <td><div class="espacioUno"></div></td>
            <td><div class="bordes"><span class="subtitulos">Folio:</span> <span class="parrafos">45345</span></div></td>
            <td><div class="bordes"><span class="subtitulos">Fecha:</span> <span class="parrafos">01/08/2023</span></div> </td>
            <td><div class="bordes"><span class="subtitulos">Hoja:</span> <span class="parrafos">1</span> </div></td>
        </tr>
    </table>



    <table class="tablaDos" width="100%">
        <tr>
        <td><div class="espacioTablaDos"></div></td>
            <td> <div class="text-center"><p class="titulos">ALTA <br/> DE MOBILIARIO Y EQUIPO</p></div> </td>
            <td><div class="espacioTablaDos"></div></td>
            <td>
                <div class="bordes">
                <table class="tablaTres">
                    <tr>
                        <td><span class="subtitulos">SECRETARÍA: </span></td>
                        <td><span class="parrafos"> Secretaría de Gobierno</span></td>
                    </tr>
                    <tr>
                        <td><span class="subtitulos">SUBSECRETARÍA: </span></td>
                        <td><span class="parrafos"> Subsecretaría de Gobierno</span></td>
                    </tr>
                    <tr>
                        <td><span class="subtitulos">DIRECCIÓN: </span></td>
                        <td><span class="parrafos"> Oficina del C. Secretario General de Gobierno.</span></td>
                    </tr>
                    <tr>
                        <td><span class="subtitulos">DEPARTAMENTO: </span></td>
                        <td><span class="parrafos"> Protección Civil</span></td>
                    </tr>
                </table>
                </div>
            </td>
        </tr>
        </table>


        <br/>
        <div class="bordes">
        <table class="tablaCuatro" width="100%">
        <tr>
            <td><p class="subtitulos">FACTURA:</p></td>
            <td>FF 1461</td>
            <td><p class="subtitulos">PROVEEDOR</p></td>
            <td>Mirage</td>
            <td><p class="subtitulos">FECHA</p></td>
            <td>02/08/2023</td>
        </tr>
        </table>
        </div>
        <br/>

        <table class="tablaCinco borde-suave"  width="100%" >
        <tr>
            <td><p class="subtitulos">NUM. INV C.B</p></td>
            <td><p class="subtitulos">MARCA</p></td>
            <td><p class="subtitulos">MODELO</p></td>
            <td><p class="subtitulos">SERIE</p></td>
            <td><p class="subtitulos">VALOR FACTURA</p></td>
            <td><p class="subtitulos">DESCRIPCION</p></td>
            <td><p class="subtitulos">CONDICIONES</p></td>
        </tr>

        <tr>
            <td>inf dinamica</td>
            <td>inf dinamica</td>
            <td>inf dinamica</td>
            <td>inf dinamica</td>
            <td>inf dinamica</td>
            <td>inf dinamica</td>
            <td>inf dinamica</td>
        </tr>
        </table>
    <br/><br/>
    <table>
        <tr>
            <td>
                <span class="nota">NOTA:</span> <span class="parrafos">ME COMPROMETO A MANTENER EN BUEN USO EL MOBILIARIO Y EQUIPO DESCRITO, INFORMANDO A LA DIRECCIÓN DE PATRIMONIO EN CASO DE TRANSFERENCIA
                O MOVIMIENTO QUE PUEDAN AFECTAR LOS BIENES MENCIONADOS</span>
            </td>
        </tr>
    </table>
    <br/>

    <table width="100%">
        <tr>
            <td><div class="text-center"><p class="subtitulos">RESPONSABLE</p></div></td>
            <td><div class="text-center"><p class="subtitulos">TITULAR DEL ÁREA</p></div></td>
            <td><div class="text-center"><p class="subtitulos">ENLACE DE MOBILIARIO</p></div></td>
        </tr>
        <tr>
            <td>
                <span class="subtitulos">Nombre:_______________________</span><br/>
                <div class="espacio"></div><span class="tips">Nombres(s) / Apellido Paterno / Apellido Materno </span>
            </td>
            <td>
                <span class="subtitulos">Nombre:_______________________</span><br/>
                <div class="espacio"></div><span class="tips">Nombres(s) / Apellido Paterno / Apellido Materno </span>
            </td>
            <td>
                <span class="subtitulos">Nombre:_______________________</span><br/>
                </span><span class="tips">Nombres(s) / Apellido Paterno / Apellido Materno </span>
            </td>
        </tr>
        <tr>
            <td><p class="subtitulos">RFC:_______________________</p></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td><p class="subtitulos">Firma:_______________________</p></td>
            <td><p class="subtitulos">Firma:_______________________</p></td>
            <td><p class="subtitulos">Firma:_______________________</p></td>
        </tr>
    </table>



</body>
</html>
