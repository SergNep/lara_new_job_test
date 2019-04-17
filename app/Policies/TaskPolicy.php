<?php

namespace App\Policies;

use App\User;
use App\Task;
use Illuminate\Auth\Access\HandlesAuthorization;

class TaskPolicy
{
    use HandlesAuthorization;


    /**
     * Маппинг политики для приложения.
     *
     * @var array
     */
    protected $policies = [

        //для старых версий
        //'App\Task' => 'App\Policies\TaskPolicy',

        //для версии 5.1
        Task::class => TaskPolicy::class,
    ];


    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }


    /**
     * Определяем, может ли данный пользователь удалить данную задачу.
     *
     * @param  User  $user
     * @param  Task  $task
     * @return bool
     */
    public function destroy(User $user, Task $task)
    {
        return $user->id === $task->user_id;

    }



}
