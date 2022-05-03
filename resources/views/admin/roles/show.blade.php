@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Lista de Operadores</a></li>
      <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">Perfis</a></li>
      <li class="breadcrumb-item active" aria-current="page">Exibir Registro</li>
    </ol>
  </nav>
</div>
<div class="container">
  <div class="card">
    <div class="card-header">
      Perfis
    </div>
    <div class="card-body">
      <ul class="list-group list-group-flush">
        <li class="list-group-item">Nome: {{$role->name}}</li>
        <li class="list-group-item">Descrição: {{$role->description}}</li>
      </ul>
    </div>
    <div class="card-footer text-right">
      <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalLixeira"><i class="bi bi-trash"></i> Enviar para Lixeira</button>    
    </div>
  </div>  
</div>
<div class="container py-4">
  <div class="float-end">
    <a href="{{ route('roles.index') }}" class="btn btn-secondary" role="button"><i class="bi bi-arrow-left-square"></i> Voltar</a>
  </div>      
</div>

<div class="modal fade" id="modalLixeira" role="dialog" aria-labelledby="JanelaLixeira" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTitleLixeira"><i class="bi bi-patch-question"></i> Apagar Registro</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="alert alert-danger" role="alert">
          <p><strong>Atenção!</strong> Ao excluir esse registro todo e qualquer vínculo que ele tiver com outros dados será excluído.</p>
          <h2>Confirma?</h2>
        </div>
        <form method="post" action="{{route('roles.destroy', $role->id)}}">
          @csrf
          @method('DELETE')
          <div class="mb-3">
            <label for="motivo" class="form-label">Motivo</label>  
            <input type="text" class="form-control" name="motivo" id="motivo" value="">
          </div>
          <button type="submit" class="btn btn-danger"><i class="bi bi-trash"></i> Apagar Registro</button>
        </form>
      </div>     
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal"><i class="bi bi-x-square"></i> Fechar</button>
      </div>
    </div>
  </div>
</div>

@endsection
