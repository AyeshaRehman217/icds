<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory,HasRoles, Notifiable, LogsActivity;
    /**
     * Activity Log
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            //Customizing the log name
            ->useLogName('User')
            //Log changes to all the $fillable
            ->logFillable()
            //Customizing the description
            ->setDescriptionForEvent(fn(string $eventName) => "{$eventName}")
            //Logging only the changed attributes
            ->logOnlyDirty()
            //Prevent save logs items that have no changed attribute
            ->dontSubmitEmptyLogs();
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'status',
        'image',
        'module_id',
        'email_verified_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    /**
     * Relationship
     *
     */
    public function module(){
        return $this->belongsTo(Module::class,'module_id');
    }

    public function user_registrations()
    {
        return $this->hasOne(UserRegistration::class,'user_id');
    }

    public function abstract_submissions()
    {
        return $this->hasMany(AbstractSubmission::class, 'user_id');
    }

    public function currencies()
    {
        return $this->hasMany(Currency::class, 'user_id');
    }

    public function regions()
    {
        return $this->hasMany(Region::class, 'user_id');
    }

    public function sub_regions()
    {
        return $this->hasMany(SubRegion::class, 'user_id');
    }

    public function countries()
    {
        return $this->hasMany(Country::class, 'user_id');
    }

    public function states()
    {
        return $this->hasMany(State::class, 'user_id');
    }

    public function cities()
    {
        return $this->hasMany(City::class, 'user_id');
    }

    public function sessions()
    {
        return $this->hasMany(Session::class, 'user_id');
    }

    public function registration_types()
    {
        return $this->hasMany(RegistrationType::class, 'user_id');
    }

    public function registration_statuses()
    {
        return $this->hasMany(RegistrationStatus::class, 'user_id');
    }
}
