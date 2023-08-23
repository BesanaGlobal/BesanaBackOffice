<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use LDAP\Result;
use PhpOffice\PhpSpreadsheet\Calculation\MathTrig\Sum;

use App\Models\Sale;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Affiliate extends Model
{
    use HasFactory;

    protected $table ='affiliates';
    protected $primaryKey = 'idAffiliated';
    public $timestamps = false;

    protected $fillable = [
        'SSN',
        'Name',
        'LastName',
        'AlternativePhone',
        'WorkPhone',
        'DateBirth',
        'Email',
        'confirmedEmail',
        'Address',
        'Country',
        'State',
        'City',
        'ZipCode',
        'Phone',
        'Latitude',
        'Longitude',
		'CreatedAt',
		'ModifiedAt',
        'firstBuy',
        'StatusAff',
		'confirmation_code',
		'idRank'
    ];

    // public function webSite(): HasOne{
    //     return $this->hasOne(Website::class);
    // }

	public function rank(): BelongsTo
    {
        return $this->belongsTo(Rank::class, 'idRank');
    }

	public function user(): HasOne
    {
        return $this->hasOne(User::class, 'idAffiliated');
    }

	public function sales(): HasMany
    {
        return $this->hasMany(Sale::class, 'idAffiliated');
    }

	public function children(): HasMany
    {
        return $this->hasMany(Arbol::class, 'idFhater');
    }

	public function childrenByLevel($id, $level) {

		$level1 = Affiliate::find($id)->children()->pluck('idSon');
		$levels = collect();
		$levels->push($level1);
		for ($i = 1; $i <= 10; $i++) {
			$levels[$i] = collect();
			foreach ($levels[$i - 1] as $n) {
				$levels[$i] = $levels[$i]->merge(Affiliate::find($n)->children()->pluck('idSon'));
			}
		}
		return $levels[$level];

	  }

	  public function viewChildren($id){
		$niveles = Affiliate::ver($id, 1);
		return $niveles;

	  }


	//LISTO
	/** bloque de puntos obtenidos en la compra en el web site y oficina de usuarios clientes,
	 *  solo usando el nombre de referencia. */
	public function getTotalGeneralPointsByClientsInTheWebsiteAndOffice($id) {
		// set_time_limit(20000);

		$office = Sale::where('webShop', 'oficina')
		->where('idAffiliated', $id)
		->whereMonth('datetimeb', now()->month)
		->whereYear('datetimeb', now()->year)
		->with('detailSales.product')
		->get();
		
		$officePoints = collect();
		foreach($office as $detail){
			foreach($detail->detailSales as $dt){
				$officePoints = $officePoints->merge($dt->cantidad * $dt->product->puntos);
			}
		}

		$web = Sale::where('webShop', 'website')
		->where('idAffiliated', $id)
		->whereMonth('datetimeb', now()->month)
		->whereYear('datetimeb', now()->year)
		->with('detailSales.product')
		->get();
		
		$webPoints = collect();
		foreach($web as $detail){
			foreach($detail->detailSales as $dt){
				$webPoints = $webPoints->merge($dt->cantidad * $dt->product->puntosWebsite);
			}
		}

		$points = $webPoints->sum() + $officePoints->sum();
		// $result = $office + $web;
		return $points;
		
	}

	//LISTO
	/** bloque de puntos obtenidos en la compra en el web site de usuarios que son socios promotores, 
	* solo usando el nombre de referencia. */
	public function getTotalPointsByPromotersInTheWebsiteBuy($id) {

		$total_points = collect();
		for($i = 0; $i <= 2; $i++){

			$level1 = Affiliate::childrenByLevel($id, $i);
			$level1Points = collect();

			foreach($level1 as $l1){
				$level1Points = $level1Points->merge(Sale::with('detailSales.product')
				->with(['affiliate.user' => function($query){
					$query->where('active', 1);
				}])
				->whereHas('affiliate', function ($query) {
					$query->where('idRank', 1);	
				})
				->with('affiliate')
				->where('webShop', 'website')
				->where('idAffiliated', $l1)
				->whereMonth('datetimeb', now()->month)
				->whereYear('datetimeb', now()->year)
				->get());
			}

			$promoters = collect();

			foreach($level1Points as $promoter){
				foreach($promoter->detailSales as $dt){
					$promoters->put($promoter->affiliate->Name, $dt->cantidad * $dt->product->puntosWebsite);
				}
			}
			$total_points = $total_points->merge($promoters->sum());
			
		}
		return $total_points->sum();
	}

	//Listo
	/** bloque de puntos obtenidos en la compra en la oficina y en el website de usuarios que son socios activos, 
	* solo usando el nombre de referencia. */
	public function getTotalPointsByActivePartners($id) {

		$total_points = collect();
		for($i = 0; $i <= 8; $i++){

			$level1 = Affiliate::childrenByLevel($id, $i);
			$oficePoints = collect();
			$webPoints = collect();

			foreach($level1 as $l1){
				$oficePoints = $oficePoints->merge(Sale::with('detailSales.product')
				->with(['affiliate.user' => function($query){
					$query->where('active', 1);
				}])
				->whereHas('affiliate', function ($query) {
					$query->where('idRank', '<>', 1);	
				})
				->with('affiliate')
				->where('webShop', 'oficina')
				->where('idAffiliated', $l1)
				->whereMonth('datetimeb', now()->month)
				->whereYear('datetimeb', now()->year)
				->get());
			}

			$officePartners = collect();

			foreach($oficePoints as $partners){
				foreach($partners->detailSales as $dt){
					$officePartners->put($partners->affiliate->Name, $dt->cantidad * $dt->product->puntos);
				}
			}

			foreach($level1 as $l1){
				$webPoints = $webPoints->merge(Sale::with('detailSales.product')
				->with(['affiliate.user' => function($query){
					$query->where('active', 1);
				}])
				->whereHas('affiliate', function ($query) {
					$query->where('idRank', '<>', 1);	
				})
				->with('affiliate')
				->where('webShop', 'website')
				->where('idAffiliated', $l1)
				->whereMonth('datetimeb', now()->month)
				->whereYear('datetimeb', now()->year)
				->get());
			}

			$webPartners = collect();

			foreach($webPoints as $partners){
				foreach($partners->detailSales as $dt){
					$webPartners->put($partners->affiliate->Name, $dt->cantidad * $dt->product->puntosWebsite);
				}
			}

			$total_points = $total_points->merge($officePartners->sum() + $webPartners->sum());

		}

		return $total_points->sum();

	}

	//Listo
	/**Bloque que busca mis Socios Promotores Directos */
	public function getActivePromotersByAffiliated($id){
		$level1 = Affiliate::childrenByLevel($id, 0);
		$level1Points = collect();

		foreach($level1 as $l1){
			$level1Points = $level1Points->merge(Sale::with('detailSales.product')
			->with(['affiliate.user' => function($query){
				$query->where('active', 1);
			}])
			->whereHas('affiliate', function ($query) {
				$query->where('idRank', 1);	
			})
			->with('affiliate')
			->where('webShop', 'website')
			->where('idAffiliated', $l1)
			->whereMonth('datetimeb', now()->month)
			->whereYear('datetimeb', now()->year)
			->get());
		}
		$promoters = collect();

		foreach($level1Points as $promoter){
			foreach($promoter->detailSales as $dt){
				$data = [
					'name' => $promoter->affiliate->Name,
					'email' => $promoter->affiliate->Email,
					'phone' => $promoter->affiliate->Phone,
					'points' => $dt->cantidad * $dt->product->puntosWebsite,
					'active' => $promoter->affiliate->user->active,
					];
				$promoters->put($promoter->affiliate->Name, $data);
			}
		}
		return $promoters;
			
	}


	//Listo
	/**Bloque que busca mis Socios Activos Directos */
	public function getActivePartnersByAffiliated($id){

		$level1 = Affiliate::childrenByLevel($id, 0);
		$level1PointsOffice = collect();
		$level1PointsWeb = collect();

		foreach($level1 as $l1){
			$level1PointsOffice = $level1PointsOffice->merge(Sale::with('detailSales.product')
			->with(['affiliate.user' => function($query){
				$query->where('active', 1);
			}])
			->whereHas('affiliate', function ($query) {
				$query->where('idRank', '<>', 1);	
			})
			->with('affiliate')
			->where('webShop', 'oficina')
			->where('idAffiliated', $l1)
			->whereMonth('datetimeb', now()->month)
			->whereYear('datetimeb', now()->year)
			->get());

			$level1PointsWeb = $level1PointsWeb->merge(Sale::with('detailSales.product')
			->with(['affiliate.user' => function($query){
				$query->where('active', 1);
			}])
			->whereHas('affiliate', function ($query) {
				$query->where('idRank','<>', 1);	
			})
			->with('affiliate')
			->where('webShop', 'website')
			->where('idAffiliated', $l1)
			->whereMonth('datetimeb', now()->month)
			->whereYear('datetimeb', now()->year)
			->get());

		}

		$partnersOffice = collect();

		foreach($level1PointsOffice as $promoter){
			foreach($promoter->detailSales as $dt){
				$data = [
					'name' => $promoter->affiliate->Name,
					'email' => $promoter->affiliate->Email,
					'phone' => $promoter->affiliate->Phone,
					'pointsOffice' => $dt->cantidad * $dt->product->puntos,
					'pointsWeb' => 0,
					'active' => $promoter->affiliate->user->active,
					];
				$partnersOffice->put($promoter->affiliate->Name, $data);
			}
		}

		$partnersWeb = collect();

		foreach($level1PointsWeb as $promoter){
			foreach($promoter->detailSales as $dt){
				$data = [
					'name' => $promoter->affiliate->Name,
					'email' => $promoter->affiliate->Email,
					'phone' => $promoter->affiliate->Phone,
					'pointsOffice' => 0,
					'pointsWeb' => $dt->cantidad * $dt->product->puntosWebsite,
					'active' => $promoter->affiliate->user->active,
					];
				$partnersWeb->put($promoter->affiliate->Name, $data);
			}
			
		}

		$partners = collect();
		$partners = $partnersOffice->merge($partnersWeb)->unique('name');

		return $partners;

	}

	//LISTO
	/** bloque de puntos por clientes en el web site*/
	public function getClientByAffiliatedInTheWebsite($id){

		$clientsWeb = Sale::join('DetailSale', 'DetailSale.id_sale', '=', 'Sales.idSale')
		->join('products', 'DetailSale.id_product', '=', 'products.idProd')
		->where('Sales.webShop', 'website')
		->where('Sales.idAffiliated', $id)
		->whereMonth('Sales.datetimeb',  now()->month)
		->whereYear('Sales.datetimeb',  now()->year)
		->groupBy('Sales.idAffiliated', 'Sales.WebNameClient', 'Sales.WebEmailClient', 'Sales.datetimeb')
		->select('Sales.idAffiliated', 'Sales.WebNameClient', 'Sales.WebEmailClient', DB::raw('SUM(DetailSale.cantidad * products.puntosWebsite) AS puntosWeb'), 'Sales.datetimeb')
		->get();

        return $clientsWeb;
    }

	//LISTO
	/** bloque de puntos por compras en la oficina*/
	public function getBuyAffiliatedInTheOffice($id){
		$buyOffice = Sale::join('DetailSale', 'DetailSale.id_sale', '=', 'Sales.idSale')
		->join('products', 'DetailSale.id_product', '=', 'products.idProd')
		->where('Sales.webShop', 'oficina')
		->where('Sales.idAffiliated', $id)
		->whereMonth('Sales.datetimeb',  now()->month)
		->whereYear('Sales.datetimeb',  now()->year)
		->groupBy('Sales.datetimeb')
		->select(DB::raw('SUM(DetailSale.cantidad * products.puntos) AS puntosOficina'), 'Sales.datetimeb')
		->get();

        return $buyOffice;
    }

}
