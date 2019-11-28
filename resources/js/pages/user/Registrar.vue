<template>
	<div ref="formContainer">
      	<md-toolbar md-elevation="1" style="background-color: #fff" >
        	<h6 class="md-title" style="flex: 1; color: #001A48;">
          		<hospital-box-icon/>
          		<b>Registro de pacientes fonoaudiologicos</b>
        	</h6>
        			  			
    		<router-link to = "/dashboard">
				<md-button >
  				    <b>{{profesional}}</b>
        		</md-button>
  			</router-link>

      	</md-toolbar>

		<div class="container col-12 d-flex justify-content-center">

			<div novalidate  class="col-12">

	<!-- --------------------------------    DAtos del paciente    ------------------------------------- -->

				<div class="col-12 form-row divHov">

				    <div class="form-group col-12 col-sm-6 col-md-3">
					    <md-field :class="{ 'md-invalid': inputRutActive }" >
					    	<md-icon>how_to_reg</md-icon>
					      	<label for="inputRut">Rut</label>
					      	<md-input @change="validateRut()" v-model="inputRut"></md-input>
					      	<span class="md-error" v-if="inputRutActive">{{msjErrorRut}}</span>
					      	<span class="md-helper-text">Rut sin puntos ni dígito verificador</span>
					    </md-field>
				    </div>

				    <div class="form-group col-12 col-sm-6 col-md-3" >
			            <md-field  :class="{ 'md-invalid': inputNameActive }">
			              	<md-icon>perm_identity</md-icon>
			                <label for="inputName">Nombres</label>
			                <md-input @change="validate('Nombres')" v-model="inputName"/>
			                <span class="md-error" v-if="inputNameActive">{{msjErrorName}}</span>
			                <span class="md-helper-text">Primer nombre y dos apellidos</span>
			            </md-field>
				    </div>

				    <div class="form-group col-12 col-sm-6 col-md-3">
			            <md-field :class="{ 'md-invalid': inputProcedenciaActive }">
			              	<md-icon>local_convenience_store</md-icon>
			                <label for="inputProcedencia">Procedencia</label>
			                <md-input @change="validate('Procedencia')" v-model="inputProcedencia"/>
			                <span class="md-error" v-if="inputProcedenciaActive">{{msjErrorProcedencia}}</span>
			            </md-field>
				    </div>

				    <div class="form-group col-12 col-sm-6 col-md-3">
					    <md-datepicker :class="{ 'md-invalid': fechaIngresoActive }" 
					    name="fechaIngreso" 
					    id="fechaIngreso" 
					    v-model="fechaIngreso"
					    @click="validate('fechaIngreso')" md-immediately>
					      <label for="fechaIngreso" >Fecha de ingreso</label>
					      <span class="md-helper-text">Ingreso de paciente</span>
					      <span class="md-error" v-if="fechaIngreso">{{msjErrorFechaIngreso}}</span>
					    </md-datepicker>
				    </div>

				    <div class="form-group col-6 col-sm-4 col-md-2">
			            <md-field :class="{ 'md-invalid': ageActive }">
			            	<md-icon>account_circle</md-icon>
			                <label for="age">Edad</label>
			                <md-input @change="validate('Edad')" min="0" type="number" id="age" name="age" autocomplete="age" v-model="age"/>
			            	<span class="md-error" v-if="ageActive">{{msjErrorAge}}</span>
			            </md-field>
				    </div>

				    <div class="form-group col-6 col-sm-4 col-md-2">
				        <md-field :class="{ 'md-invalid': inputGSActive }">
				          	<label for="inputGS">Grupo de sangre</label>
				          	<md-select @click="validate('inputGS')" v-model="inputGS" name="inputGS" id="inputGS">
				          		<md-option v-for="(item, index) in grupo" :key="index" :value="item.value">
				          			{{item.label}}
				          		</md-option>
				          	</md-select>
				          	<span class="md-error" v-if="inputGSActive">{{msjErrorGS}}</span>
				        </md-field>
				    </div>

				    <div class="form-group col-12 col-sm-4 col-md-2">
				        <md-field :class="{ 'md-invalid': inputSexoActive }">
				          	<label for="sexo">Sexo</label>
				          	<md-select @click="validate('Sexo')" v-model="inputSexo" name="sexo" id="sexo">
				          		<md-option class="ml-2" v-for="(item, index) in sexo" :key="index" :value="item.value">
				          			{{item.label}}
				          		</md-option>
				          	</md-select>
				          	<span class="md-error" v-if="inputSexoActive">{{msjErrorSexo}}</span>
				        </md-field>
				    </div>

				    <div class="form-group col-12 col-sm-6 col-md-3">
			            <md-field  :class="{ 'md-invalid': inputTqtActive }">
				          	<label for="inputTqt">Usuario con traqueosotomia</label>
				          	<md-select @click="validate('inputTqt')" v-model="inputTqt" name="inputTqt" id="inputTqt">
				          		<md-option  v-for="(item, index) in sino" :key="index" :value="item.value">
				          			{{item.label}}
				          		</md-option>
				          	</md-select>
				          	<span class="md-error" v-if="inputTqtActive">{{msjErrorTqt}}</span>
			            </md-field>
				    </div>

				    <div class="form-group col-12 col-sm-6 col-md-3" >
			            <md-field :class="{ 'md-invalid': inputDIActive }">
			              	<md-icon>local_hospital</md-icon>
			                <label for="inputDI">Diagnostico de ingreso</label>
			                <md-input  @change="validate('inputDI')" name="inputDI" id="inputDI" v-model="inputDI"/>
			                <span class="md-helper-text">Referente a fonoaudiología</span>
			                <span class="md-error" v-if="inputDIActive">{{msjErrorDi}}</span>
			            </md-field>
				    </div>

				    <div class="col-12 d-flex justify-content-end">
				    	<small class="md-helper-text">Ingrese primero el rut para buscar en nuestros registros</small>
				    </div>

			  	</div>

	<!-- --------------------------------    Antecedentes Fonoaudiologica    ------------------------------------- -->


			  	<div class="col-12 form-row mt-2 divHov">
		  			
		  			<div class="form-row  d-flex justify-content-between col-12 ">
		  				<div class="col-sm-6 ml-4 titulo" >
		  					<h5>Antecedentes fonoaudiologicos de ingreso</h5>
		  				</div>

			  			<button v-if="antecedentes.length>1" @click="quitarAntecedente()" type="button" class=" text-center m-2 col-5 col-sm-2 btn2">
			  				<i class="el-icon-minus icon1"></i> Quitar antecedente
			  			</button> 

			  			<button @click="agregarAntecedente()"  type="button" class="text-center m-2 col-5 col-sm-2 btn1">
			  				<i class="el-icon-plus icon1"></i> Agregar antecedente
			  			</button>
		  			</div>


			  		<div v-for="(item,index) in antecedentes" class="mt-2 form-row col-12">

				  		<div class="col-12 col-sm-4">
			              	<md-field :class="{ 'md-invalid': inputDfiActive[index] }">
			              		<md-icon>local_hospital</md-icon>
			                	<label for="inputDfi">Diagnostico fonoaudiologico ingreso</label>
			                	<md-input @click="validate('inputDfi')" name="inputDfi" id="inputDfi" v-model="inputDfi[index]"/>
			                	<span class="md-helper-text">Dato obligatorio</span>
			                	<span class="md-error" v-if="inputDfiActive[index]">{{msjErrorDfi[index]}}</span>
			              	</md-field>
				  		</div>

				  		<div class="col-12 col-sm-4">

				            <md-field :class="{ 'md-invalid': severidadIngresoActive[index] }" >
				                <label for="severidadIngreso">Severidad</label>
				                <md-select @click="validate('severidadIngreso')" name="severidadIngreso" id="severidadIngreso" v-model="severidadIngreso[index]" md-dense>
				                  	<md-option v-for="(item, index) in severidades" :key="index" :value="item.value" >{{item.label}}</md-option>
				                </md-select>
			                	<span class="md-helper-text">Dato obligatorio</span>
			                	<span class="md-error" v-if="severidadIngresoActive[index]">{{msjErrorSi[index]}}</span>
				             </md-field>
				  		</div>

				  		<div class="col-12 col-sm-4">
				            <md-field :class="{ 'md-invalid': escalaIngresoActive[index] }">
				                <label for="escalaIngreso">Escala</label>
				                <md-select @click="validate('escalaIngreso')" name="escalaIngreso" id="escalaIngreso" v-model="escalaIngreso[index]" md-dense>
				                  	<md-option v-for="(item, index) in escalas" :key="index" :value="item.value" >{{item.label}}</md-option>
				                </md-select>
			                	<span class="md-helper-text">Dato obligatorio</span>
			                	<span class="md-error" v-if="escalaIngresoActive[index]">{{msjErrorEi[index]}}</span>
				             </md-field>
				  		</div>

			  		</div>

			  		<div class="col-12 text-center" v-if="antecedentesMax">
			  			<small class=" text-danger"><b>{{msjMensaje3}}</b></small>
			  		</div>

				</div>


	<!-- --------------------------------    Evolución Fonoaudiologica    ------------------------------------- -->



			  	<div class="col-12 form-row mt-2 divHov">
		  			
		  			<div class="form-row  d-flex justify-content-start col-12 ">
		  				<div class="col-sm-6 ml-4 titulo" >
		  					<h5>Evolución fonoaudiologica</h5>
		  				</div>
		  			</div>

			  		<div class=" form-row col-12">

				  		<div class="col-12 col-sm-4">
				            <md-field :class="{ 'md-invalid': inputCfvActibe }">
					          	<label for="inputCfv">Cuidado fin de vida</label>
					          	<md-select @click="validate('inputCfv')" v-model="inputCfv" name="inputCfv" id="inputCfv">
					          		<md-option v-for="(item, index) in sino" :key="index" :value="item.value">
					          			{{item.label}}
					          		</md-option>
					          	</md-select>
					          	<span class="md-helper-text">Dato obligatorio</span>
			                	<span class="md-error" v-if="inputCfvActibe">{{msjErrorCfv}}</span>
				            </md-field>
				  		</div>

				  		<div class="col-12 col-sm-4">
				  			<md-field :class="{ 'md-invalid': inputVeActive }">
				          		<label for="inputVe">Via enteral</label>
					          	<md-select @click="validate('inputVe')" v-model="inputVe" name="inputVe" id="inputVe">
					          		<md-option v-for="(item, index) in sino" :key="index" :value="item.value">
					          			{{item.label}}
					          		</md-option>
					          	</md-select>
					          	<span class="md-helper-text">Dato obligatorio</span>
			                	<span class="md-error" v-if="inputVeActive">{{msjErrorVe}}</span>
				            </md-field>
				  		</div>

				  		<div class="col-12 col-sm-4">
				  			<md-field >
					        	<label for="inputVfc">Videofluoroscopía</label>
					          	<md-select v-model="inputVfc" name="inputVfc" id="inputVfc">
					          		<md-option v-for="(item, index) in sino" :key="index" :value="item.value">
					          			{{item.label}}
					          		</md-option>
					          	</md-select>
				            </md-field>
				  		</div>

			  		</div>


		  			<div class="form-row  d-flex justify-content-between col-12">

		  				<div class="col-sm-6 ml-4 titulo" >
		  					<h6>Añadir manejos fonoaudiologicos</h6>
		  				</div>
			  			
			  			<button v-if="itemManejo.length>1" @click="quitarManejoFlgo()" type="button" class="text-center m-2 col-5 col-sm-2 btn2">
			  				<i class="el-icon-minus icon1"></i> Quitar manejo
			  			</button>

			  			<button @click="agregarManejoFlgo()" type="button" class="text-center m-2 col-5 col-sm-2 btn1">
			  				<i class="el-icon-plus icon1"></i> Agregar manejo
			  			</button>

		  			</div>


			  		<div class="col-6 col-sm-3" v-for="(item, index) in itemManejo">
			            <md-field :class="{ 'md-invalid': inputManejoActive[index] }">
			                <label for="inputManejo">Manejo fonoaudiologico</label>
			                <md-select @click="validate('inputManejo')" name="inputManejo" id="inputManejo" v-model="inputManejo[index]" md-dense>
			                  	<md-option v-for="(item, index) in manejos" :key="index" :value="item.value" >{{item.label}}</md-option>
			                </md-select>
			                <span class="md-helper-text">Dato obligatorio</span>
			                <span class="md-error" v-if="inputManejoActive[index]">{{msjErrorManejo[index]}}</span>
			             </md-field>
			  		</div>

			  		<div class="col-12 text-center" v-if="manejoMax">
			  			<small class=" text-danger"><b>{{msjMensaje1}}</b></small>
			  		</div>



		  			<div class="form-row  d-flex justify-content-between col-12">
		  				<div class="col-sm-6 ml-4 titulo" >
		  					<h6>Añadir procedimientos fonoaudiologicos</h6>
		  				</div>
			  			<button v-if="itemProcedimiento.length>1" @click="quitarProcedimiento()" type="button" class="text-center m-2 col-5 col-sm-2 btn2">
			  				<i class="el-icon-minus icon1"></i> Quitar procedimiento
			  			</button>

			  			<button @click="agregarProcedimiento()" type="button" class="text-center m-2 col-5 col-sm-2 btn1">
			  				<i class="el-icon-plus icon1"></i> Agregar procedimiento
			  			</button>

		  			</div>

			  		<div class="col-6 col-sm-3 mb-3" v-for="(item,index) in itemProcedimiento">
			            <md-field :class="{ 'md-invalid': inputProcedimientoActive[index] }" >
			                <label for="inputProcedimiento">Procedimiento fonoaudiologico</label>
			                <md-select @click="validate('inputProcedimiento')"  name="inputProcedimiento" id="inputProcedimiento" v-model="inputProcedimiento[index]" md-dense>
			                  	<md-option v-for="(item, index) in procedimientos" :key="index" :value="item.value" >{{item.label}}</md-option>
			                </md-select>
			                <span class="md-helper-text">Dato obligatorio</span>
			                <span class="md-error" v-if="inputProcedimientoActive[index]">{{msjErrorProcedimiento[index]}}</span>
			             </md-field>
			  		</div>

			  		<div class="col-12 text-center" v-if="procedimientoMax">
			  			<small class=" text-danger"><b>{{msjMensaje2}}</b></small>
			  		</div>

				</div>


	<!-- --------------------------------    Egreso Fonoaudiologico    ------------------------------------- -->

			  	<div class="col-12 form-row mt-2 divHov">
		  			
		  			<div class="form-row  d-flex justify-content-between col-12 ">
		  				<div class="col-sm-6 ml-4 titulo" >
		  					<h4>Egreso fonoaudiologico</h4>
		  				</div>

			  			<button v-if="antecedentesEgreso.length>1" @click="quitarAntecedenteEgreso()" type="button" class=" text-center m-2 col-5 col-sm-2 btn2">
			  				<i class="el-icon-minus icon1"></i> Antecedente egreso
			  			</button> 

			  			<button @click="agregarAntecedenteEgreso()"  type="button" class="text-center m-2 col-5 col-sm-2 btn1">
			  				<i class="el-icon-plus icon1"></i> Antecedente egreso
			  			</button>
		  			</div>


			  		<div v-for="(item,index) in antecedentesEgreso" :key="index" class="mt-2 form-row col-12">

				  		<div class="col-12 col-sm-4">
			              	<md-field>
			              		<md-icon>local_hospital</md-icon>
			                	<label for="inputDfe">Diagnostico fonoaudiologico egreso</label>
			                	<md-input v-model="inputDfe[index]"/>
			              	</md-field>
				  		</div>

				  		<div class="col-12 col-sm-4">

				            <md-field >
				                <label for="severidadEgreso">Severidad</label>
				                <md-select name="severidadEgreso" id="severidadEgreso" v-model="severidadEgreso[index]" md-dense>
				                  	<md-option v-for="(item, index) in severidades" :key="index" :value="item.value" >{{item.label}}</md-option>
				                </md-select>
				             </md-field>
				  		</div>

				  		<div class="col-12 col-sm-4">
				            <md-field >
				                <label for="escalaEgreso">Escala</label>
				                <md-select name="escalaEgreso" id="escalaEgreso" v-model="escalaEgreso[index]" md-dense>
				                  	<md-option v-for="(item, index) in escalas" :key="index" :value="item.value" >{{item.label}}</md-option>
				                </md-select>
				             </md-field>
				  		</div>

			  		</div>


			  		<div class="col-12 text-center" v-if="antecedentesEgresoMax">
			  			<small class=" text-danger"><b>{{msjMensaje4}}</b></small>
			  		</div>

				</div>

	<!-- --------------------------------     Alta Fonoaudiologico     ------------------------------------- -->

			  	<div class="col-12 form-row mt-2 divHov">
		  			
		  			<div class="form-row  d-flex justify-content-start col-12 ">
		  				<div class="col-sm-6 ml-4 titulo" >
		  					<h4>Alta fonoaudiologica</h4>
		  				</div>
		  				
		  			</div>
			  		
			  		<div class="form-row col-12">

				  		<div class="col-12 col-sm-4" style="color: black">
						    <md-datepicker v-model="fechaAlta" md-immediately>
						      <label>Fecha de alta fonoaudiologica</label>
						    </md-datepicker>
				  		</div>

				  		<div class="col-12 col-sm-4">
			              <md-field>
			          		<label for="inputVe">Via enteral</label>
				          	<md-select v-model="viaEnteralAlta" name="viaEnteralAlta" id="viaEnteralAlta">
				          		<md-option v-for="(item, index) in sino" :key="index" :value="item.value">
				          			{{item.label}}
				          		</md-option>
				          	</md-select>
			              </md-field>
				  		</div>

				  		<div class="col-12 col-sm-4">
			              <md-field>
			              	<md-icon>call_split</md-icon>
			                <label for="derivacion">Derivación</label>
			                <md-input v-model="derivacion"/>
			              </md-field>
				  		</div>
			  		</div>

				</div>

	<!-- --------------------------------       Enviar registro        ------------------------------------- -->

			  	<div class="d-flex justify-content-between col-12 form-row mt-2 divHov"> 
		  			<router-link to = "/dashboard" class=" text-center m-4 col-4 col-sm-3 btnRegister2">
		  				<i class="el-icon-back" ></i>
		  				<a style="text-decoration: none;"><b>  Volver</b></a>
		  			</router-link>

		  			<button @click="agregarRegistro()" class=" text-center m-4 col-4 col-sm-3 btnRegister1">
		  				Registrar
		  			</button> 
			  	</div>
			</div>	
		</div>
		<el-footer>Pie de página</el-footer>
	</div>

</template>

<script type="text/javascript">

  	import Vue from 'vue'
  	import HospitalBoxIcon from 'vue-material-design-icons/HospitalBox.vue';
	import { MdButton, MdContent, MdTabs } from 'vue-material/dist/components'
	import 'vue-material/dist/vue-material.min.css'
	import 'vue-material/dist/theme/default.css'
	import { mapActions, mapState, mapMutations } from 'vuex';
    import parse from 'date-fns/parse'; 
	import format from 'date-fns/format';
	import isValid from 'date-fns/isValid';


	Vue.use(MdButton)
	Vue.use(MdContent)
	Vue.use(MdTabs)

	export default {

    	components: {
      		HospitalBoxIcon,
    	},

    	computed: mapState(['profesional']),

		data(){

			return{

		// -------------------------------- INPUT DE OPCIONES ------------------------------------

                grupo: [

                    {label: 'A', value: 'A'},
                    {label: 'B',value: 'B'},
                    {label: 'C', value: 'C'},
                    {label: 'D',value: 'D'}
                ],

                sexo: [

                    {label: 'Femenino', value: 'F'},
                    {label: 'Masculino',value: 'M'}
                ],

                sino: [

                    {label: 'Sí', value: 'si'},
                    {label: 'No', value: 'no'}
                ],

                manejos: [

                    {label: 'COMPENSATORIO', value: 'COMPENSATORIO'},
                    {label: 'REACTIVADOR', value: 'REACTIVADOR'},
                    {label: 'TERAPIA DE LENGUAJE', value: 'TERAPIA DE LENGUAJE'},
                    {label: 'TERAPIA DE HABLA', value: 'TERAPIA DE HABLA'},
                    {label: 'TERAPIA DE VOZ', value: 'TERAPIA DE VOZ'},
                    {label: 'ESTIMULACIÓN COGNITIVA', value: 'ESTIMULACIÓN COGNITIVA'}

                ],

                procedimientos: [

                	{label: 'EDUCACIÓN', value: 'EDUCACIÓN'},
                	{label: 'PREVENCIÓN', value: 'PREVENCIÓN'},
                	{label: 'EVALUACION', value: 'EVALUACION'},
                	{label: 'INTERVENCION', value: 'INTERVENCION'},
                	{label: 'REEVALUACION', value: 'REEVALUACION'},
                	{label: 'FACILITACION', value: 'FACILITACION'},
	            ],

	            severidades: [

	            	{label: '1', value: 1},
	            	{label: '2', value: 2},
	            	{label: '3', value: 3},
	            	{label: '4', value: 4},
	            	{label: '5', value: 5},
	            	{label: '6', value: 6},
	            	{label: '7', value: 7},
	            	{label: '8', value: 8},
	            	{label: '9', value: 9},
	            	{label: '10', value: 10}

	            ],

	            escalas: [

	            	{label: 'FILS', value: 'FILS'},
	            	{label: 'FOIS', value: 'FOIS'},
	            	{label: 'DUFFY', value: 'DUFFY'},
	            	{label: 'ASHA NOMS', value: 'ASHA NOMS'},
	            ],

	            
	    // -------------------------------- VARIABLES PARA VISTAS DINAMICAS ------------------------------------

				itemManejo:[1],
				manejoMax: false,
				msjMensaje1:"",

				itemProcedimiento:[1],
				procedimientoMax: false,
				msjMensaje2:"",

				antecedentes:[1],
				antecedentesMax: false,
				msjMensaje3:"",
				antecedentesIngresoDatos:[],

				antecedentesEgreso:[1],
				antecedentesEgresoMax: false,
				msjMensaje4:"",
				antecedentesEgresoDatos:[],

		// -------------- Datos validadores --------------------------
				inputRutActive:false,
				msjErrorRut:null,

				inputNameActive:false,
				msjErrorName:null,

				inputProcedenciaActive: false,
				msjErrorProcedencia:null,

				fechaIngresoActive:false,
				msjErrorFechaIngreso:null,

				ageActive:false,
				msjErrorAge:null,

				inputGSActive:false,
				msjErrorGS:null,

				inputSexoActive:false,
				msjErrorSexo:null,

				inputTqtActive:false,
				msjErrorTqt:null,

				inputDIActive:false,
				msjErrorDi:null,

				inputDfiActive:[],
				msjErrorDfi:[],

				severidadIngresoActive:[],
				msjErrorSi:[],

				escalaIngresoActive:[],
				msjErrorEi:[],


				inputCfvActibe:false,
				msjErrorCfv:null,

				inputVeActive:false,
				msjErrorVe:null,

				inputVfcActive:false,
				msjErrorVfc:null,

				inputManejoActive:[],
				msjErrorManejo:[],

				inputProcedimientoActive:[],
				msjErrorProcedimiento:[],

				inputSalida:[],

		// -------------- Datos del paciente --------------------------

				inputRut:null,
				inputName:null,
				inputProcedencia: null,
				fechaIngreso:format(new Date(), 'yyyy-MM-dd'),
				age:null,
				inputGS:null,
				inputSexo:null,
				inputTqt:null,
				inputDI:null,

		// -------------- Antecedentes fonoaudiologico ----------------

				inputDfi:[],
				severidadIngreso:[],
				escalaIngreso:[],

		// -------------- Evolución fonoaudiologico -------------------
				inputCfv:null,
				inputVe:null,
				inputVfc:null,
				inputManejo:[],
				inputProcedimiento:[],

		// -------------- Egreso fonoaudiologico ----------------------

				inputDfe:[],
				severidadEgreso:[],
				escalaEgreso:[],

		// -------------- Alta fonoaudiologica ------------------------
				fechaAlta:null,
				viaEnteralAlta: null,
				derivacion: null,

		//-------------------------------------------------------------

				rutExist:false,
				idPatient:null,

			};
		},

		beforeMount(){
			this.getUser()
		},

// ******************************************* CICLO DE VIDA **********************************************

		mounted(){		

			

		},

// ******************************************* FUNCIONES ************************************************

		methods:{

			...mapMutations(['agregarNombre']),
			...mapActions(['getUser']),

			validate(campo){
				switch (campo) {
					case 'Nombres':

						var nombre = this.inputName.trim();
						if((nombre.length<=3)&&(nombre.length>=1)){
							this.inputNameActive = true;
							this.msjErrorName= 'El nombre debe ser mayor a 3 caracteres.'
						}else{
							this.inputNameActive = false;
						}
					    break;

					case 'Procedencia':
						this.inputProcedenciaActive = false;
					    break;

					case 'fechaIngreso':
						this.fechaIngresoActive = false;
					    break;

					case 'Edad':
						this.ageActive = false;
					  	break;

					case 'inputGS':
						this.inputGSActive = false;
					  	break;

					case 'Sexo':
						this.inputSexoActive = false;
					  	break;

					case 'inputTqt':
						this.inputTqtActive = false;
					  	break;

					case 'inputDI':
						this.inputDIActive = false;
					  	break;


					case 'inputDfi':
						this.inputDfiActive[0] = false;
					  	break;

					case 'severidadIngreso':
						this.severidadIngresoActive[0] = false;
					  	break;

					case 'escalaIngreso':
						this.escalaIngresoActive[0] = false;
					  	break;


					case 'inputCfv':
						this.inputCfvActibe = false;
					  	break;

					case 'inputVe':
						this.inputVeActive = false;
					  	break;

					case 'inputVfc':
						this.inputVfcActive = false;
					  	break;

					case 'inputManejo':
						this.inputManejoActive[0] = false;
					  	break;

					case 'inputProcedimiento':
						this.inputProcedimientoActive[0] = false;
					  	break;		  						  	
				}

			},

			agregarManejoFlgo(){
				if ((this.itemManejo.length+1)<=4) {
					this.itemManejo.push(1);
					this.manejoMax = false;
				}else{
					this.msjMensaje1 ='El maximo de manejos fonoaudiologicos permitidos es de cuatro.'
					this.manejoMax = true;
				}
			},

			quitarManejoFlgo(){

				if ((this.itemManejo.length-1)>=1) {
					this.itemManejo.pop();
					this.manejoMax = false;
				}else{
					this.msjMensaje1 ='Debe existir al menos un manejo fonoaudiologico para este registro.'
					this.manejoMax = true;
				}
			},

			agregarProcedimiento(){

				if ((this.itemProcedimiento.length+1)<=4) {
					this.itemProcedimiento.push(1);
					this.procedimientoMax = false;
				}else{
					this.msjMensaje2 ='El máximo de procedimientos fonoaudiologicos permitidos es de cuatro.'
					this.procedimientoMax = true;
				}
				console.log(this.itemProcedimiento.length);
			},

			quitarProcedimiento(){
				if ((this.itemProcedimiento.length-1)>=1) {
					this.itemProcedimiento.pop();
					this.procedimientoMax = false;
				}else{
					this.msjMensaje2 ='Debe existir al menos un procedimiento fonoaudiologico para este registro.'
					this.procedimientoMax = true;
				}

				console.log(this.itemProcedimiento.length);
			},

			agregarAntecedente(){
				if ((this.antecedentes.length+1)<=4) {
					this.antecedentes.push(1);
					this.antecedentesMax = false;
				}else{
					this.msjMensaje3 ='El maximo de antecedentes fonoaudiologicos permitidos es de cuatro.'
					this.antecedentesMax = true;
				}
			},

			quitarAntecedente(){
				if ((this.antecedentes.length-1)>=1) {
					this.antecedentes.pop();
					this.antecedentesMax = false;
				}else{
					this.msjMensaje3 ='Debe existir al menos un antecedente fonoaudiologico para este registro.'
					this.antecedentesMax = true;
				}
			},

			agregarAntecedenteEgreso(){
				if ((this.antecedentesEgreso.length+1)<=4) {
					this.antecedentesEgreso.push(1);
					this.antecedentesEgresoMax = false;
				}else{
					this.msjMensaje4 ='El maximo de antecedentes de egresos fonoaudiologicos permitidos es de cuatro.'
					this.antecedentesEgresoMax = true;
				}
			},

			quitarAntecedenteEgreso(){
				if ((this.antecedentesEgreso.length-1)>=1) {
					this.antecedentesEgreso.pop();
					this.antecedentesEgresoMax = false;
				}else{
					this.msjMensaje4 ='Debe existir al menos un antecedente de egreso fonoaudiologico para este registro.'
					this.antecedentesEgresoMax = true;
				}
			},

// ************************* Funciones de validación **************************************
			validateRut(){
				console.log(this.inputRut)
				var rut = this.inputRut.trim();
				if((rut.length===7)||(rut.length===8)){

					this.inputRutActive = false;
					var T = this.inputRut;
					var M=0,S=1;
					for(;T;T=Math.floor(T/10)){
					  	S=(S+T%10*(9-M++%6))%11;
					}
					var dv = S?S-1:'k';
					var rut =  this.inputRut + dv;
					this.formateoRut(rut);

				}else if (rut.length===0) {
					alert('Aqui');
					this.inputRutActive = false;
				}else{
					//alert('Aqu222i');
					this.inputRut = null
					this.inputRutActive = true;
					this.msjErrorRut = 'El rut debe contener 7 u 8 dígitos'
				}
			},

			formateoRut(rut){

				let value = rut.replace(/\./g, '').replace('-', '');
				var inp;
				if (value.match(/^(\d{2})(\d{3}){2}(\w{1})$/)) {
				    value = value.replace(/^(\d{2})(\d{3})(\d{3})(\w{1})$/, '$1.$2.$3-$4');
				}else if (value.match(/^(\d)(\d{3}){2}(\w{0,1})$/)) {
				    value = value.replace(/^(\d)(\d{3})(\d{3})(\w{0,1})$/, '$1.$2.$3-$4');
				}else if (value.match(/^(\d)(\d{3})(\d{0,2})$/)) {
				    value = value.replace(/^(\d)(\d{3})(\d{0,2})$/, '$1.$2.$3');
				}else if (value.match(/^(\d)(\d{0,2})$/)) {
				    value = value.replace(/^(\d)(\d{0,2})$/, '$1.$2');
				}

				this.inputRut = value;
				this.buscarInfoRut(this.inputRut);
			},

// ************************* Buscar info de rut **************************************
			
			buscarInfoRut(rut){
                let loader = Vue.$loading.show({
                    // Optional parameters
                    container: this.$refs.formContainer,
                    canCancel: true,
                    onCancel: this.onCancel,
                    color: '#19493F',
                });

				axios.get('/auth/registro/inforut', {
				    params: {
				      rut: rut
				    }
				}).then(response => {
					
					if (response.data.validacion){
						this.rutExist = true;
						this.formateoInputs(response.data.data, response.data.evolucion, response.data.antecedente, response.data.egresos, response.data.altaMedica)
					}else{
						this.rutExist = false;
					}
					
					loader.hide();
				}).catch(e => {
				    console.log(e);
				})
			},

			formateoInputs(data, evolucion, antecedentes, egresos, altaMedica){
				console.log('Este es el data: ', data)
				
				this.inputName=data.name;
				this.inputProcedencia=data.procedencia;
				this.fechaIngreso= format(new Date(data.fechaIngreso), 'yyyy-MM-dd');
				this.age=data.age;
				this.inputGS=data.grupo_sangre;
				this.inputSexo=data.sexo;
				this.inputTqt=data.tqt;
				this.inputDI=data.dgcoIngreso;
				this.idPatient=data.id;

				console.log('Este es el id: ', this.idPatient)

				this.antecedentes = [];
				for (var i = 0; i < antecedentes.length; i++){
					this.inputDfi[i]=antecedentes[i].dgflgoing;
					this.severidadIngreso[i]=antecedentes[i].severidad;
					this.escalaIngreso[i]=antecedentes[i].escala;
					this.antecedentes.push(1);
				}


				this.inputCfv=evolucion.cfv;
				this.inputVe=evolucion.via_enteral;
				this.inputVfc=evolucion.vfc;

				this.itemManejo=[];
				if (evolucion.manejo_flgo1) {this.inputManejo[0]=evolucion.manejo_flgo1;this.itemManejo.push(1);}
				if (evolucion.manejo_flgo2) {this.inputManejo[1]=evolucion.manejo_flgo2;this.itemManejo.push(1);}
				if (evolucion.manejo_flgo3) {this.inputManejo[2]=evolucion.manejo_flgo3;this.itemManejo.push(1);}
				if (evolucion.manejo_flgo4) {this.inputManejo[3]=evolucion.manejo_flgo4;this.itemManejo.push(1);}

				this.itemProcedimiento=[];
				if (evolucion.procedimiento1) {this.inputProcedimiento[0]=evolucion.procedimiento1;this.itemProcedimiento.push(1);}
				if (evolucion.procedimiento2) {this.inputProcedimiento[1]=evolucion.procedimiento2;this.itemProcedimiento.push(1);}
				if (evolucion.procedimiento3) {this.inputProcedimiento[2]=evolucion.procedimiento3;this.itemProcedimiento.push(1);}
				if (evolucion.procedimiento4) {this.inputProcedimiento[3]=evolucion.procedimiento4;this.itemProcedimiento.push(1);}
				
				if (egresos) {
					console.log('Egresos');
					this.antecedentesEgreso = [];
					for (var i = 0; i < egresos.length; i++){
						this.inputDfe[i]=egresos[i].dgflgoing;
						this.severidadEgreso[i]=egresos[i].severidad;
						this.escalaEgreso[i]=egresos[i].escala;
						this.antecedentesEgreso.push(1);
					}
				}

				if (altaMedica.length>0) {
					console.log('Alta Medica', altaMedica);
					this.fechaAlta=new Date(altaMedica.fecha_alta_flgo);
					this.viaEnteralAlta=altaMedica.via_enteral;
					this.derivacion=altaMedica.derivacion;
				}
			},
// ************************* Funciones de registro **************************************

			agregarRegistro(){

				console.log('Desde agregarRegistro')

				var error=false;
				
				if (!this.inputRut) {
					error = true;
					this.inputRutActive = true;
					this.msjErrorRut = 'El ingreso de rut es obligatorio';
				}
				if (!this.inputName) {
					error = true;
					this.inputNameActive = true;
					this.msjErrorName = 'El ingreso del nombre es obligatorio';
				}
				if (!this.inputProcedencia) {
					error = true;
					this.inputProcedenciaActive = true;
					this.msjErrorProcedencia = 'El ingreso de procedencia es obligatorio';
				}
				if (!this.fechaIngreso) {
					error = true;
					this.fechaIngresoActive = true;
					this.msjErrorFechaIngreso = 'El ingreso de fecha es obligatorio';
				}
				if (!this.age) {
					error = true;
					this.ageActive = true;
					this.msjErrorAge = 'El ingreso de la edad es obligatorio';
				}
				if (!this.inputGS) {
					error = true;
					this.inputGSActive = true;
					this.msjErrorGS = 'El ingreso del grupo de sangre es obligatorio';
				}
				if (!this.inputSexo) {
					error = true;
					this.inputSexoActive = true;
					this.msjErrorSexo = 'El ingreso del sexo es obligatorio';
				}
				if (!this.inputTqt) {
					error = true;
					this.inputTqtActive = true;
					this.msjErrorTqt = 'El ingreso de tqt es obligatorio';
				}
				if (!this.inputDI) {
					error = true;
					this.inputDIActive = true;
					this.msjErrorDi = 'El ingreso del diagnostico medico es obligatorio';
				}
				if (!this.inputDfi[0]) {
					error = true;
					this.inputDfiActive[0] = true;
					this.msjErrorDfi[0] = 'El ingreso del diagnostico flgo es obligatorio';
				}
				if (!this.severidadIngreso[0]) {
					error = true;
					this.severidadIngresoActive[0] = true;
					this.msjErrorSi[0] = 'El ingreso de la severidad es obligatorio';
				}
				if (!this.escalaIngreso[0]) {
					error = true;
					this.escalaIngresoActive[0] = true;
					this.msjErrorEi[0] = 'El ingreso de la escala es obligatorio';
				}
				if (!this.inputCfv) {
					error = true;
					this.inputCfvActibe = true;
					this.msjErrorCfv = 'El ingreso de cfv es obligatorio';
				}
				if (!this.inputVe) {
					error = true;
					this.inputVeActive = true;
					this.msjErrorVe = 'El ingreso del  dato es obligatorio';
				}
				if (!this.inputManejo[0]) {
					error = true;
					this.inputManejoActive[0] = true;
					this.msjErrorManejo[0] = 'El ingreso del  dato es obligatorio';
				}
				if (!this.inputProcedimiento[0]) {
					error = true;
					this.inputProcedimientoActive[0] = true;
					this.msjErrorProcedimiento[0] = 'El ingreso del  dato es obligatorio';
				}


				if (!error){

                    let loader = Vue.$loading.show({
                        // Optional parameters
                        container: this.$refs.formContainer,
                        canCancel: true,
                        onCancel: this.onCancel,
                        color: '#19493F',
                    });

                    var altaExist;

                    if (this.viaEnteralAlta) {
                    	altaExist= true;
                    }else{
                    	altaExist= false;
                    }

					var registro = [];

					if (this.rutExist) {
						registro.push(

							{profesional: this.profesional},
							{rutExist: true},
							{idPatient: this.idPatient},

							{dfi:this.inputDfi},
							{si:this.severidadIngreso},
							{ei:this.escalaIngreso},

							{cfv:this.inputCfv},
							{ve:this.inputVe},
							{vfc:this.inputVfc},
							{manejo:this.inputManejo},
							{procedimiento:this.inputProcedimiento},

							{dfe:this.inputDfe},
							{se:this.severidadEgreso},
							{ee:this.escalaEgreso},

							{altaExist: altaExist},

							{fecha_alta:format(new Date(this.fechaAlta), 'yyyy-MM-dd')},
							{vea:this.viaEnteralAlta},
							{derivacion:this.derivacion}
						
						)
					}else{

						registro.push(
							{rutExist: false},
							{profesional: this.profesional},
							{rut: this.inputRut},
							{nombre: this.inputName},
							{procedencia:this.inputProcedencia},
							{fecha_ingreso:this.fechaIngreso},
							{edad: this.age},
							{grupo_sangre:this.inputGS},
							{sexo:this.inputSexo},
							{tqt:this.inputTqt},
							{diagnostico_ingreso:this.inputDI},

							{dfi:this.inputDfi},
							{si:this.severidadIngreso},
							{ei:this.escalaIngreso},

							{cfv:this.inputCfv},
							{ve:this.inputVe},
							{vfc:this.inputVfc},
							{manejo:this.inputManejo},
							{procedimiento:this.inputProcedimiento},

							{dfe:this.inputDfe},
							{se:this.severidadEgreso},
							{ee:this.escalaEgreso},

							{altaExist: altaExist},

							{fecha_alta:format(new Date(this.fechaAlta), 'yyyy-MM-dd')},
							{vea:this.viaEnteralAlta},
							{derivacion:this.derivacion}
						
						)
					}

					console.log('El registro es: ',registro)

                    axios.post('/auth/registro/create', {
                        data: JSON.stringify(registro),
                    })
                    .then(function (response){
                        console.log(response)
                        //window.location="/dashboard";
                        loader.hide();
                    })
                    .catch(function (error){
                        console.log(error);
                        loader.hide();
                    });

					console.log('El profesional: ', this.profesional);
				}
			},
		},
	}
</script>


<style type="text/css">

	.btn1{
		background-color: transparent;
		border-radius: 4px;
		border-style: solid; 
		border-width: 1px;
		font-weight: bold;
		border-color:#071f5b;
		color:#071f5b;
	}
	.btn1:hover{
		background-color: #071f5b;
		color: white;
	}
	.btn2{
		background-color: transparent;
		border-radius: 4px;
		border-style: solid; 
		border-width: 1px;
		font-weight: bold;
		border-color: red;
		color: red;
	}
	.btn2:hover{
		background-color: red;
		color: white;
	}
	.titulo{
		font-size: 25px;
    	font-family: Impact,Haettenschweiler,Franklin Gothic Bold,Charcoal,Helvetica Inserat,Bitstream Vera Sans Bold,Arial Black,sans serif; 
	}
	.tituloPrincipal{
		height: 45px;
		color:#001B48;
    	font-family: Impact,Haettenschweiler,Franklin Gothic Bold,Charcoal,Helvetica Inserat,Bitstream Vera Sans Bold,Arial Black,sans serif; 
		font-weight: bold;
	}
	.btnRegister1{
		background-color: #071f5b;
		border-radius: 4px;
		border-style: solid; 
		border-width: 1px;
		border-color:#071f5b;
		color:white;
		text-decoration: none;
	}
	.btnRegister1:hover{
		background-color: #040d23;
		color:white;
	}
	.btnRegister2{
		background-color: #f9fbff;
		border-radius: 4px;
		border-style: solid; 
		border-width: 1px;
		border-color:#071f5b;
		color:black;
		text-decoration: none;
		text-decoration-line: none;
	}
	.btnRegister2:hover{
		background-color: #e3e6ea;
	}
	.divHov{
		background-color: #fff;
		box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);

	}
</style>