@extends("layouts.app")

@section("content")
@if (Auth::check())

<div class="col-md-6 col-md-offset-3">
    <?php $user= Auth::user(); ?>
    
    <div class="text-center">
        <h1>{{ $user->name }}</h1>
        
        {!! link_to_route("users.show", "My tasks", ["id"=>$user->id], ["class"=>"btn btn-primary btn-lg"]) !!}
    </div>
        
</div>
    
@else
    <div class="center jumbotron">
        <div class="text-center">
            <h1>Welcome to TaskList</h1>
            {!! link_to_route("signup.get", "Sign up now!", null, ["class"=>"btn btn-primary btn-lg"] ) !!}
        </div>
    </div>
@endif
@endsection