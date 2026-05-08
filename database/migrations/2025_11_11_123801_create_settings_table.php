<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

	/**
	 * Run the migrations.
	 */
	public function up(): void {
		Schema::create('settings', function(Blueprint $table) {
			$table->id();
			$table->string('key')->unique();
			$table->text('value')->nullable();
			$table->text('description')->nullable();

			$table->unsignedBigInteger('parent_setting_id')->nullable();

			$table->foreign('parent_setting_id')->references('id')->on('settings')->nullOnDelete()->cascadeOnUpdate();

			$table->timestamps();
			$table->softDeletes();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void {
		Schema::dropIfExists('settings');
	}

};
