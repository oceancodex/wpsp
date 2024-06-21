<?php
namespace OCBP\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductsModel extends Model {
	use SoftDeletes;

	protected $table      = 'products';
	protected $primaryKey = 'id';
	protected $fillable   = [];
	protected $guarded    = [];

}
