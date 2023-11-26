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
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->string('contract_id')->nullable();
            $table->string('name');
            $table->year('year')->nullable();
            $table->string('id_card');
            $table->string('address')->nullable();
            $table->string('mobile')->index();
            $table->string('property_id')->nullable();
            $table->date('day');
            $table->string('price');
            $table->string('deposit')->nullable();
            $table->string('remain')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        DB::unprepared('
        CREATE TRIGGER `contract_id` 
        BEFORE INSERT ON `contracts`
        FOR EACH ROW 
        BEGIN 
          DECLARE last_id INT;
          DECLARE new_id VARCHAR(10);
          
          SELECT MAX(CAST(SUBSTRING(contract_id, 5) AS UNSIGNED)) INTO last_id
          FROM contracts
          WHERE contract_id LIKE \'C68-%\';
          
          IF last_id IS NULL THEN
            SET new_id = \'C68-000001\';
          ELSE
            SET new_id = CONCAT(\'C68-\', LPAD(last_id + 1, 6, \'0\'));
          END IF;
          
          SET NEW.contract_id = new_id;
        END;
        ');

        DB::unprepared('
        CREATE TRIGGER `property_id` 
        BEFORE INSERT ON `contracts`
        FOR EACH ROW
        BEGIN 
          DECLARE last_id INT;
          DECLARE new_id_2 VARCHAR(13);
          
          SELECT MAX(CAST(SUBSTRING(property_id, 6) AS UNSIGNED)) INTO last_id
          FROM contracts
          WHERE property_id LIKE \'HDDD-%\';
          
          IF last_id IS NULL THEN
            SET new_id_2 = \'HDDD-0000001\';
          ELSE
            SET new_id_2 = CONCAT(\'HDDD-\', LPAD(last_id + 1, 7, \'0\'));
          END IF;
          
          SET NEW.property_id = new_id_2;
        END
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TRIGGER `contract_id`');
        DB::unprepared('DROP TRIGGER `property_id`');
        Schema::dropIfExists('contracts');
    }
};
