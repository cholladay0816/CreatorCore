<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ReCaptchaRule implements Rule
{
    private string $error_msg = 'Failed to verify captcha.';
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if (config('app.env') == 'testing') {
            return true;
        }

        $recaptcha = new \ReCaptcha\ReCaptcha(config('recaptcha.secret'));
        $resp = $recaptcha->setExpectedHostname(request()->getHost())
            ->setScoreThreshold(config('recaptcha.threshold'))
            ->verify($value, request()->ip());
        if ($resp->isSuccess()) {
            if ($resp->getScore() < config('recaptcha.threshold')) {
                $this->error_msg = 'Failed to verify captcha.';
                return false;
            }
            return true;
        } else {
            $this->error_msg = 'Failed to verify: ' . implode(', ', $resp->getErrorCodes());
            return false;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->error_msg;
    }
}
