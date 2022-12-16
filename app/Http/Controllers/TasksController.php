<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Project;
use App\Models\versions_projects;
use App\Models\Tasks;
use ArrayObject;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Hash;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showTasksList()
    {
        $search = request('search');

        if($search){
            $tasks = Tasks::where([
                ['id', 'like', '%'.$search.'%']
            ])->paginate(9);

        } else {
            $tasks = Tasks::paginate(9);
        }
        
        return view('tasks.tasks', ['tasks' => $tasks]);
    }

    public function showCreateTasks()
    {
        $nowDate = Carbon::now()->toDateString();
        $users = User::all();
        $projects = Project::all();
        $versions_projects = versions_projects::all();
        return view('tasks.createTasks', ['versions_projects'=>$versions_projects, 'projects'=>$projects, 'users'=>$users, 'nowDate'=>$nowDate]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createTasks(Request $request)
    {
        $newDate = new Carbon();
        $nameFile = null;
        $namesFiles = array();

        if($request->hasFile('file')){
            foreach($request->file as $files){
                $nameFile = $newDate->day . $newDate->month . $newDate->year . $newDate->hour . $newDate->minute . '-' .  $files->getClientOriginalName();
                array_push($namesFiles, $nameFile);
                $upload = $files->storeAs($request->folder, $nameFile);
            }
        }

        $stringFiles = implode(';', $namesFiles);

        try{
            $task = Tasks::create([
                'status' => request('status'),
                'service' => request('service'),
                'date_registration' => $newDate,
                'date_start' => request('date_start'),
                'date_limit' => request('date_limit'),
                'id_user' => request('id_user'),
                'id_project' => request('id_project'),
                'id_version' => request('id_version'),
                'description' => request('description'),
                'solution' => request('solution'),
                'name_files' => $stringFiles,
                '_toke' => request('_token'),
            ]);

            $task->save();

            return redirect('tasks');
            
        }catch(\Throwable $th){
            return redirect()->back()->withErrors($th->getMessage());
        } 

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function gerePdf($id)
    {
        $task = Tasks::findOrFail($id);
        $user = User::findOrFail($task->id_user);
        $project = Project::findOrFail($task->id_project);
        $version = versions_projects::findOrFail($task->id_version);
        $pdf = Pdf::loadView('tasks.pdfTask', compact('task', 'user', 'project', 'version'));
        
        return $pdf->stream('processo_da_tarefa.pdf');
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
        $task = Tasks::findOrFail($id);
        $users = User::all();
        $projects = Project::all();
        $versions_projects = versions_projects::all();
        $stringFiles = $task->name_files;
        $arrayFiles = explode(';', $stringFiles);
        return view('tasks.createTasks', compact('task', 'users', 'projects', 'versions_projects', 'arrayFiles'));
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
        $taskExist = Tasks::where('id', $request->only('id'))->first();
        $taskExistent = Tasks::find($id);
        $newDate = new Carbon();
        $nameFile = null;
        $namesFiles = array();
        
        if($taskExist) {
            if($request->id == $taskExist->id){
                $input = $request->all();
                
                if($request->hasFile('file')){
                    foreach($request->file as $files){
                        $nameFile = $newDate->day . $newDate->month . $newDate->year . $newDate->hour . $newDate->minute . '-' . $files->getClientOriginalName();
                        array_push($namesFiles, $nameFile);
                        $upload = $files->storeAs($request->folder, $nameFile);
                    }    
                    $nameFileTaskExist = $taskExistent->name_files;
                    $stringFiles = implode(';', $namesFiles);
                    $nameFilesEnd = $nameFileTaskExist . ';' . $stringFiles;
                    $input += array('name_files' => $nameFilesEnd);
                }
                if($request->solution == null){
            $input += array('solution' => null);
        }

                $task = Tasks::find($id);
                $task->update($input);
                return redirect('tasks')->with('flash_message', 'Alterado o projeto!');        
            }
            return redirect()->back()->withErrors(['msg' => 'Já existe um projeto cadastrado com esse nome']);
        }
        
        $input = $request->all();

        if($request->hasFile('file')){
            foreach($request->file as $files){
                $nameFile = $newDate->day . $newDate->month . $newDate->year . $newDate->hour . $newDate->minute . '-' . $files->getClientOriginalName();
                array_push($namesFiles, $nameFile);
                $upload = $files->storeAs($request->folder, $nameFile);
            }
            $nameFileTaskExist = $taskExistent->name_files;
            $stringFiles = implode(';', $namesFiles);
            $nameFilesEnd = $nameFileTaskExist . ';' . $stringFiles;
            $input += array('name_files' => $nameFilesEnd);
        }
        if($request->solution == null){
            $input += array('solution' => null);
        }
        $task = Tasks::find($id);
        $task->update($input);
        
        return redirect('tasks')->with('flash_message', 'Alterado o projeto!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try
        {
            Tasks::findOrFail($id)->delete();
        }catch(\Throwable $errors)
        {
            report($errors);
            return redirect()->back()->withInput()->withErrors('Não é possível excluir essa tarefa!');
        }

        return redirect()->back()->withInput()->with('Tarefa deletado com sucesso!');
    }

    public function download($file){

        return response()->download(storage_path().'direct_tasks/public/app/public/'.$file);
    }
}
