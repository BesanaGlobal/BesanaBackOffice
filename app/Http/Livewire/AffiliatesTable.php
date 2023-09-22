<?php

namespace App\Http\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Affiliate;
use App\Models\RelSponsor;
use App\Models\User;
use Illuminate\Contracts\Session\Session;

class AffiliatesTable extends DataTableComponent
{
    // protected $model = Affiliate::class;

   

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }
    
    public function columns(): array
    {
        return [
            Column::make("Id", "idAffiliated")
                ->sortable(),
            Column::make("Name", "Name")
                ->sortable(),
            Column::make("LastName", "LastName")
                ->sortable(),
            Column::make("Email", "Email")
                ->sortable(),
            Column::make("Phone", "AlternativePhone")
                ->sortable(),
            Column::make("Created", "CreatedAt")
                ->sortable(),
            Column::make("Rank", "rank.RankName")
                ->sortable(),
            BooleanColumn::make("Status", "user.active")
                ->sortable()
        ];
    }


    public function builder(): Builder
    {
        if(auth()->user()->idAffiliated != 1){
            return Affiliate::query()
            ->with('user')
            ->with('rank')
            ->whereHas('childrenSponsor', function ($query) {
                $query->where('idAffiliatedParent', auth()->user()->idAffiliated);
            });
        }else{
            return Affiliate::query()
            ->with('user')
            ->with('rank');
        }
        

       
       
    }

}
