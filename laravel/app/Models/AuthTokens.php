<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use app\models\User;
use App\Exceptions\Handler;
class AuthTokens extends Model
{
    protected $table = 'user_tokens';

    protected $fillable = [
        'user_id',
        'token'];
    public function create_auth_token(User $user) {
        $token = $user->createToken('auth_token')->plainTextToken;
        AuthTokens::create([
            "user_id" => $user->id,
            "token" => $token,
        ]);
        return $token;
    }
    public function get_key_by_user_id($user){
        try{
            if (User::check_exists_by_id($user->id)){
        return AuthTokens::where('user_id' ,$user->id)->first()->token;}
        else {
            return response()->json(["error"=>"User doesnt exists"]);    
        }
           }
        catch(Exception $e){
            return response()->json(["error"=>"No token for this key"]); 
        };
    }
    public function check_token_if_expired($user){
     return AuthTokens::where('user_id' , $user->id)->exists();
    }
    public function check_token_if_correct($user, $token_text) {
        return ($token_text == AuthTokens::check_token_if_expired($user));
    }
}
