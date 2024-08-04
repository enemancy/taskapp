<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('todos', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->dateTime('deadline')->nullable();
            $table->unsignedBigInteger('assignee_id')->nullable();
            $table->unsignedBigInteger('tag_id')->nullable();
            $table->boolean('completed')->default(false);
            $table->unsignedBigInteger('team_id')->nullable();
            $table->unsignedBigInteger('creater_id')->nullable();
            $table->timestamps();
        });

        Schema::table('todos', function (Blueprint $table) {
            $table->foreign('assignee_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('set null');
            $table->foreign('team_id')->references('id')->on('teams')->onDelete('set null');
            $table->foreign('creater_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('todos', function (Blueprint $table) {
            $table->dropForeign(['assignee_id']);
            $table->dropForeign(['tag_id']);
            $table->dropForeign(['team_id']);
            $table->dropForeign(['creater_id']);
        });

        Schema::dropIfExists('todos');
    }
};
