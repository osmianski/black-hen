<?php

namespace App\Validators;

use App\Models\Slug;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Unique;

class UserValidator extends Validator
{
    protected ?int $id = null;

    public function id(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|max:255',
            'slug' => [
                'required',
                'alpha_dash',
                'max:255',
                $this->uniqueSlugRule(),
            ],
            'email' => [
                'required',
                'email',
                'max:255',
                $this->uniqueEmailRule(),
            ],
            'password' => 'required|max:255',
        ];
    }

    protected function uniqueEmailRule(): Unique
    {
        $rule = Rule::unique(User::class, 'email');

        if ($this->id) {
            $rule->ignore($this->id);
        }

        return $rule;
    }

    protected function uniqueSlugRule(): Unique
    {
        $rule = Rule::unique(Slug::class, 'slug');

        if ($this->id) {
            $rule->ignore($this->id, 'user_id');
        }

        return $rule;
    }
}
