<?php

namespace App\Models;

use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FiatWallet extends Model
{
    use HasFactory, SoftDeletes;

    public $table = 'fiat_wallets';

    public const STATUS_SELECT = [
        '1' => 'True',
        '0' => 'False',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const TYPE_OF_USER_SELECT = [
        'internal' => 'Internal',
        'external' => 'External',
        'client'   => 'Client',
    ];

    protected $fillable = [
        'name',
        'currency_id',
        'amount',
        'type_of_user',
        'user_id',
        'payment_mode_id',
        'paid_currency_id',
        'paid_amount',
        'status',
        'note',
    ];

    public $orderable = [
        'id',
        'currency.name',
        'amount',
        'type_of_user',
        'user.name',
        'payment_mode.name',
        'paid_currency.name',
        'paid_amount',
        'status',
        'note',
    ];

    public $filterable = [
        'id',
        'currency.name',
        'amount',
        'type_of_user',
        'user.name',
        'payment_mode.name',
        'paid_currency.name',
        'paid_amount',
        'status',
        'note',
    ];

    protected $appends = [
        'symbol_with_amount',
        'symbol_with_paid_amount',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class, 'currency_id', 'id');
    }

    public function getTypeOfUserLabelAttribute($value)
    {
        return static::TYPE_OF_USER_SELECT[$this->type_of_user] ?? null;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function paymentMode()
    {
        return $this->belongsTo(PaymentMode::class);
    }

    public function paidCurrency()
    {
        return $this->belongsTo(Currency::class);
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

    public function getSymbolWithAmountAttribute()
    {
        $num = $this->currency->symbol.' '.$this->amount;

        return $num;
    }

    public function getSymbolWithPaidAmountAttribute()
    {
        $num = $this->currency->symbol.' '.$this->paid_amount;

        return $num;
    }
}
