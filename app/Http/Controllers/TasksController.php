<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Task;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


       $data = [];
        if (\Auth::check()) {
            $user = \Auth::user();
            $tasks = $user->tasks()->orderBy('created_at', 'desc')->paginate(10);

            $data = [
                'user' => $user,
                'tasks' => $tasks,
            ];
            $data += $this->counts($user);
            return view('users.show', $data);
        }else {
            return view('welcome');
        }
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     
    
    public function create()
    {
        $task = new Task;
        if(\Auth::check()){
            return view('tasks.create', [
                'task' => $task,
            ]);
        } else {
            return redirect('/login');
        }
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
            'status' => 'required|max:10',   
            'content' => 'required|max:191',
        ]);


        $task = new Task;
        $task->status = $request->status;    
        $task->content = $request->content;
        $task->user_id = \Auth::user()->id;
        $task->title = "test";
        $task->save();

        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task = Task::find($id);
        if(\Auth::check() && $task != null )
        {

        $user = \Auth::user();
        $tasks = $user->tasks()->orderBy('created_at', 'desc')->paginate(10);
        
        if (\Auth::user()->id === $task->user_id) {
        return view('tasks.show', [
            'tasks' => $tasks,
            'task' => $task,
            'user' => $user,
        ]);
        }
        else{
           return redirect('/');
            }
        }
    else{
        return view ('welcome');
    }
}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task = Task::find($id);
        if(\Auth::check() && $task != null)
        {
        $user = \Auth::user();
        $tasks = $user->tasks()->orderBy('created_at', 'desc')->paginate(10);
        
        if (\Auth::user()->id === $task->user_id) {
        return view('tasks.edit', [
            'tasks' => $tasks,
            'task' => $task,
            'user' => $user,
        ]);
        }
        else{
           return redirect('/');
            }
        }
    else{
        return view ('welcome');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    }
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'status' => 'required|max:10',   
            'content' => 'required|max:191',
        ]);


        $task = Task::find($id);
        $task->title = $request->status;
        $task->status = $request->status;
        $task->content = $request->content;
        $task->save();

        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $task = Task::find($id);
        $task->delete();

        return redirect('/');
    }
}
   