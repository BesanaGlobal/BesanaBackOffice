<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>confirmation_code</title>
    <style>
        table {
            background-color: green;
            color: white;
            border: 1px solid rgb(135, 135, 135);
        }
    </style>
</head>
<body>

    <div class="d-flex f-colum j-c-center a-i-center">

        <div>
            <img style="margin-right: 8px" src="https://besanaglobalcolombia.com/img/logologin.jpeg" alt="logo Besana" height="100">
        </div>

        <h2 class="c-blue">Hola {{$Name}}</h2>
        <div class="container" style="margin-bottom: 30px">
            <div class="row">
              <div class="col-md-12">
                <table class="table-success" style="width: 50%">
                  <thead>
                    <tr>
                      <th style="padding: 5%">Usuario:</th>
                      <th style="padding: 5%">{{$Name}}</th>
                     
                    </tr>
                    <tr>
                        <th style="padding: 5%">Password:</th>
                        <th style="padding: 5%">{{$password}}</th>
                    </tr>
                  </thead>
                  <tbody>
                    
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          
            
        
        
     
    
        <a style="margin-top:20px; padding: 5px; background-color:green; color:white; border-radius:20px" href="{{ url('/login') }}">
            Ingrese Aqui!
        </a>
    </div>
    
</body>
</html>