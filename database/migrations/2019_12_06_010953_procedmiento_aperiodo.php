<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ProcedmientoAperiodo extends Migration
{
    public function up()
    {
        DB::unprepared('
  
CREATE TRIGGER pagosacol AFTER INSERT ON colegiaturas
FOR EACH ROW
BEGIN
    DECLARE done INT DEFAULT FALSE;
    DECLARE ids INT;
    DECLARE cur CURSOR FOR SELECT id FROM alumnos WHERE estado = 1; 
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;
    OPEN cur;
        ins_loop: LOOP
            FETCH cur INTO ids;
            IF done THEN
                LEAVE ins_loop;
            END IF;
            INSERT INTO pagosColegiaturas(alumno_id,colegiatura_id,estado) VALUES (ids, NEW.id,1);
        END LOOP;
    CLOSE cur;
END; //
 
        ');
    }


    public function down()
    {
        DB::unprepared('DROP TRIGGER `pagosacol`');
    }
}
