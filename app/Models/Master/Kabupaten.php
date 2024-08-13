<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kabupaten extends Model
{
	use SoftDeletes;

	protected $table 	= 'kabupaten';
	protected $fillable = [
		'provinsi_id',
		'nama_kabupaten',
		'code',
		'created_by',
		'updated_by',
		'deleted_by',
		'created_at',
		'updated_at',
		'deleted_at',
	];

	// relation
	public function provinsi()
	{
		return $this->belongsTo(Provinsi::class, 'provinsi_id');
	}

	public function kecamatan()
	{
		return $this->hasMany(Kecamatan::class);
	}

	public function area()
	{
		return $this->hasMany(Area::class);
	}
	//

	// get attribute
	public function getNamaKabupatenWithIdAttribute()
	{
		return $this->id . '|' . $this->nama_kabupaten;
	}

	public function getNamaKabupatenWithProvAttribute()
	{
		return $this->nama_kabupaten . ', ' . $this->provinsi->nama_provinsi;
	}
	//

	// scope
	//

	// data
	public function formatDataApi()
	{
		return [
			'id'                => $this->id,
			'nama'              => $this->nama_kabupaten,
		];
	}
	// 
}
