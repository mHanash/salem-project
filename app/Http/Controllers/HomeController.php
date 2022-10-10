<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if (Hash::check('saSalemFin', $user->password)) {
            return redirect()->route('newPassword');
        }
        return view('home');
    }
}
