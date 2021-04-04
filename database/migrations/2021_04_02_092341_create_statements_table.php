<?php

use App\Models\Predicate;
use App\Models\Resource;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statements', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Resource::class, 'subject_id')->constrained('resources')->cascadeOnDelete();
            $table->foreignIdFor(Predicate::class)->constrained('predicates')->cascadeOnDelete();
            $table->foreignIdFor(Resource::class, 'object_id')->constrained('resources')->cascadeOnDelete();
            $table->foreignIdFor(User::class)->constrained('users')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('statements');
    }
}
