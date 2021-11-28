<?php

namespace App\Contracts;

interface UpdatesCreatorInformation
{
    /**
     * Validate and update the given user's creator information.
     *
     * @param  mixed  $creator
     * @param  array  $input
     * @return void
     */
    public function update($creator, array $input);
}
