<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\RegisterController;
use Illuminate\Http\Response;
class HomeController extends Controller {

    public function redirect(Request $request)
    {
        // return response()->json([$request->user()]);
        if (RegisterController::check_authorized($request)){
            return view("dashboard");
        }
        return response()
        ->view('welcome')
        ->header('auth', "Not AUTHORISED");;
        // return Redirect::route('login');
    }

}