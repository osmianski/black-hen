<?php

namespace App\Console\Commands;

use App\Models\Organization;
use App\Validators\OrganizationValidator;
use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class OrganizationCreate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'organization:create
        {name? : Organization name (use "" around multiple words)}
        {--slug= : Organization slug}
        {--type= : Organization type ([empty] - regular, admin - Administrators)}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create new organization';

    /**
     * Execute the console command.
     */
    public function handle(OrganizationValidator $validator): int
    {
        try {
            Organization::create($validator->validate([
                'name' => $name = ($this->argument('name') ?? $this->ask('Name')),
                'slug' => $this->option('slug') ?? $this->ask('Slug', Str::slug($name)),
                'type' => $this->option('type') !== null
                    ? Organization\Type::from($this->option('type'))
                    : Organization\Type::choices()[$this->choice(
                        'Type (by default, regular)',
                        array_keys(Organization\Type::choices()),
                        0,
                    )],
            ]));

            $this->info('The organization is created!');
        }
        catch (ValidationException $e) {
            foreach ($e->validator->getMessageBag()->all() as $message) {
                $this->error($message);
            }

            return static::FAILURE;
        }
        catch (\ValueError $e) {
            $this->error($e->getMessage());

            return static::FAILURE;
        }

        return static::SUCCESS;
    }
}
