<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

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
	
		// if ($children->isEmpty()) {
		// 	return collect();
		// }
	
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
			$officePoints = $officePoints->merge($detail->cantidad * $detail->pointsProd);
		}
	
		foreach($web as $detail){
			$webPoints = $webPoints->merge($detail->cantidad * $detail->pointsProd);
		}

		$points = $webPoints->sum() + $officePoints->sum();
	
		return $points;
		
		
	}

	public function getTotalPointsByPromotersInTheWebsiteBuy($id) {

		$level1Points 	= collect();
		$level1 		= collect();
		$data 			= [];

		for($i = 1; $i <= 2; $i++){

			$level1 = $level1->merge($this->childrenByLevel($id, $i));
		}

		foreach($level1 as $l1){
			$level1Points = $level1Points->merge(DB::select("CALL Sp_TotalPointsByPromotersInTheWebsiteBuy($l1)"));
		}

		foreach($level1Points as $promoter){
			array_push($data,[
				'name' 		=> $promoter->Name,
				'points' 	=> $promoter->cantidad * $promoter->pointsProd,
				]);
		}
		
		$totalPoints = array_sum(array_column($data, 'points'));

		return $totalPoints;
	}

	public function getTotalPointsByActivePartners($id) {

		// $cacheKey = 'total_points_by_active_partners_' . $id;
		// $totalPoints = cache()->remember($cacheKey, 3600, function () use ($id) {

		$level1 		= collect();
		$officePoints 	= collect();
		$webPoints 		= collect();
		$data 			= [];
		
		for($i = 1; $i <= 8; $i++){

			$level1 = $level1->merge($this->childrenByLevel($id, $i));

		}

		foreach($level1 as $l1){
			$officePoints 	= $officePoints->merge(DB::select("CALL Sp_TotalPointsByActivePartnersOffice($l1)"));
			$webPoints 		= $webPoints->merge(DB::select("CALL Sp_TotalPointsByActivePartnersWebsite($l1)"));
		}

		foreach($officePoints as $promoter){
			array_push($data,[
				'id' 		=> $promoter->idSale,				
				'name' 		=> $promoter->WebNameClient,
				'webshop'	=> $promoter->webShop,
				'points' 	=> $promoter->cantidad * $promoter->pointsProd,
				]);
		}

		foreach($webPoints as $promoter){
			array_push($data,[
				'id' 		=> $promoter->idSale,				
				'name' 		=> $promoter->WebNameClient,
				'webshop'	=> $promoter->webShop,
				'points' 	=> $promoter->cantidad * $promoter->pointsProd,
				]);
		}

		$totalPoints = array_sum(array_column($data, 'points'));

		return $totalPoints;

	// });


	// return $totalPoints;
}

	public function getActivePromotersByAffiliated($id){
		$level1 		= $this->childrenByLevel($id, 1);
		$level1Points 	= collect();
		$data 			= [];

		foreach($level1 as $l1){
			$level1Points = $level1Points->merge(DB::select("CALL Sp_TotalPointsByPromotersInTheWebsiteBuy($l1)"));
		}

		foreach($level1Points as $promoter){
				array_push($data,[
					'name' 		=> $promoter->Name,
					'email' 	=> $promoter->Email,
					'phone' 	=> $promoter->Phone,
					'points' 	=> $promoter->cantidad * $promoter->pointsProd,
					'active' 	=> $promoter->active,
					]);
		}

		$groupedData = array_reduce($data, function($carry, $item) {
			$key = $item['name'] . $item['email'];
			if (!isset($carry[$key])) {
				$carry[$key] = [
					'name' 			=> $item['name'],
					'email'	 		=> $item['email'],
					'phone'	 		=> $item['phone'],
					'active'	 	=> $item['active'],
					'totalPoints' 	=> 0
				];
			}
			$carry[$key]['totalPoints'] += $item['points'];
			return $carry;
		}, []);

		return $groupedData;
			
	}

	public function getActivePartnersByAffiliated($id){

		$level1 			= $this->childrenByLevel($id, 1);
		$level1PointsOffice = collect();
		$level1PointsWeb 	= collect();
		$data 				= [];

		foreach($level1 as $l1){
			$level1PointsOffice = $level1PointsOffice->merge(DB::select("CALL Sp_TotalPointsByActivePartnersOffice($l1)"));
			$level1PointsWeb 	= $level1PointsWeb->merge(DB::select("CALL Sp_TotalPointsByActivePartnersWebsite($l1)"));
		}

		foreach($level1PointsOffice as $promoter){
			array_push($data,[
					'name' 			=> $promoter->Name,
					'email' 		=> $promoter->Email,
					'codePhone' 	=> $promoter->CodePhone,
					'phone' 		=> $promoter->Phone,
					'webshop' 		=> $promoter->webShop,
					'pointsOffice' 	=> $promoter->cantidad * $promoter->pointsProd,
					'pointsWeb' 	=> 0,
					'active' 		=> $promoter->active,
					]);
				
		}

		foreach($level1PointsWeb as $promoter){
			array_push($data,[
					'name' 			=> $promoter->Name,
					'email' 		=> $promoter->Email,
					'codePhone' 	=> $promoter->CodePhone,
					'phone' 		=> $promoter->Phone,
					'webshop' 		=> $promoter->webShop,
					'pointsOffice' 	=> 0,
					'pointsWeb' 	=> $promoter->cantidad * $promoter->pointsProd,
					'active' 		=> $promoter->active,
					]);
				
		}

		$groupedData = array_reduce($data, function($carry, $item) {
			$key = $item['name'] . $item['email'];
			if (!isset($carry[$key])) {
				$carry[$key] = [
					'name' 			=> $item['name'],
					'email'	 		=> $item['email'],
					'phone'	 		=> $item['phone'],
					'codePhone'	 	=> $item['codePhone'],
					'pointsWeb' 	=> 0,
					'pointsOffice' 	=> 0,
					'active'	 	=> $item['active'],
					'totalPoints' 	=> 0
				];
			}
			$carry[$key]['totalPoints'] 	+= $item['pointsOffice'] + $item['pointsWeb'];
			$carry[$key]['pointsWeb'] 		+= $item['pointsWeb'];
			$carry[$key]['pointsOffice'] 	+= $item['pointsOffice'];
			return $carry;
		}, []);


		return $groupedData;

	}

	public function getClientByAffiliatedInTheWebsite($id){

		$buyWebsite = DB::select("CALL Sp_SalesForWebsiteAndMonth($id)");
		$data = [];
		foreach($buyWebsite as $client){
			array_push($data, [
				'name' 			=> $client->WebNameClient,
				'email'			=> $client->WebEmailClient,
				'pointsWebsite' => $client->cantidad * $client->pointsProd,
				'dateTimeb' 	=> $client->datetimeb,
				]);
		}

		$groupedData = array_reduce($data, function($carry, $item) {
			$key = $item['name'] . $item['dateTimeb'];
			if (!isset($carry[$key])) {
				$carry[$key] = [
					'name' 		=> $item['name'],
					'email'	 	=> $item['email'],
					'date' 		=> $item['dateTimeb'],
					'totalPoints' => 0
				];
			}
			$carry[$key]['totalPoints'] += $item['pointsWebsite'];
			return $carry;
		}, []);

        return $groupedData;
    }

	public function getBuyAffiliatedInTheOffice($id){
		$buyOffice 	= DB::select("CALL Sp_SalesForOfficeAndMonth($id)");
		$data = [];

		foreach($buyOffice as $client){
			array_push($data, [
				'name' 			=> $client->WebNameClient,
				'pointsOffice' 	=> $client->cantidad * $client->pointsProd,
				'dateTimeb' 	=> $client->datetimeb,
				]);
		}

		$groupedData = array_reduce($data, function($carry, $item) {
			$key = $item['name'] . $item['dateTimeb'];
			if (!isset($carry[$key])) {
				$carry[$key] = [
					'name' 		=> $item['name'],
					'date' 		=> $item['dateTimeb'],
					'totalPoints' => 0
				];
			}
			$carry[$key]['totalPoints'] += $item['pointsOffice'];
			return $carry;
		}, []);

        return $groupedData;
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
