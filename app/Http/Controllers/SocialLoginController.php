<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class SocialLoginController extends Controller
{
    public function redirect($provider){


        $clientId = "2ee07b84-e976-4e17-90eb-9e9ed9ea696c";

        $clientSecret = "b320d1c3c65667e6e527";

        $redirectUrl = "https://eprgn1rccp.sharedwithexpose.com/callback/snapchat";

        $additionalProviderConfig = ['site' => 'meta.stackoverflow.com'];

        $scope=[
            'https://auth.snapchat.com/oauth2/api/user.display_name',
        ];


        $config = new \SocialiteProviders\Manager\Config($clientId, $clientSecret, $redirectUrl,$additionalProviderConfig);

        return Socialite::with('snapchat')->setConfig($config)->scope($scope)->redirect();

//        return Socialite::with('snapchat')->redirect();
    }

    public function callback($provider){

        try {
            $user = Socialite::driver($provider)->user();
        } catch (Exception $e) {
            return redirect('/login');
        }


        $user = Socialite::driver('snapchat')->user();
        dd($user);
        $accessTokenResponseBody = $user->accessTokenResponseBody;




//        $getInfo = Socialite::driver($provider)->user();
//
//        $user = $this->createUser($getInfo,$provider);
//
//        auth()->login($user);
//
//        return redirect()->to('/home');

    }
    function createUser($getInfo,$provider){

        $user = User::where('provider_id', $getInfo->id)->first();

        if (!$user) {
            $user = User::create([
                'name'     => $getInfo->name,
                'email'    => $getInfo->email,
                'provider' => $provider,
                'provider_id' => $getInfo->id
            ]);
        }
        return $user;
    }
}
