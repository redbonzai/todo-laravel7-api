<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

    /**
 * Class CreateTasksTable.
 */
class CreateTasksTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if (!Schema::hasTable('tasks')) {
            Schema::create('tasks', static function (Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->string('description');
                $table->boolean('completed')->default(false);
                $table->boolean('editing')->default(false);
                $table->date('target_date');
                //$table->date('completed_at')->default(null);
                $table->timestamps();
            });
		}

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('tasks');
	}
}
