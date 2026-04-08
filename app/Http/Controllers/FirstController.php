<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class FirstController extends Controller
{
    public function primeraPagina(Request $request)
    {

        dump($request->search);
        $isAdmin = true;
        $title = "Coman frutaaa";
        $fruits = ['pera', 'manzana', 'kiwi', 'chocman'];
        return View("primeravista")
            ->with([
                'isAdmin' => $isAdmin,
                'title' => $title,
                'fruits' => $fruits
            ]);
    }
}
