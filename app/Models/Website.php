<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Website extends Model
{
    use HasFactory;
    protected $table ='webSites';
     public $timestamps = false;
     protected $primaryKey = 'idWebsite';

    protected $fillable = [
      
        'webSite',
        'idAffiliated'

    ];

    public function affiliate(): BelongsTo
    {
        return $this->belongsTo(Affiliate::class);
    }
    public function sale(): BelongsTo
    {
        return $this->belongsTo(Sale::class);
    }

}
