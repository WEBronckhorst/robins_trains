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
            $table->integer('epoch')->default(1);
            $table->string('Title');
            $table->integer('Quantity')->default(1);
            $table->text('Description')->nullable();
            $table->string('Image')->nullable();
            $table->string('Scale');
            $table->string('Country')->nullable();
            $table->string('Company')->nullable();
            $table->integer('CompanyNumber')->nullable();
            $table->string('Color')->nullable();
            $table->boolean('Decoder')->nullable();
            $table->text('ShortDescription')->nullable();
            $table->date('PurchasedDate')->nullable();
            $table->string('Packaging')->nullable();
            $table->decimal('Price', 8, 2)->default(0);
            $table->string('Condition')->nullable();

            $table->string('Address')->nullable();
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
