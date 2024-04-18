<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

#[\Attribute]
class ValidHost extends Constraint
{
    public string $message = 'The value "{{ value }}" is not a valid host.';
}
