<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ComputoController extends Controller
{
    public function showFormularioComputo()
{
    return view('formularioComputo');
}

}
