<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class HexColor implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, \Closure $fail): void
    {
        // Pastikan nilai adalah string
        if (!is_string($value)) {
            $fail('The :attribute must be a valid hex color code.');
            return;
        }

        // Validasi format hex: #FFF atau #FFFFFF
        if (!preg_match('/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/', $value)) {
            $fail('The :attribute format is invalid. Use #RGB or #RRGGBB (e.g. #FF0000 or #F00).');
        }
    }
}
