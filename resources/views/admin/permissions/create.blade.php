@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Lista de Operadores</a></li>
      <li class="breadcrumb-item"><a href="{{ route('permissions.index') }}">Permissões</a></li>
      <li class="breadcrumb-item active" aria-current="page">Novo Registro</li>
    </ol>
  </nav>
</div>
<div class="container">
  <form method="POST" action="{{ route('permissions.store') }}">
    @csrf
    <div class="row g-3">
      <div class="col-md-6">
          <label for="name" class="form-label">Nome</label>
          <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') ?? '' }}">
          @if ($errors->has('name'))
          <div class="invalid-feedback">
          {{ $errors->first('name') }}
          </div>
          @endif        
      </div>
      <div class="col-md-6">
          <label for="description" class="form-label">Descrição</label>
          <input type="text" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" value="{{ old('description') ?? '' }}">
          @if ($errors->has('description'))
          <div class="invalid-feedback">
          {{ $errors->first('description') }}
          </div>
          @endif        
      </div>
      <div class="col-12">
        <button type="submit" class="btn btn-primary"><i class="bi bi-plus-circle"></i> Incluir Permissão</button>  
      </div>
    </div>     
  </form>
</div>
<div class="container py-4">
  <div class="float-end">
    <a href="{{ route('permissions.index') }}" class="btn btn-secondary" role="button"><i class="bi bi-arrow-left-square"></i> Voltar</a>
  </div>      
</div>
@endsection
