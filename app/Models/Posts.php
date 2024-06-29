<?php
namespace WPSP\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Posts extends Model {
	use SoftDeletes;

	protected $table      = 'posts';
	protected $primaryKey = 'id';
	protected $fillable   = [];
	protected $guarded    = [];

	public function categories(): \Illuminate\Database\Eloquent\Relations\BelongsToMany {
		return $this->belongsToMany(Categories::class, 'post_category_relationships', 'post_id', 'category_id');
	}

	public function addCategory($categoryId): void {
		$this->categories()->attach($categoryId);
	}

	public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo {
		return $this->belongsTo(Users::class, 'user_id');
	}
	
}
