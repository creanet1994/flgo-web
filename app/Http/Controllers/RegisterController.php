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
use stdClass;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\RegisterImport;

class RegisterController extends Controller
{
    public function index()
    {

        $registroJSON = [];
        $registros = new stdClass;
        $registros = Register::all();

        foreach($registros as $registro){

            $object = new stdClass;

            $datoPaciente = Patient::where('id',$registro->patient_id)->first();
            $antecedentesVisita = Antecedents::where('register_id',$registro->id)->get();
            $evolucionVisita = Flgo_evolution::where('id',$registro->evolutions_id)->first();
            $egresoVisita = Expenses::where('register_id',$registro->id)->get();
            $highMedical = High_medical::where('register_id',$registro->id)->get();

            $object->registroVisita = $registro;
            $object->datoPaciente = $datoPaciente;
            $object->antecedentesVisita = $antecedentesVisita;
            $object->evolucionVisita = $evolucionVisita;
            $object->egresoVisita = $egresoVisita;
            $object->highMedical = $highMedical;

            $registroJSON[] = $object;
        }

        return response()->json($registroJSON);           
    }


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

    function rut( $rut ) {
        return number_format( substr ( $rut, 0 , -1 ) , 0, "", ".") . '-' . substr ( $rut, strlen($rut) -1 , 1 );
    }

    public function importarDatos(Request $request){

        //Excel::import(new PersonasImport, $request->file('file'));

        $collection = Excel::toCollection(new RegisterImport, $request->file('file'));

        $contadorAntecedente = [13,16,19,22];
        $contadorEgreso = [34,37,40,43];


        $dfi=[13,16,19,22];
        $si=[14,17,20,23];
        $ei=[15,18,21,24];

        $dfe=[34,37,40,43];
        $se=[35,38,41,44];
        $ee=[36,39,42,45];

        foreach($collection[0] as $dato){

            if($dato[0]>=1){

                //$rut = (integer)($dato[2].'-'.$dato[3]);
                $rut = number_format( (integer)$dato[3], 0, "", ".") . '-' . $dato[4];
                //$rut = number_format( substr ( $rut, 0 , -1 ) , 0, "", ".") . '-' . substr ( $rut, strlen($rut) -1 , 1 );

                $patient = Patient::where('rut', $rut)->first();

                $newDate = date("Y/m/d", strtotime($dato[9]));

                if (isset($patient)) {

                    $idPatients = $patient->id;

                }else{

                    $patients = new Patient;
                    $patients->name = $dato[5];
                    $patients->rut = $rut;
                    $patients->age = (integer)$dato[6];
                    $patients->grupo_sangre = $dato[8];
                    $patients->sexo = $dato[7];
                    $patients->procedencia = $dato[10];
                    $patients->tqt = $dato[12];
                    $patients->dgcoIngreso = $dato[11];
                    $patients->fechaIngreso = $newDate;
                    $patients->save();

                    $idPatients = $patients->id;
                }

                /* Registro de evolución */
                $evolutions = new Flgo_evolution;
                if (isset($dato[30])){$evolutions->manejo_flgo1 = $dato[31];}
                if (isset($dato[31])){$evolutions->manejo_flgo2 = $dato[32];}
                if (isset($dato[32])){$evolutions->manejo_flgo3 = $dato[33];}
                if (isset($dato[24])){$evolutions->procedimiento1 = $dato[25];}
                if (isset($dato[25])){$evolutions->procedimiento2 = $dato[26];}
                if (isset($dato[26])){$evolutions->procedimiento3 = $dato[27];}
                $evolutions->via_enteral = $dato[28];
                $evolutions->vfc = $dato[29];
                $evolutions->cfv = $dato[30];
                $evolutions->save();

                $idEvolutions = $evolutions->id;

                $newDate = date("Y/m/d", strtotime($dato[1]));

                $newRegister = new Register;
                $newRegister->profesional = $dato[2];
                $newRegister->evolutions_id = $idEvolutions;
                $newRegister->patient_id = $idPatients;
                $newRegister->fecha_registro = $newDate;
                $newRegister->save();

                $idNewRegister = $newRegister->id;

                for ($i=0; $i < 4; $i++) {
                    if ((strlen($dato[$dfi[$i]])>0)||($dato[$si[$i]]>0)||(strlen($dato[$ei[$i]])>0)) {
                        $newAntecedent = new Antecedents;
                        $newAntecedent->dgflgoing = $dato[$dfi[$i]];
                        if ($dato[$si[$i]]==0) {
                            $dato[$si[$i]]=null;
                        }
                        $newAntecedent->severidad = $dato[$si[$i]];
                        $newAntecedent->escala = $dato[$ei[$i]];
                        $newAntecedent->register_id = $idNewRegister;
                        $newAntecedent->save();
                    }
                }

                for ($i=0; $i < 4; $i++) {
                    if ((strlen($dato[$dfe[$i]])>0)||($dato[$se[$i]]>0)||(strlen($dato[$ee[$i]])>0)) {
                        $newExpenses = new Expenses;
                        $newExpenses->dgflgoeg = $dato[$dfe[$i]];

                        if ($dato[$se[$i]]==0) {
                            $dato[$se[$i]]=null;
                        }
                        $newExpenses->severidad =$dato[$se[$i]];
                        $newExpenses->escala = $dato[$ee[$i]];
                        $newExpenses->register_id = $idNewRegister;
                        $newExpenses->save();
                    }
                }

                $fecha_actual = strtotime(date($dato[46],time()));

                $fecha_entrada = strtotime("01-01-1970 00:00:00");

                $newDate = date("Y-m-d", strtotime($dato[46]));
                
                if ($fecha_actual> $fecha_entrada) {
                    
                    $newHigh = new High_medical;
                    $newHigh->fecha_alta_flgo = $newDate;
                    $newHigh->via_enteral = $dato[47];
                    $newHigh->derivacion = $dato[48];
                    $newHigh->register_id = $idNewRegister;
                    $newHigh->save();
                }

            }
        }
        
        return response()->json([
            'validacion' => true,
            'mensaje' => 'Los registros se han agregado correctamente'
        ]);
    }
}


