<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\SignuInRequest;
use App\Http\Requests\Customer\SignUpRequest;
use App\Repositories\User\UserRepositoryInterface;
use App\SocialiteProvider;
use App\User;
use Exception;
use Hamcrest\Type\IsObject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Hash;
use Mail;
use Cart;

class AuthController extends Controller
{
    private $user;

    public function __construct(UserRepositoryInterface $user)
    {
        $this->user = $user;
    }

    /**
     * Customer Sign In Form
     * @param Request $request
     * @return view
     */
    function signInForm(Request $request)
    {
        return view('customer.auth.signin');
    }

    /**
     * Customer Sign Up Form
     * @param Request $request
     * @return view
     */
    function signUpForm(Request $request)
    {
        return view('customer.auth.signup');
    }

    /**
     * When Customer Sign In
     * @param SignuInRequest $request
     * @return redirect
     */
    function signIn(SignuInRequest $request)
    {
        $result = $this->user->customerLogin($request->only('email', 'password'));
        if (is_object($result)) {
            if (Cart::getContent()->count() > 0) {
                return redirect('checkout');
            }
            return redirect('dashboard')->with('login_msg', $result->first_name);
        } else {
            return redirect()->back()->with('signin_error', $result);
        }
    }

    /**
     * When Customer Sign up
     * @param SignUpRequest $request
     * @return redirect
     */
    function signUp(SignUpRequest $request)
    {
        $attributes = $request->only('first_name', 'last_name', 'email', 'password');
        $attributes['phone'] = $request->phone_code . " " . $request->phone;
        $user = $this->user->store($attributes);
        $result = $this->user->customerLogin($request->only('email', 'password'));
        if (is_object($result)) {
            if (Cart::getContent()->count() > 0) {
                return redirect('checkout');
            }
            return redirect('dashboard')->with('signup_success', 'Your Account Created Successfully!');
        } else {
            return redirect()->back()->with('signin_error', $result);
        }
    }


    /**
     * When Customer Sign up
     * @param SignUpRequest $request
     * @return redirect
     */
    function ajexSignUp(SignUpRequest $request)
    {
        $attributes = $request->only('first_name', 'last_name', 'email', 'password');
        $attributes['phone'] = $request->phone_code . " " . $request->phone;
        $this->user->store($attributes);
        $result = $this->user->customerLogin($request->only('email', 'password'));
        if (is_object($result)) {
            return response()->json(['success'=> 'Your Account Created Successfully!']);
        } else {
            return response()->json(['error', $result]);
        }
    }

    /**
     * When Customer Sign Out
     * @param Request $request
     * @return redirect
     */
    function signOut(Request $request)
    {
        Auth::logout();
        return redirect('/signin');
    }

    /*
        Below Code Is Socialite [Facebook : Google]
    */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        try {
            $user = Socialite::driver($provider)->user();
            $authUserRes = $this->checkUser($user, $provider);
            Auth::login($authUserRes['user'], true);
            if ($authUserRes['is_new']) {
                Session::flash('new_account', true);
            }
            return redirect('/dashboard');
        } catch (Exception $e) {
            return redirect('/signin');
        }
    }

    public function checkUser($providerUser, $provider)
    {
        $account =  $this->user->findBySocialiteProviderAndId($provider, $providerUser->getId());
        if ($account) {
            return [
                'is_new'    => false,
                'user'      => $account->user
            ];
        } else {
            $user = $this->user->findByEmail($providerUser->getEmail());
            if (!$user) {
                $user = $this->user->store([
                    'email'         => $providerUser->getEmail(),
                    'first_name'    => ($provider == "google") ? $providerUser->user['family_name'] : $providerUser->user['name'],
                    'last_name'     => ($provider == "google") ? $providerUser->user['given_name'] : null,
                ]);

                $this->user->storeSocialite([
                    'user_id'           => $user->id,
                    'provider'          => $provider,
                    'provider_id'       => $providerUser->getId(),
                    'provider_picture'  => $providerUser->getAvatar(),
                ]);
            }
            return [
                'is_new'    => true,
                'user'      => $user
            ];
        }
    }


    /**
     *  Below Code Is Forgot Password
     */
    public function resetPassword()
    {
        return view('customer.auth.forget-password');
    }

    public function resetPasswordLinkSend(Request $request)
    {
        $this->validate($request, [
            'email' => [
                'required', 'exists:users,email',
            ]
        ], [
            'email.exists' => 'invalid email'
        ]);
        if ($this->user->linkSend($request->all())) {
            return redirect()->back()->with('password_link', 'password reset link send Successfully.!');
        } else {
            return redirect()->back();
        }
    }

    public function showResetForm(Request $request, $token = null, $code = null)
    {
        $pageConfigs = ['bodyCustomClass' => 'login-bg', 'isCustomizer' => false];
        return view('customer.auth.otp-verify')->with(
            ['token' => $token, 'code' => base64_decode($code), 'pageConfigs' => $pageConfigs]
        );
    }

    public function otpVerify(Request $request)
    {
        $request->validate([
            'otp' => [
                'required', 'exists:users,otp',
            ]
        ], [
            'otp.exists' => 'invalid OTP'
        ]);
        $user = User::where('otp', $request->otp)->first();
        return redirect('/reset')->with(['email' => $user->email]);
    }

    public function forgetPassword()
    {
        return view('customer.auth.reset');
    }

    public function reset_pass(Request $request)
    {
        $request->validate([
            'password'   => 'required|string|min:8|confirmed',
            'email' => [
                'required', 'exists:users,email',
            ]
        ], [
            'email.exists' => 'invalid Email ID'
        ]);

        $user = User::where('email', $request->email)->first();
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect('/signin')->with("reset_success", "Password Reset Successfully");
    }
}
