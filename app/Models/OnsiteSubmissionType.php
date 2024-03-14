<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class OnsiteSubmissionType extends Model
{
    use HasFactory,LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            //Customizing the log name
            ->useLogName('OnsiteSubmissionType')
            //Log changes to all the $fillable
            ->logFillable()
            //Customizing the description
            ->setDescriptionForEvent(fn(string $eventName) => "{$eventName}")
            //Logging only the changed attributes
            ->logOnlyDirty()
            //Prevent save logs items that have no changed attribute
            ->dontSubmitEmptyLogs();
    }
    protected $fillable = ['name','payment_type_id','created_by','updated_by','deleted_by'];

    /**
     * Relationship
     *
     */
    public function user_registrations()
    {
        return $this->hasMany(UserRegistration::class,'submission_type_id');
    }

    public function paymentType()
    {
        return $this->belongsTo(PaymentType::class,'payment_type_id');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
