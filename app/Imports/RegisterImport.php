<?php

namespace App\Imports;

use App\Register;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;

class RegisterImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Register([

            'fecha_registro' => $row['Fecha Actual'],
            'profesional' => $row['Profesional'],
            'rut' => $row['Rut'],
            'dv' => $row['DV'],
            'nombre' => $row['Nombre'],
            'edad' => $row['Edad'],
            'sexo' => $row['Sexo'],
            'grupo_sangre' => $row['Grupo'],
            'fecha_ingreso' => $row['Fecha Ingreso'],
            'procedencia' => $row['Procedencia'],
            'dgco_ingreso' => $row['Dg Médico Ingreso'],
            'tqt' => $row['TQT'],

            'dgco_flgo1_ing' => $row['Dg FLGO ingreso 1'],
            'severidad_ingreso1' => $row['Severidad Ingreso 1'],
            'escala_ingreso1' => $row['Escala ingreso 1'],

            'dgco_flgo2_ing' => $row['Dg FLGO ingreso 2'],
            'severidad_ingreso2' => $row['Severidad Ingreso 2'],
            'escala_ingreso2' => $row['Escala 2'],

            'dgco_flgo3_ing' => $row['Dg FLGO ingreso 3'],
            'severidad_ingreso3' => $row['Severidad Ingreso 3'],
            'escala_ingreso3' => $row['Escala 3'],

            'dgco_flgo4_ing' => $row['Dg FLGO ingreso 4'],
            'severidad_ingreso4' => $row['Severidad Ingreso 4'],
            'escala_ingreso4' => $row['Escala 4'],

            'procedimiento1' => $row['Procedimiento 1'],
            'procedimiento2' => $row['Procedimiento 2'],
            'procedimiento3' => $row['Procedimiento 3'],
            've' => $row['Via Enteral'],
            'vfc' => $row['VFC '],
            'cfv' => $row['Cuidado fin de vida'],
            'manejo1' => $row['Manejo FLGO 1'],
            'manejo2' => $row['Manejo FLGO 2'],
            'manejo3' => $row['Manejo FLGO 3'],

            'dgco_flgo1_eg' => $row['Dg FLGO  egreso 1'],
            'severidad_egreso1' => $row['Severidad Egreso 1'],
            'escala_egreso1' => $row['Escala Egreso 1'],

            'dgco_flgo2_eg' => $row['Dg FLGO  egreso 2'],
            'severidad_egreso2' => $row['Severidad Egreso 2'],
            'escala_egreso2' => $row['Escala Egreso 2'],

            'dgco_flgo3_eg' => $row['Dg FLGO  egreso 3'],
            'severidad_egreso3' => $row['Severidad Egreso 3'],
            'escala_egreso3' => $row['Escala Egreso 3'],

            'dgco_flgo4_eg' => $row['Dg FLGO  egreso 4'],
            'severidad_egreso4' => $row['Severidad Egreso 4'],
            'escala_egreso4' => $row['Escala Egreso 4'],

            'fecha_alta' => $row['Fecha alta FLGO'],
            'vee' => $row['Via enteral egreso'],
            'derivacion' => $row['Derivación']

        ]);

    }
}
