<?php

namespace backend\models;
use Yii;

class Graficas {
    public function getDb() {
        return Yii::$app->db;
    }

    public function obtenDatos($numDias, $fechaInicio, $idUsuario) {
        $fechas = array();
        for($i = 0; $i < $numDias; $i++)
            $fechas[$i] = date("Y-m-d", strtotime(($numDias  - $i)." days ago", strtotime($fechaInicio)));
        $cadenaSelect = "select NombreProyecto";
        $cadenaSql = " from (Select idProyecto, NombreProyecto from proyectos where Activo = 1) p";
        for($i = 0; $i < count($fechas); $i++) {
            $cadenaSelect .= ", coalesce(f". $i .", 0) f".$i;
            $cadenaSql .= " left outer join ".
                    "(select idProyecto, sum(Total) f". $i . " ".
                    "from bitacoratiempos ".
                    "WHERE Fecha = '". $fechas[$i] ."' AND idUsuario = ".$idUsuario." ".
                    "group by idProyecto) T". $i ." ".
                    "ON p.idProyecto = T" .$i. ".idProyecto ";
        }
        $cadenaSql = $cadenaSelect.$cadenaSql." order by p.idProyecto";
        $rows =$this->getDb()->createCommand($cadenaSql) -> queryAll();
        $series = array();
        foreach ($rows as $row) {
            $serie = array();
            $serie['name'] = $row['NombreProyecto'];
            $suma = 0;
            for($i = 0; $i < $numDias; $i++){
                $serie['data'][] = floatval($row["f".$i]);
                $suma += $row["f".$i];
            }
            if($suma > 0)
            array_push($series, $serie);
        }
        return $series;
    }
}