<?php

namespace AmiMebrouki\LivewireInlineValidation;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

trait WithInlineValidation
{
    public function validateInline($field, $rules)
    {
        $data = [$field => $this->$field];
        $validator = Validator::make($data, [$field => $rules]);

        try {
            $validator->validate();
            $this->resetErrorBag($field);
        } catch (ValidationException $e) {
            $this->addError($field, $e->validator->errors()->first($field));
        }
    }

    public function updated($field)
    {
        // Automatically trigger inline validation when a field updates.
        if (property_exists($this, 'inlineRules') && array_key_exists($field, $this->inlineRules)) {
            $this->validateInline($field, $this->inlineRules[$field]);
        }
    }

    // Called via Livewire from the frontend, dynamically sets validation rules
    public function setInlineRules($field, $rules)
    {
        if (!property_exists($this, 'inlineRules')) {
            $this->inlineRules = [];
        }
        $this->inlineRules[$field] = $rules;
    }
}
