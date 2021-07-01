<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;
use App\Models\Task;

class AppController extends Controller
{
    public function users()
    {
        $data = User::all()->Sortbydesc('created_at');
        return Inertia::render('Users',['users' => $data]);
    }

    public function tasks()
    {
        return Inertia::render('Tasks');
    }
}
