<template>
	<div>
      	<md-toolbar md-elevation="1" style="background-color: #fff" >
        	<h6 class="md-title" style="flex: 1; color: #001A48;">
          		<hospital-box-icon/>
          		<b>Registros de pacientes</b>
        	</h6>
        			  			
    		<router-link to = "/dashboard">
				<md-button >
  				    <b>{{profesional}}</b>
        		</md-button>
  			</router-link>

      	</md-toolbar>

      	<div class="col-12">

		  <el-table
		    :data="tableData.filter(data => !search || data.rut.toLowerCase().includes(search.toLowerCase()))"
		    style="width: 100%"
		    :default-sort = "{prop: 'fecha', order: 'descending'}"
		    >
		    <el-table-column type="expand">
		      <template slot-scope="props">
		      	<div class="d-flex row col-12">
			      	<div class="col-12 col-sm-6 col-md-6 col-lg-3">
			      		<div>
			      			<p style="height: 8px; color: black;" class="mb-3"> <b>Datos del paciente</b></p>
				      		<p class="divP"><b>&#8226 Fecha ingreso: </b> {{ props.row.fecha_ingreso }}</p>
					        <p class="divP"><b>&#8226 Rut: </b> {{ props.row.rut }}</p>
					        <p class="divP"><b>&#8226 Nombre: </b> {{ props.row.nombre }}</p>
					        <p class="divP"><b>&#8226 Edad: </b> {{ props.row.edad }}</p>
					        <p class="divP"><b>&#8226 Grupo de sangre: </b> {{ props.row.grupo_sangre }}</p>
					        <p class="divP"><b>&#8226 Procedencia: </b> {{ props.row.procedencia }}</p>
					        <p class="divP"><b>&#8226 Sexo: </b> {{ props.row.sexo }}</p>
					        <p class="divP"><b>&#8226 Traqueotomía: </b> {{ props.row.tqt }}</p>
					        <p class="divP"><b>&#8226 Dgo. Ingreso: </b> {{ props.row.dgo_ingreso }}</p>			      			
			      		</div>


			      	</div>

			      	<div class="col-12 col-sm-6 col-md-6 col-lg-3">
			      		<div class="mb-2" v-for="(antecedente, index) in props.row.antecedentes">
			      			<p style="height: 8px; color: black;" class="mb-3"> <b>Antecedente de ingreso {{index+1}}</b></p>
					        <p class="divP"><b>&#8226 Dgo. Flog.:</b> {{antecedente.dgflgoing }}</p>
					        <p class="divP"><b>&#8226 Severidad:</b> {{ antecedente.severidad }}</p>
					        <p class="divP"><b>&#8226 Escala: </b> {{ antecedente.escala }}</p>
			      		</div>
			      	</div>

			      	<div class="col-12 col-sm-6 col-md-6 col-lg-3">
			      		<p style="height: 8px; color: black;" class="mb-3"> <b>Evolución</b></p>
				        <p class="divP"><b>&#8226 Cuidado fin de vida:</b> {{ props.row.cfv }}</p>
				        <p class="divP"><b>&#8226 Via enteral:</b> {{ props.row.ve }}</p>
				        <p class="divP"><b>&#8226 VideoFluoroscopia:</b> {{ props.row.vfc }}</p>
				        <p v-for="(manejo, index) in props.row.manejosTable" class="divP"><b>&#8226 Manejo {{index+1}}:</b> {{ manejo }}</p>
				        <p v-for="(procedimiento, index) in props.row.procedimientoTable" class="divP"><b>&#8226 Procedimiento {{index+1}}:</b> {{ procedimiento }}</p>
			      	</div>

			      	<div class="col-12 col-sm-6 col-md-6 col-lg-3">
			      		<div class="mb-2" v-for="(egreso, index) in props.row.egresos">
			      			<p style="height: 8px; color: black;" class="mb-3"> <b>Antecedente de egreso {{index+1}}</b></p>
					        <p class="divP"><b>&#8226 Dgo. Flog.:</b> {{egreso.dgflgoeg }}</p>
					        <p class="divP"><b>&#8226 Severidad:</b> {{ egreso.severidad }}</p>
					        <p class="divP"><b>&#8226 Escala: </b> {{ egreso.escala }}</p>
			      		</div>
			      		<div class="mb-2 mt-4"  v-for="(alta, index) in props.row.altaMedica">
			      			<p style="height: 8px; color: black;" class="mb-3"> <b>Alta fonoaudiologica</b></p>
					        <p class="divP"><b>&#8226 Fecha de alta:</b> {{alta.fecha_alta_flgo }}</p>
					        <p class="divP"><b>&#8226 Via enteral:</b> {{ alta.via_enteral }}</p>
					        <p class="divP"><b>&#8226 Derivación: </b> {{ alta.derivacion }}</p>
			      		</div>
			      	</div>
		      	</div>
		      </template>
		    </el-table-column>
		    <el-table-column
		      label="Visita"
		      prop="fecha"
		      sortable>
		    </el-table-column>
		    <el-table-column
		      label="Rut"
		      prop="rut">

		    </el-table-column>
		    <el-table-column
		      label="Paciente"
		      prop="nombre">
		    </el-table-column>
		    <el-table-column
		      label="Estado"
		      prop="estado">
		    </el-table-column>
		    <el-table-column
		      align="right">
		      <template slot="header" slot-scope="scope">
		        <el-input
		          v-model="search"
		          size="mini"
		          placeholder="Buscar por rut"/>
		      </template>
		      <template slot-scope="scope">
		        <button
		          size="mini"
		          class="buttonTableEditar"
		          @click="handleEdit(scope.$index, scope.row)"><b>Editar</b></button>
		        <button
		          size="mini"
		          class="buttonTableEliminar"
		          @click="handleDelete(scope.$index, scope.row)"><b>Eliminar</b></button>
		      </template>
		    </el-table-column>
		  </el-table>
		</div>
	</div>

</template>

<script type="text/javascript">

	import { mapActions, mapState, mapMutations } from 'vuex';
	import HospitalBoxIcon from 'vue-material-design-icons/HospitalBox.vue';
	import locale from 'element-ui/lib/locale/lang/en'
    import parse from 'date-fns/parse'; 
	import format from 'date-fns/format';
	import isValid from 'date-fns/isValid';
	import pdf from 'vue-pdf'

	export default {

    	components: {
      		HospitalBoxIcon,
      		pdf,
    	},

		computed: mapState(['profesional']),

	    methods:{
	      ...mapActions(['getUser']),


	      datosTable(datos){

	      	
            datos.forEach(element => {

            	this.tableAntecedente=[];
            	this.tableEgreso=[];

            	var manejos=[];
            	var procedimientos=[];
            	var alta = 'Sin alta';

            	//console.log(element.antecedentesVisita.length)

            	element.antecedentesVisita.forEach(antecedente =>{
            		this.tableAntecedente.push({
            			dgflgoing:antecedente.dgflgoing,
            			severidad:antecedente.severidad,
            			escala:antecedente.escala,
            		})
            	});


            	if (element.evolucionVisita.manejo_flgo1){manejos[0]=element.evolucionVisita.manejo_flgo1}
            	if (element.evolucionVisita.manejo_flgo2){manejos[1]=element.evolucionVisita.manejo_flgo2}
            	if (element.evolucionVisita.manejo_flgo3){manejos[2]=element.evolucionVisita.manejo_flgo3}
            	if (element.evolucionVisita.manejo_flgo4){manejos[3]=element.evolucionVisita.manejo_flgo4}

            	if (element.evolucionVisita.procedimiento1){procedimientos[0]=element.evolucionVisita.procedimiento1}
            	if (element.evolucionVisita.procedimiento2){procedimientos[1]=element.evolucionVisita.procedimiento2}
            	if (element.evolucionVisita.procedimiento3){procedimientos[2]=element.evolucionVisita.procedimiento3}
            	if (element.evolucionVisita.procedimiento4){procedimientos[3]=element.evolucionVisita.procedimiento4}

            	element.egresoVisita.forEach(egreso =>{
            		this.tableEgreso.push({
            			dgflgoeg:egreso.dgflgoeg,
            			severidad:egreso.severidad,
            			escala:egreso.escala,
            		})
            	});

            	if (element.highMedical.length>0){
					var alta = 'Con alta';
            	}

                this.tableData.push({

                    id: element.registroVisita.id,
                    fecha:format(new Date(element.registroVisita.created_at), 'yyyy-MM-dd'),
                    nombre:element.datoPaciente.name,
                    rut: element.datoPaciente.rut,
                    edad:element.datoPaciente.age,
                    grupo_sangre:element.datoPaciente.grupo_sangre,
                    fecha_ingreso:format(new Date(element.datoPaciente.fechaIngreso), 'yyyy-MM-dd'),
                    procedencia:element.datoPaciente.procedencia,
                    sexo:element.datoPaciente.sexo,
                    tqt:element.datoPaciente.tqt,
                    dgo_ingreso:element.datoPaciente.dgcoIngreso,

                    cfv:element.evolucionVisita.cfv,
                    ve:element.evolucionVisita.via_enteral,
                    vfc:element.evolucionVisita.vfc,
                    manejosTable:manejos,
                    procedimientoTable:procedimientos,

                    antecedentes: this.tableAntecedente,
                    egresos: this.tableEgreso,
                    altaMedica: element.highMedical,
                    estado: alta

                })

            });

	      	//console.log('Estos son los datos: ', datos);
	      	//console.log('Estos son los datos: ', this.tableData);
	      	
	      }
	    },

	    data() {
	      return {
	        tableData: [],
	        tableAntecedente: [],
	        tableEgreso:[],
	        search: ''
	      }
	    },

	    mounted(){

	    	this.getUser();

			axios.get('/auth/registro/index', {
			}).then(response => {
				this.datosTable(response.data);
			}).catch(e => {
			    console.log(e);
			})
    	}
	}
</script>
<style type="text/css">

	.buttonTableEliminar{
		border-style: solid;
		border-color: #5b005a;
		border-radius: 4px;
		font-style: bold;
		width:55px; 
		height:25px;
		font-size: 10px;
		background-color: #75156e;
		color: #FAFAFA
	}
	.buttonTableEliminar:hover{
		background-color: #5b005a;
		color: #FAFAFA
	}

	.buttonTableEditar{
		border-style: solid;
		border-radius: 4px;
		font-style: bold;
		width:55px; 
		height:25px;
		font-size: 10px;

		color: black;
	}
	.buttonTableEditar:hover{
		border-color: #5b005a;
		color: #5b005a;
	}
	.divP{
		font-size: 12px;
		height: 8px;
	}
</style>

