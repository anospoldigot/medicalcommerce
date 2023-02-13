<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Ramsey\Uuid\Uuid;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [];
    public $appends = ['status_label', 'order_status_color', 'created'];
    public $keyType = 'string';
    public $incrementing = false;

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            try {
                $model->id = Uuid::uuid4();
            } catch (\Throwable $e) {
                abort(500, $e->getMessage());
            }
        });
    }


    public $casts = [
        'created_at' => 'datetime:d/m/Y'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
    public function getCreatedAttribute()
    {
        return Carbon::parse($this->created_at)->diffForHumans();
    }

    public function transaction()
    {
        return $this->hasOne(Transaction::class);
        
    }

    public function getOrderStatusColorAttribute()
    {
        switch ($this->status) {
            case 'CANCELED':
                return 'danger';
                break;
            case 'ISSUED':
                return 'warning';
                break;
            case 'PAID':
                return 'primary';
                break;
            case 'PROCESS':
                return 'Sedang Diproses';
                break;
            case 'SHIPPING':
                return 'Dikirim';
                break;
            case 'COMPLETE':
                return 'Selesai';
                break;
            
            default:
            return 'warning';
                break;
        }
    }

    public function getStatusLabelAttribute()
    {
        switch ($this->status) {
            case 'CANCELED':
                return 'Batal';
                break;
            case 'ISSUED':
                return 'Menunggu Konfirmasi';
                break;
            case 'PAID':
                return 'Lunas';
                break;
            case 'PROCESS':
                return 'Sedang Diproses';
                break;
            case 'SHIPPING':
                return 'Dikirim';
                break;
            case 'COMPLETE':
                return 'Selesai';
                break;
            
            default:
            return 'Belum Bayar';
                break;
        }

    }
}
