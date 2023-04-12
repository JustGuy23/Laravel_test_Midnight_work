<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\AuthTokens;
use Illuminate\Support\Facades\Auth;
class RegisterController extends Controller
{
    public function register_page()
    {
        return view('create');
    }
    public function login_page()
    {
        return view('login');
    }
    public function register(Request $request)
    {   if(!RegisterController::check_if_exists($request['email'])){
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
        ]);
        $token = RegisterController::get_token($user);
        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);}
    else {
        return response("user exists" , 400 );
        }
    }

    public function login(Request $request)
    {
        $validatedData = RegisterController::validate_data($request);
        if (RegisterController::authenticate($validatedData)){
        // return response()->json(['lol' => 'yes']);
        return sprintf("<script>
        localStorage.setItem('email', %s);
        localStorage.setItem('access_token',%s);
      </script>",$validatedData['email'] ,RegisterController::authorize1($validatedData));
        // return response()->json(
        // ['email' => $request['email'],
        // "access_token" =>RegisterController::authorize1($validatedData)]);//>route();
        // response()->json( );"posts",$headers=
    }
        else {
            return response()->json(['error' => 'Invalid credentials'], 401);
        };
    }   
    public function check_if_exists($email){
         return User::check_exists($email);
    }
    private function validate_data(Request $request){
        try{
        $validatedData = $request->validate([
            'email' => 'required|email',
            'password' => 'required', ]);
        return $validatedData;}
        catch(Exception $e){
             throw new Exception("email or password not added");}; //i see in request it already cacted
    }
    public function check_authorized(Request $request){
        //get auth token from headers and check with it
        if ( $request->hasHeader('access-token') ){ //and  ($request->hasHeader('email')
        try{
        $access_data = $request->header();    //'email' , 'access_token'
        // if (RegisterController::check_if_exists($access_data['email'])) 
        // {
        if($request->hasHeader('email')){
            // if(RegisterController::uthenticate()
        $user = User::get_by_email($access_data['email']);
        }
        else {
            $user= User::get_by_id($request->user());
        };
        if (AuthTokens::check_token_if_correct( $user, $access_data['access-token'])){ // TODO: check if access token is given in parameters
        return TRUE;}
        else {
            return TRUE;
        };
    }
        catch(ErrorException $e){
            return TRUE;}
        }
        return FALSE;
    }    
    private function authorize1($validatedData){
        $user = User::get_by_email($validatedData['email']);
        // return ['lol' => 'authrhorize lol'];     
        return RegisterController::get_token($user);
    }
    private function authenticate( $validatedData){
        if (!Auth::attempt($validatedData)) {
            return FALSE;}
        else{
            return TRUE;
        }
    }
    private function get_token($user) {
        if (AuthTokens::check_token_if_expired($user)){
           return AuthTokens::get_key_by_user_id($user);}
        else {
            return AuthTokens::create_auth_token($user);
        }
    }
    public function get_token_from_localstorage(Request $request){

    }
    }

