<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\versions_projects;
use App\Http\Requests\StoreProjectsRequest;
use App\Models\Project;

class VersionsController extends Controller
{
    public function showVersionsList(){

        $search = request('search');

        if($search){
            $versions = versions_projects::where([
                ['name', 'like', '%'.$search.'%']
            ])->paginate(9);

        } else {
            $versions = versions_projects::paginate(9);
        }

        return view('projects.versionsProjects', ['versions' => $versions]);
    }

    public function showCreateVersion(){

        $projects = Project::all();

        return view('projects.createVersions', ['projects' => $projects]);
    }

    public function createVersion(StoreProjectsRequest $request)
    {
        // dd($request);
        $request->validated();
        
        try {

            $exists = versions_projects::where('name', $request->only('name'))->first();

            if($exists) {
                return redirect()
                    ->back()
                    ->withErrors(['msg' => 'Já existe uma versão cadastrada com esse nome!']);
            }

            $version = versions_projects::create([
                'name' => request('name'),
                'comments' => $request->comments,
                'project_id' => $request->project_id,
            ]);

            $version->save();

            return redirect('versions');

        } catch (\Throwable $th) {
            return redirect()->back()->withErrors($th->getMessage());
        }
    }

    public function destroy($id){

        versions_projects::findOrFail($id)->delete();

        return redirect()->back()->withInput()->withErrors('Registro deletado com sucesso!');

    }

    public function edit($id){
        $version = versions_projects::find($id);
        $projects = Project::all();
        $versionProject = Project::find($version->project_id);
        return view('projects.createVersions', compact('version', 'projects', 'versionProject'));
    }

    public function update(StoreProjectsRequest $request, $id){

        $versionExist = versions_projects::where('name', $request->only('name'))->first();

        if($versionExist){
            if($request->id == $versionExist->id){
                $version = versions_projects::find($id);
                $input = $request->all();
                $version->update($input);
                return redirect('versions')->with('flash_message', 'Alterado a versão!');
            }
            return redirect()->back()->withErrors(['msg' => 'Já existe um projeto cadastrado com esse nome']);
        }
        $version = versions_projects::find($id);
        $input = $request->all();
        $version->update($input);
        return redirect('versions')->with('flash_message', 'Alterado a versão!');
    }
}
