<?php

namespace App\Http\Controllers;

use App\Task;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\TaskRepository;


use Illuminate\Support\Facades\DB;//tmp

class TaskController extends Controller
{

    /**
     * Экземпляр TaskRepository.
     *
     * @var TaskRepository
     */
    protected $tasks;


    public function __construct(TaskRepository $tasks)
    {
        $this->middleware('auth');

        $this->tasks = $tasks;
    }

    /**
     * Показать список всех задач пользователя.
     *
     * @param  Request  $request
     * @return Response
     */
    public function index(Request $request)
    {
        return view('tasks.index', [
            'tasks' => $this->tasks->forUser($request->user()),
        ]);
    }

    public function test(Request $request)
    {

        $users = DB::select('select * from users where email_verified_at IS  NULL');

        echo "<pre>";
        var_dump($users);
        exit;
    }


    /**
     * Создание новой задачи.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
//        $minutes = time() + 3600;
//        return response('Hello World')->cookie(
//            'name', 'value', $minutes
//        );
        //$file = $request->file('photo');


        //$input = $request->all();

        echo "<pre>";
        var_dump($file);
        exit;

        $this->validate($request, [
            'name' => 'required|max:255',
        ]);

        $request->user()->tasks()->create([
            'name' => $request->name,
        ]);

        return redirect('/tasks');
        // Создание задачи...
    }

    /**
     * Уничтожение заданной задачи.
     *
     * @param  Request  $request
     * @param  Task  $task
     * @return Response
     */

    public function destroy(Request $request,  Task $task)
    {

        $this->authorize('destroy', $task);

        $task->delete();

        return redirect('/tasks');
    }




}
