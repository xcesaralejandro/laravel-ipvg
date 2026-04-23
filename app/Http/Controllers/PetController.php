<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Pet;

class PetController extends Controller
{
    public function index(){
        // Obtener usuario autenticado
        // Auth::user()

        // Traer todos los registros existentes de una tabla
        // Pet::all()

        // Buscar por id
        // Pet::find(2)

        //

        // dd( Pet::where('user_id', Auth::id())->get()->toArray() );
        return view('pet.index');
    }
}
