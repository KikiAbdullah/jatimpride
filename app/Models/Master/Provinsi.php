<?php

namespace App\Models\Master;

use App\Models\Project;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Provinsi extends Model
{
	use SoftDeletes;

	protected $table 	= 'provinsi';
	protected $fillable = [
		'nation_id',
		'nama_provinsi',
		'code',
		'created_by',
		'updated_by',
		'deleted_by',
		'created_at',
		'updated_at',
		'deleted_at',
	];

	// relation
	public function kabupaten()
	{
		return $this->hasMany(Kabupaten::class);
	}

	public function project()
	{
		return $this->hasMany(Project::class, 'provinsi_id');
	}
	//

	// get attribute
	public function getNamaProvinsiWithIdAttribute()
	{
		return $this->id . '|' . $this->nama_provinsi;
	}

	public function getProjectFormatAttribute()
	{
		return $this->project->formatDataApi();
	}
	//

	// scope
	//

	// data
	public function formatDataApi()
	{
		return [
			'id' 			=> $this->id,
			'nama' 			=> $this->nama_provinsi,
		];
	}

	public function formatDataApiProject()
	{
		return [
			'id'                    => $this->id,
			'name'         => $this->nama_provinsi,
			// 'data'                 => $this->project->transform(function ($item) {
			//     return $item->formatDataApi();
			// }),
		];
	}
	//

}
