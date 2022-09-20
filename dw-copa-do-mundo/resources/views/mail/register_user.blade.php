@extends('layouts.app')

@section('content')
    <div class="bg-light p-5 rounded">
        <h1>{{$user->name}}</h1>
        <h2>Bem-vindo!</h2>
      <span>  Segue seus dados: <br></span>
      Usuário : {{$user->email}} <br>
      Senha : {{$user->unmask_password}} <br>
    </div>
@endsection
