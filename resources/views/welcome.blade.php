@extends("layouts.app")

@section("content")
@if (Auth::check())
    <?php $user= Auth::user(); ?>
    {{ $user->name }}
@else
    <div class="center jumbotron">
        <div class="text-center">
            <h1>Welcome to TaskList</h1>
            {!! link_to_route("signup.get", "Sign up now!", null, ["class"=>"btn btn-primary btn-lg"] ) !!}
        </div>
    </div>
@endif
@endsection