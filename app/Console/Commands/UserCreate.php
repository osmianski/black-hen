<?php

namespace App\Console\Commands;

use App\Models\Organization;
use App\Models\User;
use App\Validators\UserValidator;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class UserCreate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:create
        {name? : User name (use "" around multiple words)}
        {--slug= : User slug}
        {--email= : Email address}
        {--password= : Password}
        {--organization= : Organization slug or ID}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create new user';

    /**
     * Execute the console command.
     */
    public function handle(UserValidator $validator): int
    {
        try {
            $user = User::create($validator->validate([
                'name' => $name = ($this->argument('name') ?? $this->ask('Name')),
                'slug' => $this->option('slug') ?? $this->ask('Slug', Str::slug($name)),
                'email' => $this->option('email') ?? $this->ask('Email'),
                'password' => Hash::make(
                    $this->option('password') ?? $this->secret('Password')
                ),
            ]));

            $this->info('The user is created!');

            if ($slugOrId = ($this->option('organization') ?? $this->ask('Organization slug or ID'))) {
                $organization = (is_numeric($slugOrId) ? Organization::find($slugOrId) : null)
                    ?? Organization::where('slug', $slugOrId)->first();

                if (!$organization) {
                    $this->error("Organization with slug or ID '{$slugOrId}' not found");
                    return static::FAILURE;
                }

                $user->organizations()->attach($organization->id);

                $this->info("The user is added to the '{$organization->name}' organization!");
            }
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
