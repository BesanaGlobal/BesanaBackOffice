<?php

namespace App\Http\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Affiliate;

class AffiliatesTable extends DataTableComponent
{
    // protected $model = Affiliate::class;

   

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }
    
    public function columns(): array
    {
        if (auth()->user()->idAffiliated != 1) {
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
                    ->sortable(),
            ];
        }else{
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
                    ->sortable(),
                ButtonGroupColumn::make('Acciones')
                    ->attributes(function($row){
                        return [
                            'class' => 'space-x-2',
                        ];
                    })
                    ->buttons([
                        LinkColumn::make('View')
                            ->title(fn($row) => 'Editar')
                            ->location(fn($row) => route('affiliateEdit', $row->idAffiliated))
                            ->attributes(function($row){
                                return [
                                    'class' => 'px-3 py-2 btn bg-green-600 hover:btn h-12 w-32 bg-green-700 rounded-lg text-white opacity-100',
                                ];
                            })
                        ]),
            ];
        }
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
