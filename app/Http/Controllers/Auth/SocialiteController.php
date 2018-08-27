<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Vinkla\Instagram\Instagram;

class SocialiteController extends Controller
{
	protected $user;
  protected $instagram;

	function __construct()
	{
		$this->user = new User;
    $this->instagram = new \MetzWeb\Instagram\Instagram(array(
      'apiKey'      => config('services.instagram.client_id'),
      'apiSecret'   => config('services.instagram.client_secret'),
      'apiCallback' => config('services.instagram.redirect')
    ));
	}

  public function redirect($provider)
  {
    if($provider == 'instagram')
      return redirect($this->instagram->getLoginUrl());
  	return \Socialite::driver($provider)->stateless()->redirect();
  }

  public function callback($provider)
  {
    if($provider == 'instagram') {
      $code = $_GET['code'];
      $instagram = $this->instagram->getOAuthToken($code);

      // return var_dump($user);

      $userPayLoad = [
        'name' => $instagram->user->full_name,
        'password' => bcrypt('password'),
        // 'avatar' => $user->profile_picture
      ];

      $email = $instagram->user->username . '@' . $provider . '.com';
      $provider_user_id = $instagram->user->id;
      
    } else {

      $providerUser = \Socialite::driver($provider)->stateless()->user();
      $userPayLoad = [
        'name' => $providerUser->getName(),
        'password' => bcrypt('password'),
      ];

      $email = $providerUser->getEmail();
      $provider_user_id = $providerUser->getId();
    }

    $user = $this->user->updateOrCreate(['email' => $email], $userPayLoad);

  	$providerUserPayLoad = [
  		'user_id' => $user->id,
  		'provider' => $provider,
  		'provider_id' => $provider_user_id
  	];

    if(!$user->hasRole('user')) $user->assignRole('user');

  	$user->social()->updateOrCreate($providerUserPayLoad);

  	if (! $token = auth()->fromUser($user)) {
            return response()->json(['error' => 'Invalid email or password'], 401);
        }
  	return view('oauth/callback', ['token' => $token]);
  }

  public function login(Request $request)
  {
    return response([
            'status' => 'success'
        ])
        ->header('Authorization',  $request->token);
  }
}
