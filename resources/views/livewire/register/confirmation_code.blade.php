<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>confirmation_code</title>

    <style>

        /* Utility */
        .a-i-center{
            align-items: center
        }
        
        .c-blue{
        color: rgb(22, 54, 131);
        }
        .d-flex{
            display: flex
        }
        .f-colum{
            flex-direction: column;
        }
        .j-c-center{
            justify-content: center
        }
        .t-none{
            text-decoration: none;
        }

    </style>
</head>
<body>

    <div class="d-flex f-colum j-c-center a-i-center">

        <div>
            <img style="margin-right: 8px" src="https://besanaglobalcolombia.com/img/logologin.jpeg" alt="logo Besana" height="100">
        </div>

        <h2 class="c-blue">Hola {{$Name}}, Bienvenido a la familia Besana Global, estamos felices que te hayas registrado con nosotros. Por favor confirma tu correo electrónico. </h2>
    
        <a class="t-none" href="{{ url('/register/verify/' . $confirmation_code) }}">
            Presiona Aqui!
        </a>
    </div>
    
</body>
</html>