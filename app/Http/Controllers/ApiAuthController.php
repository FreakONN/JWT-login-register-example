<?php

namespace App\Http\Controllers;

use JWTAuth; //klasa za dohvaćanje user tokena 
use App\User;	//ugrađena Laravel klasa za korisnika koje se proširuje po potrebi
use Illuminate\Http\Request;	//pozivi na bazu (post,get,request)
use Tymon\JWTAuth\Exceptions\JWTException;	//hendlanje responsa - uspješno/neuspješno, problem (200,401,404)

/*JWT proces.
1)spoji se sa bazom tj. zatraži(request) podatke
2)napravi korisnika (array s njegovim podacima)
3)dodijeli korisniku token

*/
class ApiAuthController extends Controller
{
    //
    public function authenticate()
    {
    	//dohvati korisnicke podatke
    	//provjeri korisnicku akreditaciju
    	//generiranje tokena te vraćanje tokena na frontend
    	$credentials = request()->only('email','password');

    	//provjera user akreditacije
    	try 
    	{
    		//dohvati token za user-a
    		$token = JWTAuth::attempt($credentials);
    		if(!$token){
    			//izbaci status kod - unauthorized(401)
    			return response()->json(['error' => 'invalid_credentials'], 401);
    		}
    		
    	} catch (JWTException $e) 
	    	{
	    		//izbaci status kod - internal server error(500)
	    		return response()->json(['error' => 'something_went_wrong'], 500);	
	    	}

    	//ako sve prođe u redu izbaci status poruku success(200)
	    	return response()->json(['token' => $token], 200);
    }

    public function register()
    {
    	//pozivi u bazi - kreirani tijekom migracije
    	 $name = request()->name;
    	 $email = request()->email;
    	 $password = request()->password;

    	 // 1) kreiranje korisnika
    	 $user = User::create([
    	 	'name' => $name,
    	 	'email' => $email,
    	 	'password' => bcrypt($password)	//moramo kriptirati pass
    	 	]);

    	 // 2) generiraj token za user-a s nekim parametrima - definirani u array-u $user
    	 $token = JWTAuth::fromUser($user);

    	 // 3) napravi respone -json

    	 return response()->json(['token' => $token], 200);
    }
}
