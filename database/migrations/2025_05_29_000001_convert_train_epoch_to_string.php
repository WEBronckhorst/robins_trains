<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private const EPOCH_MAP = [
        1 => 'I',
        2 => 'II',
        3 => 'III',
        4 => 'IV',
        5 => 'V',
        6 => 'VI',
        7 => 'VII',
    ];

    public function up(): void
    {
        Schema::table('trains', function (Blueprint $table) {
            $table->string('epoch', 10)->nullable()->default('I')->change();
        });

        foreach (DB::table('trains')->select('id', 'epoch')->get() as $train) {
            if (is_numeric($train->epoch) && isset(self::EPOCH_MAP[(int) $train->epoch])) {
                DB::table('trains')
                    ->where('id', $train->id)
                    ->update(['epoch' => self::EPOCH_MAP[(int) $train->epoch]]);
            }
        }
    }

    public function down(): void
    {
        $reverseMap = array_flip(self::EPOCH_MAP);

        foreach (DB::table('trains')->select('id', 'epoch')->get() as $train) {
            if (isset($reverseMap[$train->epoch])) {
                DB::table('trains')
                    ->where('id', $train->id)
                    ->update(['epoch' => $reverseMap[$train->epoch]]);
            }
        }

        Schema::table('trains', function (Blueprint $table) {
            $table->integer('epoch')->default(1)->change();
        });
    }
};
