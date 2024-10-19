<?php

namespace AmiMebrouki\LivewireInlineValidation;
use Illuminate\Support\ServiceProvider;

class InlineValidationServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Publish the JavaScript for use in the frontend
        $this->publishes([
            __DIR__ . '/../resources/js/inline-validation.js' => public_path('vendor/inline-validation/inline-validation.js'),
        ], 'inline-validation');

        // Include the JavaScript in the frontend
        \Livewire::listen('component.hydrate', function ($component) {
            $component->emit('includeInlineValidationScript');
        });
    }

    public function register()
    {
        //
    }
}
