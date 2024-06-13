<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\Menu;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function admin_dashboard()
    {
        $gallery = Gallery::all();
        $menus = Menu::all();

        return view('backend.admin_dashboard', compact('menus', 'gallery'));
    }

    public function user_dashboard()
    {
        $gallery = Gallery::all();
        $menus = Menu::all();

        return view('backend.admin_dashboard', compact('menus', 'gallery'));
    }

}
