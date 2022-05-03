@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('users.index') }}">Lista de Operadores</a></li>
    </ol>
  </nav>
  @if(Session::has('deleted_user'))
  <div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Info!</strong>  {{ session('deleted_user') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  @endif
  @if(Session::has('create_user'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Info!</strong>  {{ session('create_user') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  @endif
  <div class="btn-group py-1" role="group" aria-label="Opções">
    <a href="{{ route('users.create') }}" class="btn btn-secondary btn-sm" role="button"><i class="bi bi-person-plus-fill"></i> Novo Registro</a>
    <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#modalFilter"><i class="bi bi-funnel"></i> Filtrar</button>
    <div class="btn-group" role="group">
      <button id="btnGroupOpcoes" type="button" class="btn btn-secondary dropdown-toggle btn-sm" data-bs-toggle="dropdown" aria-expanded="false">
       <i class="bi bi-gear"></i> Opções
      </button>
      <ul class="dropdown-menu" aria-labelledby="btnGroupOpcoes">
        <li><a class="dropdown-item" href="{{ route('roles.index') }}"><i class="bi bi-layout-sidebar"></i> Perfis</a></li>
        <li><a class="dropdown-item" href="{{ route('permissions.index') }}"><i class="bi bi-layout-sidebar"></i> Permissões</a></li>
        <li><hr class="dropdown-divider"></li>
        <li><a class="dropdown-item" href="#" id="btnExportarCSV"><i class="bi bi-file-earmark-spreadsheet-fill"></i> Exportar Planilha</a></li>
        <li><a class="dropdown-item" href="#" id="btnExportarPDF"><i class="bi bi-file-pdf-fill"></i> Exportar PDF</a></li>
      </ul>
    </div>
  </div>
<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nome</th>
                <th>E-mail</th>
                <th>Situação</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td class="text-nowrap">{{$user->name}}</td>
                <td class="text-nowrap">{{$user->email}}</td>
                <td>
                @if($user->active == 'N')
                <span class="badge bg-warning text-dark"><i class="bi bi-file-lock-fill"></i> Bloqueado</span>
                @endif
                </td>
                <td>
                  <div class="btn-group" role="group">
                    <a href="{{route('users.edit', $user->id)}}" class="btn btn-primary btn-sm" role="button"><i class="bi bi-pencil-square"></i></a>
                    <a href="{{route('users.show', $user->id)}}" class="btn btn-info btn-sm" role="button"><i class="bi bi-eye"></i></a>
                  </div>
                </td>
            </tr>    
            @endforeach                                                 
        </tbody>
    </table>
  </div>
  <p class="text-center">Página {{ $users->currentPage() }} de {{ $users->lastPage() }}. Total de registros: {{ $users->total() }}.</p>
  <div class="container-fluid">
      {{ $users->links() }}
  </div>
</div>

<!-- Janela de filtragem da consulta -->
<div class="modal fade" id="modalFilter" tabindex="-1" role="dialog" aria-labelledby="JanelaFiltro" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTitleFilter"><i class="bi bi-funnel"></i> Filtro</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Filtragem dos dados -->
        <form method="GET" action="{{ route('users.index') }}">
          <div class="mb-3">
            <label for="name" class="form-label">Nome</label>
            <input type="text" class="form-control" id="name" name="name" value="{{request()->input('name')}}">
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">E-mail</label>
            <input type="text" class="form-control" id="email" name="email" value="{{request()->input('email')}}">
          </div>
          <button type="submit" class="btn btn-primary btn-sm"><i class="bi bi-search"></i> Pesquisar</button>
          <a href="{{ route('users.index') }}" class="btn btn-secondary btn-sm" role="button"><i class="bi bi-x-octagon"></i> Limpar</a>
        </form>
        <!-- Seleção de número de resultados por página -->
        <div class="mb-3 py-3">
          <select class="form-select" name="perpage" id="perpage">
            @foreach($perpages as $perpage)
            <option value="{{$perpage->valor}}"  {{($perpage->valor == session('perPage')) ? 'selected' : ''}}>{{$perpage->nome}}</option>
            @endforeach
          </select>
        </div>
      </div>     
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal"><i class="bi bi-x-square"></i> Fechar</button>
      </div>
    </div>
  </div>
</div>
@endsection
@section('script-footer')
<script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
<script>
$(document).ready(function(){
    $('#perpage').on('change', function() {
        perpage = $(this).find(":selected").val(); 
        
        window.open("{{ route('users.index') }}" + "?perpage=" + perpage,"_self");
    });

    $('#btnExportarCSV').on('click', function(){
        var filtro_name = $('input[name="name"]').val();
        var filtro_email = $('input[name="email"]').val();
        window.open("{{ route('users.export.csv') }}" + "?name=" + filtro_name + "&email=" + filtro_email,"_self");
    });

    $('#btnExportarPDF').on('click', function(){
        var filtro_name = $('input[name="name"]').val();
        var filtro_email = $('input[name="email"]').val();
        window.open("{{ route('users.export.pdf') }}" + "?name=" + filtro_name + "&email=" + filtro_email,"_self");
    });
}); 
</script>
@endsection