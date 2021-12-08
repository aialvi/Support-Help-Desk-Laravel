<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TicketsController extends Controller
{
    public function create()
    {
        $categories = Category::all();

        return view('tickets.create', compact('categories'));
    }
}
