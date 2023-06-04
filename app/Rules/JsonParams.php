<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class JsonParams implements Rule
{
    public function passes($attribute, $value)
    {
        // Parse the JSON string into an array
        $params = json_decode($value, true);

        // Check if the required parameters are present
        // if (!isset($params['recipientListID']) || empty($params['recipientListID'])) {
        //     return false;
        // }

        // if (!isset($params['MyRecords']) || empty($params['MyRecords'])) {
        //     return false;
        // }

        // Add more checks for other parameters if needed

        // If all checks pass, return true
        return true;
    }

    public function message()
    {
        return 'The JSON parameters are invalid.';
    }
}