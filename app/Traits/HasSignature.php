<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Laravel\Jetstream\Features;

trait HasSignature
{
    /**
     * Update the user's profile photo.
     *
     * @param  \Illuminate\Http\UploadedFile  $photo
     * @return void
     */
    public function updateSignature(UploadedFile $signature)
    {
        tap($this->user->signature_path, function ($previous) use ($signature) {
            $this->user->forceFill([
                'signature_path' => $signature->storePublicly(
                    'profile-signature', ['disk' => $this->profileSignatureDisk()]
                ),
            ])->save();

            if ($previous) {
                Storage::disk($this->profileSignatureDisk())->delete($previous);
            }
        });
    }

    /**
     * Delete the user's profile photo.
     *
     * @return void
     */
    public function deleteProfileSignature()
    {

        if (is_null($this->user->signature_path)) {
            return;
        }

        Storage::disk($this->profileSignatureDisk())->delete($this->user->signature_path);

        $this->user->forceFill([
            'signature_path' => null,
        ])->save();
    }

    /**
     * Get the URL to the user's profile photo.
     *
     * @return string
     */
    public function getSignatureUrlAttribute()
    {
        return $this->signature_path
            ? Storage::disk($this->profileSignatureDisk())->url($this->signature_path)
            : $this->defaultSignatureUrl();
    }

    /**
     * Get the default profile photo URL if no profile photo has been uploaded.
     *
     * @return string
     */
    protected function defaultSignatureUrl()
    {
        $name = trim(collect(explode(' ', $this->name))->map(function ($segment) {
            return mb_substr($segment, 0, 1);
        })->join(' '));

        return 'https://ui-avatars.com/api/?name='.urlencode($name).'&color=7F9CF5&background=EBF4FF';
    }

    /**
     * Get the disk that profile photos should be stored on.
     *
     * @return string
     */
    protected function profileSignatureDisk()
    {
        return isset($_ENV['VAPOR_ARTIFACT_NAME']) ? 's3' : config('jetstream.profile_signature_disk', 'public');
    }
}
