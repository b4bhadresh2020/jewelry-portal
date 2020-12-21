<?php

namespace App\Repositories\User;

use App\Address;
use App\Repositories\User\UserRepositoryInterface;
use App\SocialiteProvider;
use Illuminate\Support\Facades\Hash;
use App\User;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Laravel\Socialite\Facades\Socialite;
use Mail;

class UserRepository implements UserRepositoryInterface
{

    /**
     * @return array $attributes
     * @return User
     */
    public function store(array $attributes)
    {
        $this->hashPassword($attributes);
        $user = User::create($attributes);
        if (request()->has('group') && request('group') != '') {
            $user->assignGroup(request('group'));
        }
        return $user;
    }

    /**
     * @param int $userId
     * @param array $attributes
     * @return bool
     */
    public function update($userId, array $attributes)
    {
        $user = $this->findById($userId);
        $this->hashProfile($user, $attributes);
        $user->update(Arr::except($attributes, 'profile'));

        // Revoke all the groups from User
        if (request()->has('group') && request('group') != '') {
            $user->revokeAllGroups();
            $user->assignGroup(request('group'));
        }
        return $user;
    }

    public function updateStatus($id, array $attributes)
    {
        return User::where('id', $id)->update($attributes);
    }

    /**
     * @param int $userId
     * @return User
     */
    public function findById($userId)
    {
        return User::find($userId);
    }

    /**
     * @param string $email
     * @return User
     */
    public function findByEmail($email)
    {
        return User::where('email', $email)->first();
    }

    /**
     * @param boolean
     */
    public function delete($userId, $forceDelete = false)
    {
        $user = $this->findById($userId);
        return ($forceDelete) ? $user->forceDelete() : $user->delete();
    }

    public function filterWithPaginate()
    {
        $items = (in_array(request()->items, [10, 25, 50])) ? request()->items : 10;
        return  app(Pipeline::class)
            ->send(User::query())
            ->through([
                \App\QueryFilters\User\Status::class,
                \App\QueryFilters\User\Type::class,
                \App\QueryFilters\User\SortField::class,
                \App\QueryFilters\User\LastName::class,
                \App\QueryFilters\User\FirstName::class,
                \App\QueryFilters\User\Phone::class,
                \App\QueryFilters\User\Email::class,
            ])
            ->thenReturn()
            ->where('id', '!=', Auth::id())
            ->where('email', '!=', DEV_EMAIL)
            ->paginate($items);
    }

    // Other Helper
    /**
     * @param array $attributes
     */
    protected function hashPassword(array &$attributes)
    {
        if (array_key_exists('password', $attributes)) {
            $attributes['password'] = Hash::make($attributes['password']);
        }
    }

    /**
     * Login As Customer
     * @param array $attributes
     * @return string|Auth::User
     */
    public function customerLogin($attributes)
    {
        $user = $this->findByEmail($attributes['email']);
        if ($user->type == 2) {
            if (!$user->status) {
                return 'Your account is block please contact to admin!';
            }
            if (Auth::attempt(['email' => $attributes['email'], 'password' => $attributes['password']])) {
                return Auth::user();
            } else {
                return 'Password is incorrect!';
            }
        } else {
            return 'Invalid account!';
        }
    }

    public function findByStatus($status)
    {
        return User::select('*')
            ->where('status', $status)
            ->get();
    }

    public function storeSocialite(array $attributes)
    {
        return SocialiteProvider::create($attributes);
    }

    public function findBySocialiteProviderAndId($provider, $providerId)
    {
        return SocialiteProvider::where('provider', $provider)
            ->where('provider_id', $providerId)->first();
    }

    public function changeAuthUserPassword($newPassword)
    {
        $user = $this->findById(auth()->user()->id);
        $user->password = Hash::make($newPassword);
        return $user->save();
    }

    /**
     * @param int $id
     * @return boolean
     */
    public function userHasDefaultAddress($id)
    {
        return (Address::where('user_id', $id)->where('is_default', true)->count()) > 0 ? true : false;
    }

    // Other Helper
    /**
     * @param Category $category
     * @param $request
     */
    function hashProfile($user, &$attributes)
    {
        if (array_key_exists('profile', $attributes)) {
            $image              = $attributes['profile'];
            $newMediaPath       = Storage::disk()->put('user/profile', $image);
            // wasRecentlyCreated is used to check recored is create recently or not
            if ($user->wasRecentlyCreated) {
                $user->media()->create([
                    'path' => $newMediaPath,
                ]);
            } else {
                $oldMediaPath       = isset($user->media->path) ? $user->media->path : null;
                if ($oldMediaPath) {
                    $user->media()->update([
                        'path' => $newMediaPath
                    ]);
                    if (Storage::disk()->exists($oldMediaPath)) {
                        @Storage::disk()->delete($oldMediaPath);
                    }
                } else {
                    $user->media()->create([
                        'path' => $newMediaPath,
                    ]);
                }
            }
        }
    }


    public function linkSend($request)
    {
        $user = $this->findByEmail($request['email']);
        $user->otp = rand(100000, 100);
        $user->save();
        $data = [
            'code' => $user->otp,
            'link' => url('password/reset/' . $request['_token'] . '/' . base64_encode($user->otp)),
        ];
        Mail::send('customer.mail.link-otp-send', $data, function ($message) use ($user) {
            $message->to($user->email)->subject('Forget-password-link');
            $message->from(config('mail.from.address'), config('mail.from.name'));
        });
        return 1;
    }
}
