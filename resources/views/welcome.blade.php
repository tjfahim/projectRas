<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Hello</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            
          
          </ul>
          <div class=" my-2 my-lg-0">
            @auth
    <!-- User is authenticated, display user's name and dashboard link -->
    <span class="text-dark mr-2">Welcome, {{ auth()->user()->name }}</span>
    <a href="{{ route('dashboard') }}" class="btn btn-outline-success my-2 my-sm-0">Dashboard</a>
    <form action="{{ route('logout') }}" method="post" class="ml-2">
        @csrf
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Logout</button>
    </form>
@else
    <!-- User is a guest, display login and register buttons -->
    <a href="{{ route('login') }}" class="btn btn-outline-success my-2 my-sm-0">Login</a>
    <a href="{{ route('register') }}" class="btn btn-outline-success my-2 my-sm-0">Register</a>
@endauth

        
          </div>
        </div>
      </nav>

      <div class="d-flex justify-content-center align-items-center">
        <div class="card" style="width: 18rem;">
            @foreach($posts as $post)
            <img class="card-img-top" src="{{ asset('image/' . $post->image) }}" alt="{{ $post->title }}">
            <div class="card-body">
                <h5 class="card-title">{{ $post->title }}</h5>
                @if($post->user)
                Posted by: {{ $post->user->name }}
            @else
                User not available
            @endif
            </div>
            @endforeach
        </div>
        {{ $posts->links('pagination::bootstrap-4') }}

    </div>
    
</body>
</html>