<?php

namespace App\Models;

use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class CryptoTrade extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia;

    public $table = 'crypto_trades';

    protected $appends = [
        'documents',
    ];

    public const STATUS_SELECT = [
        '1' => 'True',
        '0' => 'False',
    ];

    public const TYPE_SELECT = [
        'buy'  => 'Buy',
        'sell' => 'Sell',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'type',
        'platform_accounts_id',
        'currency_id',
        'currency_value',
        'crypto_currency_id',
        'crypto_currency_value',
        'payment_mode_id',
        'fiat_wallet_id',
        'user_id',
        'note',
        'status',
    ];

    public $orderable = [
        'id',
        'type',
        'platform_accounts.login_details',
        'currency.name',
        'currency_value',
        'crypto_currency.name',
        'crypto_currency_value',
        'payment_mode.name',
        'fiat_wallet.amount',
        'note',
        'status',
    ];

    public $filterable = [
        'id',
        'type',
        'platform_accounts.login_details',
        'currency.name',
        'currency_value',
        'crypto_currency.name',
        'crypto_currency_value',
        'payment_mode.name',
        'fiat_wallet.amount',
        'note',
        'status',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $thumbnailWidth  = 50;
        $thumbnailHeight = 50;

        $thumbnailPreviewWidth  = 120;
        $thumbnailPreviewHeight = 120;

        $this->addMediaConversion('thumbnail')
            ->width($thumbnailWidth)
            ->height($thumbnailHeight)
            ->fit('crop', $thumbnailWidth, $thumbnailHeight);
        $this->addMediaConversion('preview_thumbnail')
            ->width($thumbnailPreviewWidth)
            ->height($thumbnailPreviewHeight)
            ->fit('crop', $thumbnailPreviewWidth, $thumbnailPreviewHeight);
    }

    public function getTypeLabelAttribute($value)
    {
        return static::TYPE_SELECT[$this->type] ?? null;
    }

    public function platform()
    {
        return $this->belongsTo(Platform::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function platformAccounts()
    {
        return $this->belongsTo(PlatformAccount::class);
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    public function cryptoCurrency()
    {
        return $this->belongsTo(CryptoCurrency::class);
    }

    public function getDocumentsAttribute()
    {
        return $this->getMedia('crypto_trade_documents')->map(function ($item) {
            $media                      = $item->toArray();
            $media['url']               = $item->getUrl();
            $media['thumbnail']         = $item->getUrl('thumbnail');
            $media['preview_thumbnail'] = $item->getUrl('preview_thumbnail');

            return $media;
        });
    }

    public function paymentMode()
    {
        return $this->belongsTo(PaymentMode::class);
    }

    public function fiatWallet()
    {
        return $this->belongsTo(FiatWallet::class);
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
}
