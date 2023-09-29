<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class WithRule implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $validValues = ['ingredients', 'tags', 'category'];
        $values = explode(',', $value);

        foreach ($values as $val) {
            if (!in_array($val, $validValues)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute must be a valid combination of "ingredients," "tags," and "category".';
    }
}