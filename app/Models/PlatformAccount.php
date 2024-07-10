<?php

namespace App\Models;

use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PlatformAccount extends Model
{
    use HasFactory, SoftDeletes;

    public $table = 'plaform_accounts';

    public const STATUS_SELECT = [
        '1' => 'True',
        '0' => 'False',
    ];

    protected $appends = [
        'platform_with_account'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'platform_id',
        'login_details',
        'username',
        'balance',
        'note',
        'status',
    ];

    public $orderable = [
        'id',
        'platform.name',
        'login_details',
        'username',
        'balance',
        'note',
        'status',
    ];

    public $filterable = [
        'id',
        'platform.name',
        'login_details',
        'username',
        'balance',
        'note',
        'status',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function platform()
    {
        return $this->belongsTo(Platform::class);
    }

    public function getStatusLabelAttribute($value)
    {
        return static::STATUS_SELECT[$this->status] ?? null;
    }

    public function getCreatedAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('project.datetime_format')) : null;
    }

    public function getUpdatedAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('project.datetime_format')) : null;
    }

    public function getDeletedAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('project.datetime_format')) : null;
    }

    public function getPlatformWithAccountAttribute()
    {
        $num = $this->username.' ('.$this->platform->name.')';

        return $num;
    }
}
