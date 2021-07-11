
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>files</title>
</head>
<body>
    
<nav class="navbar navbar-expand-lg navbar-light bg-info">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Dashboard</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a class="nav-link active" aria-current="page" href="#">Files</a>
        <span class="nav-link" >user : 
            @if (Session::has('users'))
                 {{ Session('users') }}
            @endif 
        </span>
        <a class="nav-link text-danger" href="{{asset('logout')}}">logout</a>
      </div>
    </div>
  </div>
</nav>


@if(Session::has('users'))
<table class="table table-striped col-md-6 offset-md-2" style="margin-top: 5%;"> 
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">fileName</th>
      <th scope="col">access</th>
    </tr>
  </thead>
  <tbody>


    @php
      $i=1;    
    @endphp

    @foreach ($listOfUserFile as $file)
      <tr>
        <th scope="row">@php echo($i); @endphp</th>
        <td>{{ $file[0] }}</td>
        <td>{{ $file[1] }}</td>
      </tr>

      @php
      $i++;    
    @endphp

    @endforeach



  </tbody>
</table>
@else
<div class="alert alert-danger col-md-6 offset-md-2" role="alert" style="margin-top: 5%;text-align:center">
    you must login first!
    <br/>
    <a href="{{asset('home')}}">login</a>
  </div>
@endif


</body>
</html>

