<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class ValidHostValidator extends ConstraintValidator
{
    public function validate(mixed $value, Constraint $constraint): void
    {
        assert($constraint instanceof ValidHost);
        if (
            '*' === $value
            || filter_var($value, FILTER_VALIDATE_DOMAIN, FILTER_FLAG_HOSTNAME)
        ) {
            return;
        }

        $this->context
            ->buildViolation($constraint->message)
            ->setParameter('{{ value }}', $value)
            ->addViolation();
    }
}
