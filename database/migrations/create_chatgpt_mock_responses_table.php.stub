<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('chatgpt_mock_responses', function (Blueprint $table) {
            $table->id();
            $table->text('prompt');
            $table->string('hashsum');
            $table->text('response');
            $table->timestamps();
        });
    }
};
