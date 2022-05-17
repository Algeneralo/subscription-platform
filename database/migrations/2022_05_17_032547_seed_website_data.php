<?php

use Database\Factories\WebsiteFactory;
use Illuminate\Database\Migrations\Migration;

class SeedWebsiteData extends Migration
{
    public function up()
    {
        WebsiteFactory::new()->count(5)->create();
    }

}