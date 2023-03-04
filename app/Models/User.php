<?php

namespace App\Models;

use App\Core\Traits\SpatieLogsActivity;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Eloquent\Casts\Attribute;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;
    use SpatieLogsActivity;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'api_token',
        'password',
        'is_activate',
        'activation_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = [
        'role_formatted',
    ];

    public function getRememberToken()
    {
        return $this->remember_token;
    }

    public function setRememberToken($value)
    {
        $this->remember_token = $value;
    }

    /**
     * Get a fullname combination of first_name and last_name
     *
     * @return string
     */
    public function getNameAttribute()
    {
        if ($this->first_name) {
            return "{$this->first_name} {$this->last_name}";
        } else {
            return $this->full_name;
        }
    }

    protected function roleFormatted(): Attribute
    {
        if ($this->polres_code == null && $this->polsek_code == null) {
            $role = "Superadmin Polda";
        } else if ($this->polres_code != null && $this->polsek_code == null) {
            $role = "Admin Polres";
        } else {
            $role = "Admin Polsek";
        }

        return new Attribute(
            get: fn () => $role,
        );
    }

    /**
     * Prepare proper error handling for url attribute
     *
     * @return string
     */
    public function getAvatarUrlAttribute()
    {
        if ($this->info) {
            return asset($this->info->avatar_url);
        }

        return asset(theme()->getMediaUrlPath().'avatars/blank.png');
    }

    /**
     * User relation to info model
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function info()
    {
        return $this->hasOne(UserInfo::class);
    }

    public function role(){
        return $this->belongsTo(Role::class);
    }

    public function polres(){
        return $this->belongsTo(MasterListPolres::class);
    }

    public function polsek(){
        return $this->belongsTo(MasterListPolsek::class);
    }
}
