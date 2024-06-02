<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminUserController extends Controller
{
    const PAGINATE_PER_PAGE = 10;

    public function index()
    {
        return view("admin.user.index", ['users' => User::paginate(self::PAGINATE_PER_PAGE)]);
    }

    function create()
    {
        return view("admin.user.new");
    }

    function store()
    {
    }

    public function restorePasswordIndex()
    {
        return view("admin.user.restore-password");
    }

    public function restorePassword()
    {
         
    }
}
