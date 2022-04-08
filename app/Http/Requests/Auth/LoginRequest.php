<?php

namespace App\Http\Requests\Auth;

use App\Models\Visiteurs;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'VIS_NOM' => ['required'],
            'VIS_DATEEMBAUCHE' => ['required'],
        ];
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate()
    {
        $this->ensureIsNotRateLimited();

        $vis_dateembauche = $this->VIS_DATEEMBAUCHE . " 00:00:00" ;

        $visiteur = Visiteurs::where([
            'VIS_NOM' => $this->VIS_NOM,
            'VIS_DATEEMBAUCHE' => $vis_dateembauche
        ])->first();

        if (! $visiteur) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'VIS_NOM' => __('auth.failed'),
            ]);
        }
        
        Auth::login($visiteur);
        RateLimiter::clear($this->throttleKey());
    }

    /**
     * Ensure the login request is not rate limited.
     *
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function ensureIsNotRateLimited()
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'VIS_NOM' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the rate limiting throttle key for the request.
     *
     * @return string
     */
    public function throttleKey()
    {
        return Str::lower($this->input('VIS_NOM')).'|'.$this->ip();
    }
}
