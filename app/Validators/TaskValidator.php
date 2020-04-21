<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

/**
 * Class TaskValidator.
 *
 * @package namespace App\Validators;
 */
class TaskValidator extends LaravelValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'name' => 'required|string',
            'description' => 'required|min:10|string',
            'completed' => 'required|boolean'
        ],
        ValidatorInterface::RULE_UPDATE => [
            'name' => 'string',
            'description' => 'min:10|string',
            'completed' => 'boolean'
        ],
    ];
}
