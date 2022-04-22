<?php

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTsAuthorsTable extends Migration
{
    public function __construct()
    {
        $this->prefix = Config::get('theme-store.default_table_prefix', 'ts_');

        $this->table = "{$this->prefix}_authors";
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
                $table->string('slug', 50);
                $table->string('contact', 50);
                $table->string('avatar', 50)->nullable();
                $table->boolean('featured')->default(false);

                $table->softDeletes();
                $table->timestamps();

                $table->unique(['name', 'contact']);
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
