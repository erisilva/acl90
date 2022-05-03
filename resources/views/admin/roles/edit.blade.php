@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Lista de Operadores</a></li>
      <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">Perfis</a></li>
      <li class="breadcrumb-item active" aria-current="page">Alterar Registro</li>
    </ol>
  </nav>
</div>
<div class="container">
  @if(Session::has('edited_role'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Info!</strong>  {{ session('edited_role') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  @endif
  <form method="POST" action="{{ route('roles.update', $role->id) }}">
    @csrf
    @method('PUT')
    <div class="row g-3">
      <div class="col-md-6">
        <label for="name" class="form-label">Nome</label>
        <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') ?? $role->name }}">
        @if ($errors->has('name'))
        <div class="invalid-feedback">
        {{ $errors->first('name') }}
        </div>
        @endif      
      </div>
      <div class="col-md-6">
        <label for="description" class="form-label">Descrição</label>
        <input type="text" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" value="{{ old('description') ?? $role->description }}">
        @if ($errors->has('description'))
        <div class="invalid-feedback">
        {{ $errors->first('description') }}
        </div>
        @endif      
      </div>
      <div class="col-12">
        <p class="text-center bg-primary text-white">Permissões</p>  
      </div>
      @foreach($permissions as $permission)
      @php
        $checked = '';
        if(old('permissions') ?? false){
          foreach (old('permissions') as $key => $id) {
            if($id == $permission->id){
              $checked = "checked";
            }
          }
        }else{
          if($role ?? false){
            foreach ($role->permissions as $key => $permissionList) {
              if($permissionList->id == $permission->id){
                $checked = "checked";
              }
            }
          }
        }
      @endphp
      <div class="col-md-4">
        <div class="form-check">
            <input type="checkbox" class="form-check-input" name="permissions[]" value="{{$permission->id}}" {{$checked}}>
            <label class="form-check-label" for="permissions">{{$permission->description}}</label>
        </div>
      </div>
      @endforeach
      <div class="col-12">
        <button type="submit" class="btn btn-primary"><i class="bi bi-pencil-square"></i> Alterar Dados do Perfil</button>
      </div>  
    </div>    
  </form>
</div>
<div class="container py-4">
  <div class="float-end">
    <a href="{{ route('roles.index') }}" class="btn btn-secondary" role="button"><i class="bi bi-arrow-left-square"></i> Voltar</a>
  </div>      
</div>
@endsection
