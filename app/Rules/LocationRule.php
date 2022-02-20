<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

use Stevebauman\Location\Facades\Location;

class LocationRule implements Rule
{
    private $error_msg = 'Failed to confirm location.';

    private $allowed_countries = [
        'US'
    ];

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

        if ($position = Location::get()) {
            // Successfully retrieved position.
            if (!in_array($position->countryCode, $this->allowed_countries)) {
                $this->error_msg = 'Your country ('. $position->countryName  .') is currently not available.';
                return false;
            } else {
                return true;
            }
        } else {
            $this->error_msg = 'Failed to confirm location.';
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
