<?php
namespace OCBP\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categories extends Model {
	use SoftDeletes;

	protected $table      = 'categories';
	protected $primaryKey = 'id';
	protected $fillable   = [];
	protected $guarded    = [];

	public function posts(): \Illuminate\Database\Eloquent\Relations\BelongsToMany {
		return $this->belongsToMany(Posts::class, 'post_category_relationships', 'category_id', 'post_id');
	}

	public function addPost($postId): void {
		$this->posts()->attach($postId);
	}

}
