<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {

	public function up() {
		Schema::create('activity_log', function (Blueprint $table) {
			$table->id();
			$table->string('log_name')->nullable()->index();
			$table->text('description');
			$table->nullableMorphs('subject', 'subject');
			$table->string('event')->nullable();
			$table->nullableMorphs('causer', 'causer');
			$table->json('attribute_changes')->nullable();
			$table->json('properties')->nullable();
			$table->uuid('batch_uuid')->nullable();
			$table->timestamps();
		});
	}

	public function down() {
		Schema::dropIfExists('activity_log');
	}

};