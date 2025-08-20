<?php
// Create migration for community programs
// Run: php artisan make:migration create_community_programs_table

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('community_programs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('team_leader_id')->constrained('users')->onDelete('cascade');
            $table->string('program_name');
            $table->text('description');
            $table->text('support_needed');
            $table->datetime('event_date');
            $table->text('location');
            $table->text('proposal')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('community_programs');
    }
};
