<?php

class AcceptedValidator extends BaseValidator
{
    protected function handle($value) : ?string
    {
        if ($value !== '1')
        {
            return 'Veuillez cochez la case ci-dessus pour continuer.';
        }

        return null;
    }
}