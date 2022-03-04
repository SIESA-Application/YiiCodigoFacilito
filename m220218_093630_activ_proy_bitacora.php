<?php

use yii\db\Migration;

/**
 * Class m220218_093630_activ_proy_bitacora
 */
class m220218_093630_activ_proy_bitacora extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        
        $this->createTable('{{%Proyectos}}', [
            'idProyecto' => $this->primaryKey(),
            'NombreProyecto' => $this->string(200)->unique(),
            'Activo' => $this->boolean()            
        ], $tableOptions);

        $this->createTable('{{%Actividades}}', [
            'idActividad' => $this->primaryKey(),
            'NombreActividad' => $this->string(200)->unique(),
            'Activo' => $this->boolean(),
            'idProyecto' => $this->integer()
        ], $tableOptions);
        
        $this->createTable('{{%Bitacoratiempos}}', [
            'idBitacoraTiempo' => $this->primaryKey(),
            'Fecha' => $this->date(),
            'HoraInicio' => $this->time(),
            'HoraFinal' => $this->time(),
            'Interrupcion' => $this->time(),
            'Total' => $this->float(),
            'ActividadNoPlaneada' => $this->string(250),
            'idActividadPlaneada' => $this->integer(),
            'idProyecto' => $this->integer(),
            'Artefacto' => $this->string(250),
            'idUsuario' => $this->integer()
        ], $tableOptions);
        
        $this->addForeignKey('FK_act_proy', 'Actividades', 'idProyecto', 'Proyectos', 'idProyecto');
        $this->addForeignKey('FK_bitt_proy', 'Bitacoratiempos', 'idProyecto', 'Proyectos', 'idProyecto');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('Fk_act_proy', 'Actividades');
        $this->dropForeignKey('Fk_bitt_proy', 'Bitacoratiempos');
        $this->dropTable('{{%Proyectos}}');
        $this->dropTable('{{%Actividades}}');
        $this->dropTable('{{%Bitacoratiempos}}');
         

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220218_093630_activ_proy_bitacora cannot be reverted.\n";

        return false;
    }
    */
}
