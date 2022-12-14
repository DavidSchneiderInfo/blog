<?php

namespace App\Models;

use App\Models\Traits\ExportsDatetimeValues;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * User model.
 *
 * @method static first(string[] $array)
 * @method static create(array $array)
 * @method static where(string[] $array)
 * @property int        $id
 * @property mixed      $name
 * @property mixed      $email
 * @property mixed|null $email_verified_at
 * @property mixed      $updated_at
 * @property mixed      $created_at
 */
class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, ExportsDatetimeValues;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable
        = [
            'name',
            'email',
            'password',
        ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden
        = [
            'id',
            'password',
            'remember_token',
            'email_verified_at',
        ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts
        = [
            'email_verified_at' => 'datetime',
        ];

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }
}
