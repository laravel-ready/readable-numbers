<?php

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTsCategoriesTable extends Migration
{
    public function __construct()
    {
        $this->prefix = Config::get('theme-store.default_table_prefix', 'ts_');

        $this->table = "{$this->prefix}_categories";
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable($this->table)) {
            Schema::create($this->table, function (Blueprint $table) {
                $table->bigIncrements('id');

                $table->string('name', 50);
                $table->string('slug', 50)->unique();
                $table->text('description', 500)->nullable();
                $table->string('image', 50)->nullable();
                $table->boolean('featured')->default(false);

                $table->softDeletes();
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
        if (Schema::hasTable($this->table)) {
            Schema::table($this->table, function (Blueprint $table) {
                $table->dropIfExists();
            });
        }
    }
}
