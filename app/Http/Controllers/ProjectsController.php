<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectsRequest;
use App\Models\Project;
use App\Models\versions_projects;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    public function showProjectList()
    {

        $search = request('search');

        if($search){
            $projects = Project::where([
                ['name', 'like', '%'.$search.'%']
            ])->paginate(9);

        } else {
            $projects = Project::paginate(9);
        }

        return view('projects.projects', ['projects' => $projects]);
    }

    public function showCreateProject()
    {
        return view('projects.createProject');
    }

    public function createProject(StoreProjectsRequest $request)
    {
        
        $request->validated();
        
        try {

            $exists = Project::where('name', $request->only('name'))->first();

            if($exists) {
                return redirect()
                    ->back()
                    ->withErrors(['msg' => 'Já existe um projeto cadastrado com esse nome']);
            }

            $project = Project::create([
                'name' => request('name'),
                'comments' => $request->comments,
            ]);

            $project->save();

            return redirect('projects');

        } catch (\Throwable $th) {
            return redirect()->back()->withErrors($th->getMessage());
        }
    }

    public function destroy($id){
        
        try
        {
            Project::findOrFail($id)->delete();
        }catch(\Throwable $errors)
        {
            report($errors);
            return redirect()->back()->withInput()->withErrors('Não é possível excluir um projeto vinculado a uma versão!');
        }

        return redirect()->back()->withInput()->with('Registro deletado com sucesso!');
    }

    public function edit($id){
        $project = Project::findOrFail($id);
        return view('projects.createProject', compact('project'));
    }

    public function update(StoreProjectsRequest $request, $id){

        $projectExist = Project::where('name', $request->only('name'))->first();

        if($projectExist) {
            if($request->id == $projectExist->id){
                $project = Project::find($id);
                $input = $request->all();
                $project->update($input);
                return redirect('projects')->with('flash_message', 'Alterado o projeto!');        
            }
            return redirect()->back()->withErrors(['msg' => 'Já existe um projeto cadastrado com esse nome']);
        }

        $project = Project::find($id);
        $input = $request->all();
        $project->update($input);
        return redirect('projects')->with('flash_message', 'Alterado o projeto!');

    }

}
