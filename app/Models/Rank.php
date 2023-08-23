<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Rank extends Model
{
    use HasFactory;
    protected $table ='ranks';
    protected $primaryKey = 'idRank';
    public $timestamps = false;
    
    protected $fillable = [
        
        'RankName',
        'MinItemsBut',
        'RankMinoPoints',
        'EarnOnline',
        'BonusRange',
        'ActivLevel1',
        'ActivLevel2',
        'ResidualBonus',
        'Level1Comm',
        'Level2Comm',
        'addRange',
        'BuyOnlinePercentRange',
        'ActionsRank'

    ];


    public function affiliate(): HasOne
    {
        return $this->hasOne(Affiliate::class);
    }


}
