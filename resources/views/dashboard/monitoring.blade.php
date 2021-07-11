<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>iran</title>
</head>
<body style="display: flex; align-items:center; justify-content:center; flex-direction:column;">
      
        <div class="row">

            <div class="card border-dark mb-3 col " style="margin:25px;">
                <div class="card-header ">The most used users</div>
                <div class="card-body text-dark">

                    @foreach ($mostUser as $key => $value)
                        <span class="text-info" style="margin-right:15px">{{$value}}</span>
                        <span class="">{{$key}}</span>
                        <br/>
                    @endforeach
                  
                </div>
              </div>
              <div class="card border-dark mb-3 col" style="margin:25px;">
                <div class="card-header ">The most used passwords</div>
                <div class="card-body text-dark">
                  
                    @foreach ($mostPass as $key => $value)
                        <span class="text-info" style="margin-right:15px">{{$value}}</span>
                        <span class="">{{$key}}</span>
                        <br/>
                    @endforeach

                </div>
              </div>

              <div class="card border-dark mb-3 col" style="margin:25px;">
                <div class="card-header ">The most countries</div>
                <div class="card-body text-dark">
                   @foreach ($mostCountry as $key => $value)
                        <span class="text-info" style="margin-right:15px">{{$value}}</span>
                        <span class="">{{$key}}</span>
                        <br/>
                    @endforeach
                </div>
              </div>
              <div class="card border-dark mb-3 col" style="margin:25px;">
                <div class="card-header">The most user & pass</div>
                <div class="card-body text-dark">

                    @foreach ($mostUserPass as $key => $value)
                        <span class="text-info" style="margin-right:15px">{{$value}}</span>
                        <span class="">{{$key}}</span>
                        <br/>
                     @endforeach

                </div>
              </div>

        </div>
      


        <nav class="navbar navbar-light bg-light" class="width:100vh;">
            <a class="nav-link" href="{{ route('home') }}">{{ __('home') }}</a>
        </nav>

</body>
</html>