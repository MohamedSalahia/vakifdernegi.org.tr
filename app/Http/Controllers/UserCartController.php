<?php

namespace App\Http\Controllers;

use App\Models\UserCart;
use App\Traits\CartTrait;
use Illuminate\Http\Request;
use Auth;

class UserCartController extends Controller
{
    use cartTrait;
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(UserCart $userCart)
    {
        //
    }

    public function edit(UserCart $userCart)
    {
        //
    }

    public function update(Request $request, UserCart $userCart)
    {
        //
    }

    public function destroy(UserCart $userCart)
    {
        //
    }




}
