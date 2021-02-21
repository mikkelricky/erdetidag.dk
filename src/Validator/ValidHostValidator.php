<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class ValidHostValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        /* @var $constraint \App\Validator\ValidHost */
        if (
            "*" === $value ||
            filter_var($value, FILTER_VALIDATE_DOMAIN, FILTER_FLAG_HOSTNAME)
        ) {
            return;
        }

        // TODO: implement the validation here
        $this->context
            ->buildViolation($constraint->message)
            ->setParameter("{{ value }}", $value)
            ->addViolation();
    }
}
