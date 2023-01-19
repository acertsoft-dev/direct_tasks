<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Tasks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    public function defineRouteMainOrLogin()
    {
        if (Auth::check() === true){
            $tasksForUser = [];
            $numTasks = '';
            $tasks = Tasks::where([
                ['id_user', 'like', '%'. Auth::user()->id .'%']
            ])->paginate();

            foreach($tasks as $tasksUser){
                if($tasksUser->id_user == Auth::user()->id && ($tasksUser->status == 'Em aberto' || $tasksUser->status == 'Em andamento' )){
                    array_push($tasksForUser, $tasksUser);
                }
            };
            $numTasks = strval(sizeof($tasksForUser));
            
            //dd($tasksForUser);

            return view('users.homeUser', ['numTasks' => $numTasks]);
        }
        else
            return redirect('/login');
    }

    public function home()
    {   
        $tasksForUser = [];
        $numTasks = '';
        $tasks = Tasks::where([
            ['id_user', 'like', '%'. Auth::user()->id .'%']
        ])->paginate();

        foreach($tasks as $tasksUser){
            if($tasksUser->id_user == Auth::user()->id && ($tasksUser->status == 'Em aberto' || $tasksUser->status == 'Em andamento' )){
                array_push($tasksForUser, $tasksUser);
            }
        };
        $numTasks = strval(sizeof($tasksForUser));
        
        //dd($tasksForUser);

        return view('users.homeUser', ['numTasks' => $numTasks]);
    }

    public function showLogin()
    {
        return view('users.login');
    }

    public function doLogin(Request $request)
    {

        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect('/');
        }

        return redirect()->back()->withInput()->withErrors('Os dados informados não conferem!');
    }

    public function doLogout() {
        Auth::logout();
        return redirect('/');
    }

    public function showCreateUser()
    {
        return view('users.createUser');
    }

    public function createUser(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        try {
            $user = User::create([
                'name' => request('name'),
                'email' => request('email'),
                'password' => Hash::make(request('password')),
            ]);

            $user->save();

            return redirect('users');

        } catch (\Throwable $th) {
            return redirect()->back()->withErrors($th->getMessage());
        }
    }
    public function showUsersList()
    {
        $search = request('search');

        if($search){
            $users = User::where([
                ['name', 'like', '%'.$search.'%']
            ])->paginate(9);

        } else {
            $users = User::paginate(9);
        }

        return view('users.usersList', ['users' => $users]);
    }

    public function destroy($id){
        
        try{

            User::findOrFail($id)->delete();
        }catch(\Throwable $errors){

            report($errors);
            return redirect()->back()->withInput()->withErrors('Não é possível excluir este usuário.');
        }

        return redirect()->back()->withInput()->with('Usuário deletado com sucesso!');
    }

    public function edit($id){
        $user = User::findOrFail($id);
        return view('users.createUser', compact('user'));
    }

    public function update(Request $request, $id){

        $userExist = User::where('name', $request->only('name'))->first();

        if($userExist) {
            if($request->id == $userExist->id){
                $user = User::find($id);
                $input = $request->all();
                $user->update($input);
                return redirect('users')->with('flash_message', 'Usuário alterado!');        
            }
            return redirect()->back()->withErrors(['msg' => 'Já existe um usuário cadastrado com esses dados']);
        }

        $user = User::find($id);
        $input = $request->all();
        $user->update($input);
        return redirect('users')->with('flash_message', 'Usuário alterado!');

    }
}
