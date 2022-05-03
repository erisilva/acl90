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
        $user['theme_id'] = 1; // inseri o tema de apresentação default
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
        // verifica o acesso
        if (Gate::denies('user-show')) {
            abort(403, 'Acesso negado.');
        }

        $user = User::findOrFail($id);

        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Gate::denies('user-edit')) {
            abort(403, 'Acesso negado.');
        }

        // usuário que será alterado
        $user = User::findOrFail($id);

        // listagem de perfis (roles)
        $roles = Role::orderBy('description','asc')->get();

        return view('admin.users.edit', compact('user', 'roles'));
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
         $this->validate($request, [
          'name' => 'required',
          'email' => 'required|email',
        ]);

        $user = User::findOrFail($id);

        // atualiza a senha do usuário se esse campo tiver sido preenchido
        if ($request->has('password') && (request('password') != "")) {
            $input = $request->all();
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = $request->except('password');
        }   

        // configura se operador está habilitado ou não a usar o sistema
        if (isset($input['active'])) {
            $input['active'] = 'Y';
        } else {
            $input['active'] = 'N';
        }

        // remove todos os perfis vinculados a esse operador
        $roles = $user->roles;
        if(count($roles)){
            foreach ($roles as $key => $value) {
               $user->roles()->detach($value->id);
            }
        }

        // vincula os novos perfis desse operador
        if(isset($input['roles']) && count($input['roles'])){
            foreach ($input['roles'] as $key => $value) {
               $user->roles()->attach($value);
            }
        }

        $user->update($input);
        
        Session::flash('edited_user', 'Operador alterado com sucesso!');

        return redirect(route('users.edit', $id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Gate::denies('user-delete')) {
            abort(403, 'Acesso negado.');
        }

        User::findOrFail($id)->delete();

        Session::flash('deleted_user', 'Operador excluído com sucesso!');

        return redirect(route('users.index'));
    }

    public function exportcsv()
    {
        if (Gate::denies('user-export')) {
            abort(403, 'Acesso negado.');
        }

    }

    public function exportxls()
    {
        if (Gate::denies('user-export')) {
            abort(403, 'Acesso negado.');
        }

    }

    public function exportpdf()
    {
        if (Gate::denies('user-export')) {
            abort(403, 'Acesso negado.');
        }

    }     
}
