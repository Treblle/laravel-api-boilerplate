<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

final class UserCreate extends Command
{
    /** @var string */
    protected $signature = 'user:create
                            {--name= : The name of the user}
                            {--email= : The email of the user}
                            {--password= : The password of the user}';

    /** @var string */
    protected $description = 'Create a new user';

    public function handle(): int
    {
        if ($this->hasNoOptions()) {
            $this->info(trans('artisan.create_user.description'));

            if (! $this->confirm(trans('artisan.create_user.dialogs.confirm_before_executing'), true)) {
                return 1;
            }
        }

        $validator = Validator::make($this->inputData(), $this->rules());

        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $message) {
                $this->error($message);
            }

            return 1;
        }

        $data = $validator->validated();
        User::create(array_merge($data, [
            'password' => Hash::make($data['password']),
        ]));

        $this->info(trans('artisan.create_user.alerts.confirmation'));
        $this->newLine();
        $this->table(['Name', 'Email', 'Password'], [$data]);

        return 0;
    }

    private function inputData(): array
    {
        return [
            'name'     => $this->option('name') ?? $this->ask(trans('artisan.create_user.questions.name')),
            'email'    => $this->option('email') ?? $this->ask(trans('artisan.create_user.questions.email')),
            'password' => $this->option('password') ?? $this->ask(trans('artisan.create_user.questions.password')),
        ];
    }

    private function rules(): array
    {
        return [
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:6'],
        ];
    }

    private function hasNoOptions(): bool
    {
        return collect([
                Arr::get($this->options(), 'name'),
                Arr::get($this->options(), 'email'),
                Arr::get($this->options(), 'password'),
            ])->filter()->count() === 0;
    }
}
