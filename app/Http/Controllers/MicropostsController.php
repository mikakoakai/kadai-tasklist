<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MicropostsController extends Controller
{
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

    public function store(Request $request)
    {
        $this->validate($request, [
            'content' => 'required|max:191',
        ]);

        $request->user()->tasks()->create([
            'content' => $request->content,
        ]);

        return redirect('/');
    }

     public function destroy($id)
    {
        $tasks = \App\Micropost::find($id);

        if (\Auth::user()->id === $tasks->user_id) {
            $tasks->delete();
        }

        return redirect()->back();
    }
}
