<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Affiliate extends Model
{
    use HasFactory;

    protected $table ='affiliates';
    protected $primaryKey = 'idAffiliated';
    public $timestamps = false;

    protected $fillable = [
        'SSN',
		'RFC',
		'CURP',
		'DPI',
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

	public function rank(): BelongsTo
    {
        return $this->belongsTo(Rank::class, 'idRank');
    }

	public function user(): HasOne
    {
        return $this->hasOne(User::class, 'idAffiliated');
    }

	public function website(): HasOne
    {
        return $this->hasOne(Website::class, 'idAffiliated');
    }

	public function sales(): HasMany
    {
        return $this->hasMany(Sale::class, 'idAffiliated');
    }

	public function children(): HasMany
    {
        return $this->hasMany(Arbol::class, 'idFhater');
    }

	public function childrenSponsor(): HasMany
    {
        return $this->hasMany(RelSponsor::class, 'idAffiliatedParent');
    }

	// public function childrenByLevel($id, $level) {

	// 	$level1 = Affiliate::find($id)->children()->pluck('idSon');
	// 	$levels = collect();
	// 	$levels->push($level1);
	// 	for ($i = 1; $i <= 10; $i++) {
	// 		$levels[$i] = collect();
	// 		foreach ($levels[$i - 1] as $n) {
	// 			$levels[$i] = $levels[$i]->merge(Affiliate::find($n)->children()->pluck('idSon'));
	// 		}
	// 	}
	// 	return $levels[$level];

	// }

	// public function viewChildren($id){
	// 	$niveles = Affiliate::childrenByLevel($id, 1);
	// 	return $niveles;

	// }

	public function childrenByLevel($id, $level)
	{
		if ($level == 0) {
			return collect([$id]);
		}
	
		$children = $this->find($id)->childrenSponsor()->pluck('idAffiliatedChild');
	
		if ($children->isEmpty()) {
			return collect();
		}
	
		return $children->flatMap(function ($childId) use ($level) {
			return $this->childrenByLevel($childId, $level - 1);
		});
	}

	public function websiteLink($id){
		$web = DB::table('affiliates')
		->where('affiliates.idAffiliated',$id)
		->join('websites', 'affiliates.idAffiliated', '=', 'websites.idAffiliated')
		->where('websites.idWebsite', '<>', 0)
		->select('websites.webSite')
		->first();

		return $web;
	}

	public function getTotalGeneralPointsByClientsInTheWebsiteAndOffice($id) {

		$office 		=	DB::select("CALL Sp_SalesForOfficeAndMonth($id)");
		$web 			=	DB::select("CALL Sp_SalesForWebsiteAndMonth($id)");

		$officePoints 	= 	collect();
		$webPoints 		= 	collect();

		foreach($office as $detail){
			$officePoints = $officePoints->merge($detail->cantidad * $detail->puntos);
		}
	
		foreach($web as $detail){
			$webPoints = $webPoints->merge($detail->cantidad * $detail->puntosWebsite);
		}

		$points = $webPoints->sum() + $officePoints->sum();
		
		return $points;
		
	}

	public function getTotalPointsByPromotersInTheWebsiteBuy($id) {

		$total_points 	= collect();
		$level1Points 	= collect();
		$promoters 		= collect();

		for($i = 1; $i <= 2; $i++){

			$level1 = $this->childrenByLevel($id, $i);
			
			foreach($level1 as $l1){
				$level1Points = $level1Points->merge(DB::select("CALL Sp_TotalPointsByPromotersInTheWebsiteBuy($l1)"));
			}
			
		}

		foreach($level1Points as $promoter){
			$promoters->put($promoter->Name, $promoter->cantidad * $promoter->puntosWebsite);
		}

		$total_points = $total_points->merge($promoters->sum());

		return $total_points->sum();
	}

	public function getTotalPointsByActivePartners($id) {

		$total_points 	= collect();
		
		$officePoints 	= collect();
		$webPoints 		= collect();

		$officePartners = collect();
		$webPartners 	= collect();
		
		for($i = 1; $i <= 8; $i++){

			$level1 = $this->childrenByLevel($id, $i);
			
			foreach($level1 as $l1){
				$officePoints = $officePoints->merge(DB::select("CALL Sp_TotalPointsByActivePartnersOffice($l1)"));
			}

			foreach($level1 as $l1){
				$webPoints = $webPoints->merge(DB::select("CALL Sp_TotalPointsByActivePartnersWebsite($l1)"));
			}
		
		}

		foreach($officePoints as $partners){
			$officePartners->put($partners->Name, $partners->cantidad * $partners->puntos);
		}

		foreach($webPoints as $partners){
			$webPartners->put($partners->Name, $partners->cantidad * $partners->puntosWebsite);
		}

		$total_points = $total_points->merge($officePartners->sum() + $webPartners->sum());

		return $total_points->sum();

	}

	public function getActivePromotersByAffiliated($id){
		$level1 		= $this->childrenByLevel($id, 1);
		$level1Points 	= collect();

		foreach($level1 as $l1){
			$level1Points = $level1Points->merge(DB::select("CALL Sp_TotalPointsByPromotersInTheWebsiteBuy($l1)"));
		}
		$promoters = collect();

		foreach($level1Points as $promoter){
				$data = [
					'name' 		=> $promoter->Name,
					'email' 	=> $promoter->Email,
					'phone' 	=> $promoter->Phone,
					'points' 	=> $promoter->cantidad * $promoter->puntosWebsite,
					'active' 	=> $promoter->active,
					];
				$promoters->put($promoter->Name, $data);
		}
		return $promoters;
			
	}

	public function getActivePartnersByAffiliated($id){

		$level1 			= $this->childrenByLevel($id, 1);
		
		$level1PointsOffice = collect();
		$level1PointsWeb 	= collect();

		$partnersOffice 	= collect();
		$partnersWeb 		= collect();

		foreach($level1 as $l1){
			$level1PointsOffice = $level1PointsOffice->merge(DB::select("CALL Sp_TotalPointsByActivePartnersOffice($l1)"));
			$level1PointsWeb = $level1PointsWeb->merge(DB::select("CALL Sp_TotalPointsByActivePartnersWebsite($l1)"));
		}

		foreach($level1PointsOffice as $promoter){
				$data = [
					'name' 			=> $promoter->Name,
					'email' 		=> $promoter->Email,
					'phone' 		=> $promoter->Phone,
					'pointsOffice' 	=> $promoter->cantidad * $promoter->puntos,
					'pointsWeb' 	=> 0,
					// 'active' => $promoter->active,
					];
				$partnersOffice->put($promoter->Name, $data);
		}

		foreach($level1PointsWeb as $promoter){
				$data = [
					'name' 			=> $promoter->Name,
					'email' 		=> $promoter->Email,
					'phone' 		=> $promoter->Phone,
					'pointsOffice' 	=> 0,
					'pointsWeb' 	=> $promoter->cantidad * $promoter->puntosWebsite,
					// 'active' => $promoter->affiliate->user->active,
					];
				$partnersWeb->put($promoter->Name, $data);
		}

		$partners = collect();
		$partners = $partnersOffice->merge($partnersWeb)->unique('name');

		return $partners;

	}

	public function getClientByAffiliatedInTheWebsite($id){

		$buyWebsite = DB::select("CALL Sp_SalesForWebsiteAndMonth($id)");
		$clients 	= collect();

		foreach($buyWebsite as $client){
			$data = [
				'name' 			=> $client->WebNameClient,
				'email'			=> $client->WebEmailClient,
				'pointsWebsite' => $client->cantidad * $client->puntosWebsite,
				'dateTimeb' 	=> $client->datetimeb,
				];

			$clients->put($client->datetimeb, $data);
		}

        return $clients;
    }

	public function getBuyAffiliatedInTheOffice($id){
		$buyOffice 	= DB::select("CALL Sp_SalesForOfficeAndMonth($id)");
		$clients 	= collect();

		foreach($buyOffice as $client){
			$data = [
				'name' 			=> $client->WebNameClient,
				'pointsOffice' 	=> $client->cantidad * $client->puntos,
				'dateTimeb' 	=> $client->datetimeb,
				];

			$clients->put($client->WebNameClient, $data);
		}

        return $clients;
    }

	public function myAffiliates($id){

		$level1 = DB::table('relsponsor')
        ->where('relsponsor.idAffiliatedParent', $id)
        ->get();

		$myAffiliates = collect();

		foreach($level1 as $l1){
			$myAffiliates = $myAffiliates->merge(DB::table('affiliates')
			->where('affiliates.idAffiliated', $l1->idAffiliatedChild)
			->join('ranks', 'affiliates.idRank', '=', 'ranks.idRank')
			->join('users', 'affiliates.idAffiliated', '=', 'users.idAffiliated')
			->select('affiliates.name','affiliates.lastName','users.CreatedAt', 'ranks.RankName', 'users.userName', 'affiliates.Email', 'affiliates.Phone', 'users.active')
			->get());
		}

		return $myAffiliates;
	}

}
