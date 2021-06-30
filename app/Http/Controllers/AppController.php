<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;

class AppController extends Controller
{
    public function users()
    {
        $data = User::all()->Sortbydesc('created_at');
        return Inertia::render('Users',['users' => $data]);
    }
}
