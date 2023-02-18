<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\product;

class LogoutController extends Controller
{
    //

    public function destroy()
    {
        $product= product::paginate(6);

        Auth::logout();
        return view('home.userpage',compact('product'));
    }
}
