<?php

namespace App\Validators;
use Illuminate\Support\Facades\Validator as Facade;

abstract class Validator
{
    protected array $excluding = [];
    protected bool $excludingAbsent = false;

    abstract public function rules(): array;

    public function excluding(string $key): static
    {
        $this->excluding[] = $key;

        return $this;
    }

    public function excludingAbsent(): static
    {
        $this->excludingAbsent = true;

        return $this;
    }

    protected function filteredRules(array $data): array
    {
        $rules = $this->rules();

        foreach ($this->excluding as $key) {
            unset($rules[$key]);
        }

        if ($this->excludingAbsent) {
            foreach (array_keys($rules) as $key) {
                if (!array_key_exists($key, $data)) {
                    unset($rules[$key]);
                }
            }
        }

        return $rules;
    }
    public function validate(array $data): array
    {
        return Facade::make($data, $this->filteredRules($data))->validate();
    }

    public function validateJson(array $data = []): array
    {
        return $this->validate(array_merge(
            json_decode(request()->getContent(), true, flags: JSON_THROW_ON_ERROR),
            $data,
        ));
    }
}
