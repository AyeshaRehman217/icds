<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class UserRegistration extends Model
{
    use HasFactory,LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            //Customizing the log name
            ->useLogName('User Registration')
            //Log changes to all the $fillable
            ->logFillable()
            //Customizing the description
            ->setDescriptionForEvent(fn(string $eventName) => "{$eventName}")
            //Logging only the changed attributes
            ->logOnlyDirty()
            //Prevent save logs items that have no changed attribute
            ->dontSubmitEmptyLogs();
    }

    protected $fillable = ['qualification','title','contact_no','session_id','payment_type_id','registration_type_id','user_id',
        'country_id','state_id','city_id','registration_status_id','submission_type_id','voucher_upload','created_by','updated_by','deleted_by'];

    public function sessions()
    {
        return $this->belongsTo(Session::class,'session_id');
    }

    public function abstract_submissions()
    {
        return $this->belongsTo(AbstractSubmission::class,'user_registration_id');
    }

    public function registration_types()
    {
        return $this->belongsTo(RegistrationType::class,'registration_type_id');
    }
    public function submission_types()
    {
        return $this->belongsTo(OnsiteSubmissionType::class,'submission_type_id');
    }


    public function payment_types()
    {
        return $this->belongsTo(PaymentType::class,'payment_type_id');
    }

    public function users()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function countries()
    {
        return $this->belongsTo(Country::class,'country_id');
    }

    public function states()
    {
        return $this->belongsTo(State::class,'state_id');
    }

    public function cities()
    {
        return $this->belongsTo(City::class,'city_id');
    }

    public function registrationStatuses()
    {
        return $this->belongsTo(RegistrationStatus::class,'registration_status_id');
    }
}
