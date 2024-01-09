<?php

namespace App\Http\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Affiliate;
use App\Models\RelSponsor;

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
                    ->sortable()
                    ->searchable(),
                Column::make(__('Names'), "Name")
                    ->sortable()
                    ->searchable(),
                Column::make(__('LastName'), "LastName")
                    ->sortable()
                    ->searchable(),
                Column::make(__('Email'), "Email")
                    ->sortable()
                    ->searchable(),
                Column::make(__('Phone'), "AlternativePhone")
                    ->sortable()
                    ->searchable(),
                Column::make(__('Created'), "CreatedAt")
                    ->sortable()
                    ->searchable(),
                Column::make(__('Rank'), "rank.RankName")
                    ->sortable()
                    ->searchable(),
                BooleanColumn::make(__('State'), "user.active")
                    ->sortable(),
            ];
        }else{
            return [
                Column::make("Id", "idAffiliated")
                    ->sortable()
                    ->searchable(),
                Column::make(__('Names'), "Name")
                    ->sortable()
                    ->searchable(),
                Column::make(__('LastName'), "LastName")
                    ->sortable()
                    ->searchable(),
                Column::make(__('Email'), "Email")
                    ->sortable()
                    ->searchable(),
                Column::make(__('Phone'), "AlternativePhone")
                    ->sortable()
                    ->searchable(),
                Column::make(__('Created'), "CreatedAt")
                    ->sortable()
                    ->searchable(),
                Column::make(__('Rank'), "rank.RankName")
                    ->sortable()
                    ->searchable(),
                BooleanColumn::make(__('State'), "user.active")
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

            $queryBuilder = collect();
            
            $sponsor = RelSponsor::where('idAffiliatedParent', auth()->user()->idAffiliated)->get();
            foreach ($sponsor as $l1) {
                $queryBuilder = $queryBuilder->merge($l1->idAffiliatedChild);
            }

            return Affiliate::query()
            ->with('user')
            ->with('rank')
            ->whereIn('affiliates.idAffiliated', $queryBuilder);
            
        }else{
            return Affiliate::query()
            ->with('user')
            ->with('rank');
        }
        

       
       
    }

}
