<?php

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTsReleasesTable extends Migration
{
    public function __construct()
    {
        $this->prefix = Config::get('theme-store.default_table_prefix', 'ts_');

        $this->table = "{$this->prefix}_releases";
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

                $table->foreignId('theme_id')
                    ->constrained("{$this->prefix}_themes")
                    ->onDelete('cascade');

                $table->text('notes');
                $table->string('version', 20)->unique();
                $table->string('zip_file', 50);
                $table->bigInteger('file_size')->nullable();
                $table->boolean('status')->default(true);

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
                $table->dropConstrainedForeignId('theme_id');

                $table->dropIfExists();
            });
        }
    }
}
