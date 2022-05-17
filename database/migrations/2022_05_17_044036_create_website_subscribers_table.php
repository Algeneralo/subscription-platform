<?php

use App\Models\Website;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWebsiteSubscribersTable extends Migration
{
    public function up()
    {
        Schema::create('website_subscribers', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Website::class);
            $table->string('email');
            $table->timestamps();
            $table->unique(['website_id', 'email']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('website_subscribers');
    }
}