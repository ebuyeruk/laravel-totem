<?php

namespace Ebuyer\Totem;

use Closure;
use Cron\CronExpression;
use Illuminate\Contracts\Validation\ValidationRule;

class CronExpressionRule implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! CronExpression::isValidExpression($value)) {
            $fail('The :attribute must be a valid cron expression.');
        }
    }
}
