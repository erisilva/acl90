<?php

namespace App\Http\Controllers\Admin;

use App\Models\Permission;
use App\Models\Perpage;

use Response;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware(['middleware' => 'auth']);
        $this->middleware(['middleware' => 'hasaccess']);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Gate::denies('permission-index')) {
            abort(403, 'Acesso negado.');
        }

        $permissions = new Permission;

        // filtros
        if (request()->has('name')){
            $permissions = $permissions->where('name', 'like', '%' . request('name') . '%');
        }

        if (request()->has('description')){
            $permissions = $permissions->where('description', 'like', '%' . request('description') . '%');
        }

        // ordena
        $permissions = $permissions->orderBy('name', 'asc');

        // se a requisição tiver um novo valor para a quantidade
        // de páginas por visualização ele altera aqui
        if(request()->has('perpage')) {
            session(['perPage' => request('perpage')]);
        }

        // consulta a tabela perpage para ter a lista de
        // quantidades de paginação
        $perpages = Perpage::orderBy('valor')->get();

        // paginação
        $permissions = $permissions->paginate(session('perPage', '5'))->appends([          
            'name' => request('name'),
            'description' => request('description'),           
            ]);

        return view('admin.permissions.index', compact('permissions', 'perpages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Gate::denies('permission-create')) {
            abort(403, 'Acesso negado.');
        }

        return view('admin.permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
          'name' => 'required',
          'description' => 'required',
        ]);

        $permission = $request->all();

        Permission::create($permission); //salva

        Session::flash('create_permission', 'Permissão cadastrada com sucesso!');

        return redirect(route('permissions.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}