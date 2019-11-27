<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Patient;
use App\Antecedents;
use App\Register;
use App\Flgo_evolution;
use App\Expenses;
use App\High_medical;

class RegisterController extends Controller
{

    public function infoRut(Request $request){

        $rut = $request->rut;

        $patient = Patient::where('rut', $rut)->first();

        if (isset($patient)){

            $register = DB::table('register_visits')->where('patient_id', $patient->id)->first();
            $evolucion = DB::table('flgo_evolutions')->where('id', $register->evolutions_id)->first();
            $antecedentes = DB::table('antecedents')->where('register_id', $register->id)->get();
            $egreso = DB::table('expenses')->where('register_id', $register->id)->get();
            $altaMedica = DB::table('high_medical')->where('register_id', $register->id)->get();

            return response()->json([
                'validacion' => true,
                'data' => $patient,
                'evolucion' => $evolucion,
                'antecedente' => $antecedentes,
                'egreso' => $egreso,
                'altaMedica' => $altaMedica
            ]);

        }else{
            return response()->json([
                'validacion' => false,
            ]);

        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	$data = json_decode($request->input('data'));

        $profesional = '';
    	$nombre='';
    	$rut='';
    	$edad='';
    	$grupo_sangre='';
    	$sexo='';
    	$procedencia='';
    	$tqt='';
    	$diagnostico_ingreso='';
        $fecha_ingreso= '';

        $dfi=[];
        $si=[];
        $ei=[];

        $cfv = '';
        $ve = '';
        $vfc = '';
        $manejo = [];
        $procedimiento = [];

        $dfe=[];
        $se=[];
        $ee=[];

        $fecha_alta='';
        $vea='';
        $derivacion='';

        $alta=false;
        $rutExist=false;
        $idPatient=null;

        foreach ($data as $key => $dato) {

            if(isset($dato->profesional)){
                $profesional = $dato->profesional;
            }
            if(isset($dato->rut)){
                $rut = $dato->rut;
            }
            if(isset($dato->nombre)){
                $nombre = $dato->nombre;
            }
            if(isset($dato->grupo_sangre)){
                $grupo_sangre = $dato->grupo_sangre;
            }
            if(isset($dato->edad)){
                $edad = $dato->edad;
            }
            if(isset($dato->sexo)){
                $sexo = $dato->sexo;
            }
            if(isset($dato->procedencia)){
                $procedencia = $dato->procedencia;
            }
            if(isset($dato->tqt)){
                $tqt = $dato->tqt;
            }
            if(isset($dato->diagnostico_ingreso)){
                $diagnostico_ingreso = $dato->diagnostico_ingreso;
            }
            if(isset($dato->fecha_ingreso)){
                $fecha_ingreso = $dato->fecha_ingreso;
            }


            if(isset($dato->dfi)){
                $dfi = $dato->dfi;
            }
            if(isset($dato->si)){
                $si = $dato->si;
            }
            if(isset($dato->ei)){
                $ei = $dato->ei;
            }


            if(isset($dato->cfv)){
                $cfv = $dato->cfv;
            }
            if(isset($dato->ve)){
                $ve = $dato->ve;
            }
            if(isset($dato->vfc)){
                $vfc = $dato->vfc;
            }
            if(isset($dato->manejo)){
                $manejo = $dato->manejo;
            }
            if(isset($dato->procedimiento)){
                $procedimiento = $dato->procedimiento;
            }


            if(isset($dato->dfe)){
                $dfe = $dato->dfe;
            }
            if(isset($dato->se)){
                $se = $dato->se;
            }
            if(isset($dato->ee)){
                $ee = $dato->ee;
            }




            if(isset($dato->fecha_alta)){
                $fecha_alta = $dato->fecha_alta;
            }

            if(isset($dato->vea)){
                $vea = $dato->vea;
            }

            if(isset($dato->derivacion)){
                $derivacion = $dato->derivacion;
            }
            if(isset($dato->altaExist)){
                $alta = $dato->altaExist;
            }
            if(isset($dato->rutExist)){
                $rutExist = $dato->rutExist;
            }

            if(isset($dato->idPatient)){
                $idPatient = $dato->idPatient;
            }
        }

// ----------------- Validacion de datos del paciente  --------------------------------



    if ($rutExist) {

        /* Registro de evolución */
        $evolutions = new Flgo_evolution;
        if (isset($manejo[0])) {
            $evolutions->manejo_flgo1 = $manejo[0];
        }
        if (isset($manejo[1])) {
            $evolutions->manejo_flgo2 = $manejo[1];
        }
        if (isset($manejo[2])) {
            $evolutions->manejo_flgo3 = $manejo[2];
        }
        if (isset($manejo[3])) {
            $evolutions->manejo_flgo4 = $manejo[3];
        }
        if (isset($procedimiento[0])) {
            $evolutions->procedimiento1 = $procedimiento[0];
        }
        if (isset($procedimiento[1])) {
            $evolutions->procedimiento2 = $procedimiento[1];
        }
        if (isset($procedimiento[2])) {
            $evolutions->procedimiento3 = $procedimiento[2];
        }
        if (isset($procedimiento[3])) {
            $evolutions->procedimiento4 = $procedimiento[3];
        }

        $evolutions->via_enteral = $ve;
        $evolutions->vfc = $vfc;
        $evolutions->cfv = $cfv;
        $evolutions->save();

        $idEvolutions = $evolutions->id;

        $newRegister = new Register;
        $newRegister->profesional = $profesional;
        $newRegister->evolutions_id = $idEvolutions;
        $newRegister->patient_id = $idPatient;
        $newRegister->save();

        $idNewRegister = $newRegister->id;
         
        for ($i=0; $i < count($dfi); $i++) { 
            $newAntecedent = new Antecedents;
            $newAntecedent->dgflgoing = $dfi[$i];
            $newAntecedent->severidad = (integer)$si[$i];
            $newAntecedent->escala = $ei[$i];
            $newAntecedent->register_id = $idNewRegister;
            $newAntecedent->save();
        }


        for ($i=0; $i < count($dfe); $i++) { 
            $newExpenses = new Expenses;
            $newExpenses->dgflgoeg = $dfe[$i];
            $newExpenses->severidad = (integer)$se[$i];
            $newExpenses->escala = $ee[$i];
            $newExpenses->register_id = $idNewRegister;
            $newExpenses->save();
        }

        if ($alta) {     
            $newHigh = new High_medical;
            $newHigh->fecha_alta_flgo = $fecha_alta;
            $newHigh->via_enteral = $vea;
            $newHigh->derivacion = $derivacion;
            $newHigh->register_id = $idNewRegister;
            $newHigh->save();
        }

        return response()->json([
            'validacion' => true,
            'message' => 'El paciente se guardó correctamente'
        ]);

    }else{

    
            if(strlen($nombre) < 1){
                return response()->json([
                    'validacion' => false,
                    'error' => "El campo nombre es requerido"
                ]);
            }

            if(strlen($rut) < 1){
                return response()->json([
                    'validacion' => false,
                    'error' => "El campo rut es requerido"
                ]);
            }

            if(strlen($grupo_sangre) < 1){
                return response()->json([
                    'validacion' => false,
                    'error' => "El campo grupo_sangre es requerido"
                ]);
            }

            if(!is_numeric($edad)){
                return response()->json([
                    'validacion' => false,
                    'error' => "El campo edad solo debe contener numeros"
                ]);
            }

            if(strlen($sexo) < 1){
                return response()->json([
                    'validacion' => false,
                    'error' => "El campo sexo es requerido"
                ]);
            }

            if(strlen($procedencia) < 1){
                return response()->json([
                    'validacion' => false,
                    'error' => "El campo procedencia es requerido"
                ]);
            }

            if(strlen($tqt) < 1){
                return response()->json([
                    'validacion' => false,
                    'error' => "El campo tqt es requerido"
                ]);
            }

            if(strlen($diagnostico_ingreso) < 1){
                return response()->json([
                    'validacion' => false,
                    'error' => "El campo diagnostico fonoaudiologico de ingreso es requerido"
                ]);
            }

            if(strlen($fecha_alta) < 1){
                $fecha_alta = false;
            }
            if(strlen($vea) < 1){
                $vea = false;
            }
            if(strlen($derivacion) < 1){
                $derivacion = false;
            }

    // ----------------- Agregar a base de datos  --------------------------------


            /* Registro de paciente */
            $patients = new Patient;
            $patients->name = $nombre;
            $patients->rut = $rut;
            $patients->age = (integer)$edad;
            $patients->grupo_sangre = $grupo_sangre;
            $patients->sexo = $sexo;
            $patients->procedencia = $procedencia;
            $patients->tqt = $tqt;
            $patients->dgcoIngreso = $diagnostico_ingreso;
            $patients->fechaIngreso = $fecha_ingreso;
            $patients->save();

            /* Registro de evolución */
            $evolutions = new Flgo_evolution;
            if (isset($manejo[0])) {
                $evolutions->manejo_flgo1 = $manejo[0];
            }
            if (isset($manejo[1])) {
                $evolutions->manejo_flgo2 = $manejo[1];
            }
            if (isset($manejo[2])) {
                $evolutions->manejo_flgo3 = $manejo[2];
            }
            if (isset($manejo[3])) {
                $evolutions->manejo_flgo4 = $manejo[3];
            }
            if (isset($procedimiento[0])) {
                $evolutions->procedimiento1 = $procedimiento[0];
            }
            if (isset($procedimiento[1])) {
                $evolutions->procedimiento2 = $procedimiento[1];
            }
            if (isset($procedimiento[2])) {
                $evolutions->procedimiento3 = $procedimiento[2];
            }
            if (isset($procedimiento[3])) {
                $evolutions->procedimiento4 = $procedimiento[3];
            }
            $evolutions->via_enteral = $ve;
            $evolutions->vfc = $vfc;
            $evolutions->cfv = $cfv;
            $evolutions->save();

            $idEvolutions = $evolutions->id;
            $idPatients = $patients->id;

            $newRegister = new Register;
            $newRegister->profesional = $profesional;
            $newRegister->evolutions_id = $idEvolutions;
            $newRegister->patient_id = $idPatients;
            $newRegister->save();

            $idNewRegister = $newRegister->id;
             
            for ($i=0; $i < count($dfi); $i++) { 
                $newAntecedent = new Antecedents;
                $newAntecedent->dgflgoing = $dfi[$i];
                $newAntecedent->severidad = (integer)$si[$i];
                $newAntecedent->escala = $ei[$i];
                $newAntecedent->register_id = $idNewRegister;
                $newAntecedent->save();
            }


            for ($i=0; $i < count($dfe); $i++) { 
                $newExpenses = new Expenses;
                $newExpenses->dgflgoeg = $dfe[$i];
                $newExpenses->severidad = (integer)$se[$i];
                $newExpenses->escala = $ee[$i];
                $newExpenses->register_id = $idNewRegister;
                $newExpenses->save();
            }

            if ($alta) {     
                $newHigh = new High_medical;
                $newHigh->fecha_alta_flgo = $fecha_alta;
                $newHigh->via_enteral = $vea;
                $newHigh->derivacion = $derivacion;
                $newHigh->register_id = $idNewRegister;
                $newHigh->save();
            }

            return response()->json([
                'validacion' => true,
                'message' => 'El paciente se guardó correctamente'
            ]);
        }
    }
}
