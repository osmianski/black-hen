<?php

namespace App\Validators;

use App\Models\Organization;
use App\Models\Slug;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Unique;

class OrganizationValidator extends Validator
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
            'type' => ['nullable', Rule::enum(Organization\Type::class)],
        ];
    }

    protected function uniqueSlugRule(): Unique
    {
        $rule = Rule::unique(Slug::class, 'slug');

        if ($this->id) {
            $rule->ignore($this->id, 'organization_id');
        }

        return $rule;
    }
}
