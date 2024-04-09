<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogsPayementTable extends Migration
{
    public function up()
    {
        Schema::create('logs_payement', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('IDUTILISATEUR');
            $table->decimal('MONTANTPAYEMENT');
            $table->string('TRANSACTION');
            $table->timestamp('DATEPAYEMENT')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('logs_payement');
    }
}
