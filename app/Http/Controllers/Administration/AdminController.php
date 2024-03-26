<?php

namespace App\Http\Controllers\Administration;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        $usersCount = User::count();
        // Fetch more data or perform necessary operations

        return view('admin.dashboard', compact('usersCount'));
    }

    public function users()
    {
        $users = User::paginate(10);


        return view('admin.users.index', compact('users'));
    }

    public function makeAdmin($id)
    {
        $user = User::find($id);

        // Verifique se o usuário existe
        if (!$user) {
            // Redirecione ou retorne uma resposta de erro, se necessário
        }

        // Verifique se o usuário atual tem a role "superadmin"
        if (Auth::user()->role !== 'superadmin' && Auth::user()->role !== 'admin') {
            return redirect()->back()->with('error', 'privilégios insuficientes');
        }

        // Atribua a role "admin" ao usuário
        $user->role = 'admin';
        $user->save();

        return redirect()->back()->with('success', 'tornou-se ADMINISTRADOR!!');
    }


    public function revokeAdmin($id)
    {
        $user = User::find($id);

        // Verifique se o usuário existe
        if (!$user) {
            return redirect()->back()->with('error', 'dados inexistentes');
        }

        // Verifique se o usuário atual tem a role "superadmin"
        if (Auth::user()->role !== 'superadmin' && Auth::user()->role !== 'admin') {
            return redirect()->back()->with('error', 'privilégios insuficientes');
        }

        // Verifique se o usuário a ser despromovido não é o último superadmin
        $superadminsCount = User::where('role', 'superadmin')->count();
        if ($user->role === 'superadmin' && $superadminsCount <= 1) {
            return redirect()->back()->with('error', 'falha');
        }

        // Remova a role "admin" do usuário
        $user->role = 'user';
        $user->save();

        return redirect()->back()->with('success', 'ADMINISTRADOR desfeito');
    }



    public function edit($id)
    {
        $user = User::find($id);

        // Verifique se o usuário existe
        if (!$user) {
            // Redirecione ou retorne uma resposta de erro, se necessário
        }

        // Verifique se o usuário atual é "admin@admin.com"
        if (Auth::user()->email !== 'admin@admin.com') {
            // Redirecione ou retorne uma resposta de erro, se necessário
        }

        // Lógica para exibir o formulário de edição ou processar os dados enviados pelo formulário
    }

    public function delete($id)
    {
        $user = User::find($id);

        // Verifique se o usuário existe
        if (!$user) {
            // Redirecione ou retorne uma resposta de erro, se necessário
        }

        // Verifique se o usuário atual é "admin@admin.com"
        if (Auth::user()->email !== 'admin@admin.com') {
            // Redirecione ou retorne uma resposta de erro, se necessário
        }

        // Verifique se o usuário a ser excluído é "admin@gmail.com"
        if ($user->email === 'admin@gmail.com') {
            // Redirecione ou retorne uma resposta de erro, se necessário
        }

        // Lógica para excluir o usuário
    }




    public function destroy(string $id)
    {
        $user = user::find($id);

      

        $user->delete();
        return redirect('admin/users')->with('success', 'Usuário removido com sucesso!');
    }

}
