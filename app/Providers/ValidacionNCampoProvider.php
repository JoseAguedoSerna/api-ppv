<?php

namespace App\Providers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class ValidacionNCampoProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Validator::extend('unique_field', function ($attribute, $value, $parameters, $validator) {
            $modelClass = $parameters[0];
            $ignoreColumn = isset($parameters[1]) ? $parameters[1] : null;
            $ignoreId = isset($parameters[2]) ? $parameters[2] : null;
            $model = app($modelClass);
            return !$model->where($attribute, $value)
                ->when($ignoreColumn, function ($query) use ($ignoreColumn, $model, $attribute, $value, $ignoreId) {
                    return $query->where($ignoreColumn, '!=', $ignoreId);
                })
                ->withTrashed() // Agregar la llamada a withTrashed()
                ->exists();
        });

        // Validator::replacer('unique_field', function ($message, $attribute, $rule, $parameters) {
        //     return false;
        // });
    }

}
