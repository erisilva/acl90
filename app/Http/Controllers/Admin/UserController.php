<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Perpage;
use App\Models\Role;

use Response;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
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
        if (Gate::denies('user-index')) {
            abort(403, 'Acesso negado.');
        }

        $users = new User;

        // filtros
        if (request()->has('name')){
            $users = $users->where('name', 'like', '%' . request('name') . '%');
        }

        if (request()->has('email')){
            $users = $users->where('email', 'like', '%' . request('email') . '%');
        }

        // ordena
        $users = $users->orderBy('name', 'asc');        

        // se a requisição tiver um novo valor para a quantidade
        // de páginas por visualização ele altera aqui
        if(request()->has('perpage')) {
            session(['perPage' => request('perpage')]);
        }

        // consulta a tabela perpage para ter a lista de
        // quantidades de paginação
        $perpages = Perpage::orderBy('valor')->get();

        // paginação
        $users = $users->paginate(session('perPage', '5'))->appends([          
            'name' => request('name'),
            'email' => request('email'),           
            ]);

        return view('admin.users.index', compact('users', 'perpages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Gate::denies('user-create')) {
            abort(403, 'Acesso negado.');
        }

        // listagem de perfis (roles)
        $roles = Role::orderBy('description','asc')->get();

        return view('admin.users.create', compact('roles'));
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
          'email' => 'required|email|unique:users,email',
          'password' => 'required|min:6|confirmed'
        ]);

        $user = $request->all();
        $user['active'] = 'Y'; // torna o novo registro ativo
        $user['password'] = Hash::make($user['password']); // criptografa a senha

        $newUser = User::create($user); //salva

        // salva os perfis (roles)
        if(isset($user['roles']) && count($user['roles'])){
            foreach ($user['roles'] as $key => $value) {
                $newUser->roles()->attach($value);
            }

        }    

        Session::flash('create_user', 'Operador cadastrado com sucesso!');

        return redirect(route('users.index'));
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
