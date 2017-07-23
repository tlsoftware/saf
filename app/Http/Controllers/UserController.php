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
            ->paginate(10);

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
        $this->validate($request, [
            'name'      => 'required',
            'email'     => 'required',
            'username'  => 'unique:users',
            'password'  => 'required',
            'role'      => 'required'
        ]);

        $user = new User($request->all());
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
        return view('admin.users.edit')
            ->with('user', $user)
            ->with('roles', $this->roles);
    }

    public function update(Request $request, $id)
    {

        $this->validate($request, [
            'name'      => 'required',
            'email'     => 'required',
            'username'  => 'unique:users',
            'password'  => 'required',
            'role'      => 'required'
        ]);

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
            Flash::success('El usuario ' . $user->name . ' ha sido borrado de forma Exitosa!!');
            return redirect()->route('users.index');
        }
        Flash::error('El usuario ' . $user->name . ' no se pudo eliminar "Tiene Clientes Asociados"!!');
        return redirect()->route('users.index');
    }

}
