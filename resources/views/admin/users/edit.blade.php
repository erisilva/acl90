@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Lista de Operadores</a></li>
      <li class="breadcrumb-item active" aria-current="page">Alterar Registro</li>
    </ol>
  </nav>
</div>
<div class="container">
  @if(Session::has('edited_user'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Info!</strong>  {{ session('edited_user') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  @endif
  <form method="POST" action="{{ route('users.update', $user->id) }}">
    @csrf
    @method('PUT')
    <div class="row g-3">
      <div class="col-md-6">
        <label for="name" class="form-label">Nome</label>
        <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') ?? $user->name }}">
        @if ($errors->has('name'))
        <div class="invalid-feedback">
        {{ $errors->first('name') }}
        </div>
        @endif      
      </div>
      <div class="col-md-6">
        <label for="email" class="form-label">E-mail</label>
        <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') ?? $user->email }}">
        @if ($errors->has('email'))
        <div class="invalid-feedback">
        {{ $errors->first('email') }}
        </div>
        @endif      
      </div>
      <div class="col-md-6">
        <label for="password" class="form-label">Nova Senha</label>
        <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password">
        @if ($errors->has('password'))
        <div class="invalid-feedback">
        {{ $errors->first('password') }}
        </div>
        @endif
      </div>
      <div class="col-md-6">
        <div class="form-check">
          <input class="form-check-input" type="checkbox" name="active" {{ ($user->active == 'Y') ? 'checked' : '' }}>
          <label class="form-check-label" for="active">
            Operador Ativo
          </label>
        </div>        
      </div>

      <div class="col-12">
        <p class="text-center bg-primary text-white">Perfis</p>  
      </div>

      @foreach($roles as $role)
        @php
          $checked = '';
          if(old('roles') ?? false){
            foreach (old('roles') as $key => $id) {
              if($id == $role->id){
                $checked = "checked";
              }
            }
          }else{
            if($user ?? false){
              foreach ($user->roles as $key => $roleList) {
                if($roleList->id == $role->id){
                  $checked = "checked";
                }
              }
            }
          }
        @endphp
      <div class="col-md-4">
        <div class="form-check">
            <input type="checkbox" class="form-check-input" name="roles[]" value="{{$role->id}}" {{$checked}}>
            <label class="form-check-label" for="roles">{{$role->description}}</label>
        </div>
      </div>
      @endforeach
      <div class="col-12">
        <button type="submit" class="btn btn-primary"><i class="bi bi-pencil-square"></i> Alterar Dados do Operador</button>
      </div> 
    </div>    
  </form>
</div>
<div class="container py-4">
  <div class="float-end">
    <a href="{{ route('users.index') }}" class="btn btn-secondary" role="button"><i class="bi bi-arrow-left-square"></i> Voltar</a>
  </div>      
</div>
@endsection
