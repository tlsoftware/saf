<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Customer;
use Laracasts\Flash\Flash;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{

    protected $roles = [
        '' => '-- Seleccione --',
        'admin' => 'Administrador',
        'supervisor' => 'Supervisor',
        'user' => 'Vendedor'
    ];

    public function index(Request $request)
    {
        $users = User::Search($request->name)
            ->orderBy('id', 'ASC')
            ->paginate(5);

        return view('admin.users.index')
            ->with('users', $users);
    }


    public function create()
    {
        return view('admin.users.create')
            ->with('roles', $this->roles);
    }


    public function store(Request $request)
    {
        $user = new User($request->all());
        // $user->password = bcrypt($request->password);
        $user->save();

        Flash::success("Se ha registrado " . $user->name . " de forma exitosa!");

        return redirect()->route('users.index');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.users.edit')->with('user', $user);
    }


    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->fill($request->all());
        $user->save();

        Flash::warning('EL Usuario ' . $user->name . ' ha sido editado con Exito!!');

        return redirect()->route('users.index');
    }


    public function destroy($id)
    {
        $user = User::find($id);

        if (!count($user->customers)) {
            $user->delete();
            Flash::error('El usuario ' . $user->name . ' ha sido borrado de forma Exitosa!!');
            return redirect()->route('users.index');
        }
        Flash::error('El usuario ' . $user->name . ' no se pudo eliminar "Tiene Clientes Asociados"!!');
        return redirect()->route('users.index');
    }

    public function migrate($id)
    {
        $user = User::find($id);
        $users2 = User::pluck('name', 'id')->toArray();

        return view('admin.users.migrate')
            ->with(compact('users2', $users2))
            ->with('user', $user);
    }

    public function storeMigrate(Request $request, $id)
    {
        Customer::where('user_id', $id)
            ->update(['user_id' => $request->user2_id]);

        Flash::warning('Se migraron los Clientes con Exito!!');

        return redirect()->route('users.index');
    }

}
