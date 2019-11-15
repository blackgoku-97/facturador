<?php
namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
class UserController extends Controller
{
    public function index()
    {
        //$users = DB::table('users')->get();
        $users = User::all();
        $title = 'Listado de usuarios';
//        return view('users.index')
//            ->with('users', User::all())
//            ->with('title', 'Listado de usuarios');
        return view('users.index', compact('title', 'users'));
    }
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }
    public function create()
    {
        return view('users.create');
    }
    public function store()
    {
        $data = request()->validate([
            'name' => 'required',
            'rut' => ['required', 'rut', 'unique:users,rut'],
            'password' => 'required',
        ], [
            'name.required' => 'El campo nombre es obligatorio'
        ]);
        User::create([
            'name' => $data['name'],
            'rut' => $data['rut'],
            'password' => bcrypt($data['password'])
        ]);
        return redirect()->route('users.index');
    }
    public function edit(User $user)
    {
        return view('users.edit', ['user' => $user]);
    }
    public function update(User $user)
    {
        $data = request()->validate([
            'name' => 'required',
            'rut' => 'required',
            'password' => '',
        ]);
        if ($data['password'] != null) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }
        $user->update($data);
        return redirect()->route('users.show', ['user' => $user]);
    }
    function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index');
    }
}