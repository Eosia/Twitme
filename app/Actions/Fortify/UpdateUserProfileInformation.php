<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;
use Image, Storage, Str;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    /**
     * Validate and update the given user's profile information.
     *
     * @param  array<string, string>  $input
     */
    public function update(User $user, array $input): void
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:191'],
            'nickname' => ['required', 'string', 'max:191', 'alpha_dash', Rule::unique(User::class)->ignore($user->id)],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
        ])->validateWithBag('updateProfileInformation');

        // Traitement de l'avatar
        if (request()->hasFile('avatar')) {
            if (!request()->file('avatar')->isValid()) {
                // Utilisation d'une exception pour gérer l'erreur
                throw new \Exception('Photo invalide.');
            }

            $directory = 'avatars/' . $user->id;

            if ($user->avatar) {
                $user->avatar->delete();
                Storage::deleteDirectory($directory);
            }

            $path = request()->file('avatar')->store($directory);
            $url = Storage::url($path);
            $avatar = $user->avatar()->create([
                'path' => $path,
                'url' => $url,
            ]);

            $ext = request()->file('avatar')->extension();
            $thumbnailImage = Image::make(Storage::get($path))
                ->fit(150, 150, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })
                ->encode($ext, 50);

            $filename = Str::uuid() . '.' . $ext;
            $thumbnailPath = $directory . '/thumbnails/' . $filename;
            Storage::put($thumbnailPath, $thumbnailImage);

            $avatar->thumb_path = $thumbnailPath;
            $avatar->thumb_url = Storage::url($thumbnailPath);
            $avatar->save();
        }

        if ($input['email'] !== $user->email && $user instanceof MustVerifyEmail) {
            $this->updateVerifiedUser($user, $input);
        } else {
            $user->forceFill([
                'name' => $input['name'],
                'nickname' => $input['nickname'],
                'email' => $input['email'],
            ])->save();
        }
    }

    /**
     * Update the given verified user's profile information.
     *
     * @param  array<string, string>  $input
     */
    protected function updateVerifiedUser(User $user, array $input): void
    {
        $user->forceFill([
            'name' => $input['name'],
            'email' => $input['email'],
            // Réinitialisation de la date de vérification de l'email
            'email_verified_at' => null,
        ])->save();

        $user->sendEmailVerificationNotification();
    }
}
