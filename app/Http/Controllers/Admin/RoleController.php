<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role; // Perfil
use App\Models\Permission; // Permissões
use App\Models\Perpage;

use Response;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
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
        if (Gate::denies('role-index')) {
            abort(403, 'Acesso negado.');
        }

        $roles = new Role;

        // filtros
        if (request()->has('name')){
            $roles = $roles->where('name', 'like', '%' . request('name') . '%');
        }

        if (request()->has('description')){
            $roles = $roles->where('description', 'like', '%' . request('description') . '%');
        }            
        // ordena
        $roles = $roles->orderBy('name', 'asc');

        // se a requisição tiver um novo valor para a quantidade
        // de páginas por visualização ele altera aqui
        if(request()->has('perpage')) {
            session(['perPage' => request('perpage')]);
        }

        // consulta a tabela perpage para ter a lista de
        // quantidades de paginação
        $perpages = Perpage::orderBy('valor')->get();

        // paginação
        $roles = $roles->paginate(session('perPage', '5'))->appends([          
            'name' => request('name'),
            'description' => request('description'),           
            ]);

        return view('admin.roles.index', compact('roles', 'perpages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Gate::denies('role-create')) {
            abort(403, 'Acesso negado.');
        }

        // listagem de perfis (roles)
        $permissions = Permission::orderBy('name','asc')->get();

        return view('admin.roles.create', compact('permissions'));
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

        $role = $request->all();

        $newRole = Role::create($role); //salva

        // salva os perfis (roles)
        if(isset($role['permissions']) && count($role['permissions'])){
            foreach ($role['permissions'] as $key => $value) {
                $newRole->permissions()->attach($value);
            }

        } 

        Session::flash('create_role', 'Perfil cadastrado com sucesso!');

        return redirect(route('roles.index'));
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
