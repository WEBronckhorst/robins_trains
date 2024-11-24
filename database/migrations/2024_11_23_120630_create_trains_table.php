<?php

use App\Models\Category;
use App\Models\Manufacturer;
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
        Schema::create('trains', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Category::class);
            $table->foreignIdFor(Manufacturer::class);
            $table->foreignIdFor(\App\Models\RailSystem::class);
            $table->string('Title');
            $table->integer('Quantity');
            $table->text('Description');
            $table->string('Image')->nullable();
            $table->integer('Scale');
            $table->string('Country');
            $table->string('Company');
            $table->integer('CompanyNumber');
            $table->string('Color');
            $table->boolean('Decoder');
            $table->text('ShortDescription');
            $table->date('PurchasedDate');
            $table->string('Packaging');
            $table->string('Condition');
            $table->string('PurchasedFor');
            $table->string('Address');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trains');
    }
};
