@extends('layout.backend.main')
@section('page_content')
    


<div class="error-box">
    <div class="error-img">
        <img src="{{asset('assets')}}/img/authentication/error-404.png" class="img-fluid" alt="">
    </div>
    <h3 class="h2 mb-3">Oops, something went wrong</h3>
    <p>Error 404 Page not found. Sorry the page you looking for
        doesn’t exist or has been moved</p>
    <a href="{{route('login')}}" class="btn btn-primary">Back to Dashboard</a>
</div>

@endsection