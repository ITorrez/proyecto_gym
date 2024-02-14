<template>
    <div class="card">
        <div class="card-header">Listar Clientes
            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal" @click="abrirModalCrear">
                Crear Cliente
                <i class="fa fa-user-plus"></i>
            </button>
        </div>

            <div class="card-body">
                <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="sampleTable">
                          <thead>
                            <tr>
                              <th>ID</th>
                              <th>NOMBRE</th>
                              <th>APELLIDO</th>
                              <th>CI</th>
                              <th>TELEFONO</th>
                              <th>SEXO</th>
                              <th>Accion</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr v-for="client in clientes">
                               <td>{{ client.id }}</td>
                               <td>{{ client.name }}</td>
                               <td>{{ client.apellido }}</td>
                               <td>{{ client.ci }}</td>
                               <td>{{ client.telefono }}</td>
                               <td>{{ client.sexo }}</td>

                               <td>
                                  <button class="btn btn-warning btn-block btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal" @click="abrirModalEditar(client)" ><i class="fa fa-edit"></i> </button>
                                  <button class="btn btn-danger btn-block btn-sm" @click="eliminar(client)"><i class="fa fa-trash"></i></button>
                                  <button class="btn btn-info btn-block btn-sm" data-bs-toggle="modal" data-bs-target="#modalinfo" @click="detalles(client)"><i class="fa fa-info-circle"></i></button>
                                  <button v-if="client.membresia" class="btn btn-warning btn-block btn-sm" >Membresia</button>
                                  <button v-else class="btn btn-success btn-block btn-sm" data-bs-toggle="modal" data-bs-target="#membresiaModal" @click="carCLienteID(client)">Inscribir</button>
                               </td>
                            </tr>


                          </tbody>
                        </table>
                      </div>
            </div>
    </div>


    <!-- Modal -->
    <!-- <div class="modal fade" id="staticBackdrop"  data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h1 class="modal-title fs-5" id="staticBackdropLabel"> <i class="fa fa-user-plus"></i>{{titulo}}</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
           <form>
            <div class="mb-3">
               <label for="name" class="form-label">Nombre</label>
               <input type="text" v-model="crearUsuario.name" class="form-control" id="name" placeholder="Nombre">
            </div>
            <div class="mb-3">
               <label for="email" class="form-label">Email</label>
               <input type="email" v-model="crearUsuario.email" class="form-control" id="email" placeholder="Correo">
            </div>
            <div class="mb-3">
               <label for="password" class="form-label">Password</label>
               <input type="password" v-model="crearUsuario.password" class="form-control" id="password" placeholder="Contraseña">
            </div>
           </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" @click.prevent="crear" v-if="btnCrear">Guardar</button>
        <button type="button" class="btn btn-primary" @click.prevent="crear" v-if="btnEditar">Editar</button>
      </div>
    </div>
  </div>
</div> -->



<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="fa fa-user-plus"></i>{{titulo}}</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
            <div class="mb-3">
               <label for="name" class="form-label">Nombre</label>
               <input type="text" v-model="DatosCliente.name" class="form-control" id="name" placeholder="Nombre">
            </div>
            <div class="mb-3">
               <label for="apellido" class="form-label">Apellido</label>
               <input type="text" v-model="DatosCliente.apellido" class="form-control" id="apellido" placeholder="Apellido">
            </div>
            <div class="mb-3">
               <label for="ci" class="form-label">Ci</label>
               <input type="text" v-model="DatosCliente.ci" class="form-control" id="ci" placeholder="Ci">
            </div>

            <div class="mb-3">
               <label for="telefono" class="form-label">Telefono</label>
               <input type="text" v-model="DatosCliente.telefono" class="form-control" id="telefono" placeholder="Telefono">
            </div>

            <div class="mb-3">
               <label for="sexo" class="form-label">Sexo</label>
               <select id="sexo" v-model="DatosCliente.sexo" class="form-control">
                    <option disabled selected value="">Seleccione sexo</option>
                    <option value="1">Hombre</option>
                    <option value="2">Mujer</option>
               </select>
            </div>


           </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" @click.prevent="crear" v-if="btnCrear">Guardar</button>
        <button type="button" class="btn btn-primary" @click.prevent="editar" v-if="btnEditar">Editar</button>
      </div>
    </div>
  </div>
</div>





<!-- Modal info-->
<div class="modal fade" id="modalinfo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="fa fa-info-circle"></i> Detalles del Usuario</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <div class="table-responsive">
          <table class="table table-hover table-bordered table-striped">
            <tbody>
              <tr>
                <th scope="row">Nombre</th>
                <td>{{ info.name }}</td>
              </tr>
              <tr>
                <th scope="row">E-mail</th>
                <td>{{ info.email }}</td>
              </tr>
              <tr>
                <th scope="row">Fecha creacion</th>
                <td>{{ fecha(info.created_at) }}</td>
              </tr>

              <tr>
                <th scope="row">Fecha actualizacion</th>
                <td>{{ fecha(info.updated_at) }}</td>
              </tr>
            </tbody>

          </table>

        </div>



      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">OK</button>

      </div>
    </div>
  </div>
</div>





<!-- Modal para registrar membresia-->
<div class="modal fade" id="membresiaModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">{{titulo_membresia}}</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
            <input type="hidden" v-model="DatosMembresia.cliente_id" class="form-control" id="id cliente" >

            <div class="mb-3">
               <label for="tipo" class="form-label">Tipo </label>
               <select id="tipo" v-model="DatosMembresia.tipo" class="form-control">
                    <option disabled selected value="">Seleccione tipo</option>
                    <option  value="1">Gymnasio</option>
                    <option value="2">Zumba</option>
               </select>
            </div>

            <div class="mb-3">
               <label for="tipo" class="form-label">Tipo precio</label>
               <select id="tipo" v-model="DatosMembresia.precio_id" class="form-control" @change="calculoTiempomembresia">
                    <option disabled selected value="">Seleccione tipo precio</option>
                    <option v-for="precio in precios" :value="precio.id">{{ precio.descripcion }}</option>

               </select>
            </div>

            <div class="mb-3">
               <label for="fecha_inicio" class="form-label">Fecha Inicio</label>
               <input type="date" v-model="DatosMembresia.fecha_inicio" class="form-control" id="fecha_inicio" readonly>
            </div>
            <div class="mb-3">
               <label for="fecha_fin" class="form-label">Fecha fin</label>
               <input type="date" v-model="DatosMembresia.fecha_fin" class="form-control" id="fecha_fin" readonly>
            </div>

            <div class="mb-3">
               <label for="cantidad_meses" class="form-label">Cantidad Meses</label>
               <input type="text" v-model="DatosMembresia.cantidad_meses" class="form-control" id="cantidad_meses" placeholder="Cantidad de meses" :readonly="esSoloLectura" @input="onChangeCantidadMeses">
            </div>



            <div class="mb-3">
                <input type="hidden" v-model="DatosMembresia.monto_precio" class="form-control" id="monto_precio" placeholder="monto precio">
               <label for="monto_total" class="form-label">Monto total</label>
               <input type="text" v-model="DatosMembresia.monto_total" class="form-control" id="monto_total" placeholder="Monto total" readonly>
            </div>



           </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" @click.prevent="crearMembresia" >Guardar</button>
        <!-- <button type="button" class="btn btn-primary" @click.prevent="editar" v-if="btnEditar">Editar</button> -->
      </div>
    </div>
  </div>
</div>






</template>

<script>
    import datatable from 'datatables.net-bs5'

    //Para los botones de exportar
    //require('datatables.net-buttons/js/dataTables.buttons')
    //require('datatables.net-buttons/js/buttons.html5')
    import   'datatables.net-buttons/js/dataTables.buttons'
    //import   'datatables.net-buttons/js/buttons.html5'
    import  'datatables.net-buttons/js/buttons.html5';


    import print from 'datatables.net-buttons/js/buttons.print'
    import jszip from 'jszip/dist/jszip'
    import pdfMake from 'pdfmake/build/pdfmake'
    import pdfFonts from "pdfmake/build/vfs_fonts"
    import swal from 'sweetalert';
    import jQuery from 'jquery';
    window.$=jQuery;

    import moment from 'moment';
    import 'moment/locale/es';

    export default {
        mounted() {
            //console.log('Component mounted.')
            //this.tabla();
            this.getUser();
            this.getPrecios();
        },
        data(){
            return {
                clientes:[],
                info:[],
                DatosCliente:{name:'',
                              apellido:'',
                              ci:'',
                              telefono:'',
                              sexo:''},
                DatosMembresia:{fecha_inicio:'',
                                fecha_fin:'',
                                tipo:'',
                                monto_total:'',
                                cliente_id:'',
                                precio_id:'',
                                cantidad_meses:'',
                                monto_precio:''},
                titulo:'',
                titulo_membresia:'Registrar Membresia',
                btnCrear:false,
                btnEditar:false,
                idcli:'',
                esSoloLectura: false

            }
        },

        methods:{
             fecha(fecha_origen){
               return moment(fecha_origen).locale('es').format('LL');
             },
             tabla(){

                 this.$nextTick(function(){
                  //$('#sampleTable').DataTable();
                 var tablita= new datatable('#sampleTable');

                 });
             },
            getUser(){
                axios.get('listar_clients').then(res=>{
                    this.clientes=res.data;
                    this.tabla();
                });
            },
            crearMembresia(){
                axios.post('crear_membresia',this.DatosMembresia).then(res=>{

                   if (res.data==0)
                   {
                    swal("Error!", "La fecha fin debe ser mayor a la fecha inicio!", "error");
                   }
                   if (res.data==-1) {
                    swal("Error!", "el rango de fechas debe ser minimo un mes!", "error");
                   }
                   if (res.data==-2) {
                    swal("Error!", "la fecha inicio no puede ser menor a fecha actual!", "error");
                   }
                   if (res.data>1) {
                    swal("Exelente!", "Creado correctamente!", "success");
                    window.location.reload();
                   }

                }).catch(function(error){
                  var array = Object.values(error.response.data.errors);
                    array.forEach(element => swal(String(element)))
                   // swal("Error!", "Intente nuevamente!", "error");
                });
            },
            crear(){
                axios.post('crear_clientes',this.DatosCliente).then(res=>{
                 //   this.getUser()
                // alert('Guardado');
                //$('#exampleModal').css({'display':'none'});
                   // var modalform= document.getElementById("staticBackdrop");
                   // modalform.hide();
                    this.getUser();
                    this.DatosCliente.name='';
                    this.DatosCliente.apellido='';
                    this.DatosCliente.ci='';


                    swal("Exelente!", "Creado correctamente!", "success");
                    window.location.reload();
                }).catch(function(error){
                  var array = Object.values(error.response.data.errors);
                    array.forEach(element => swal(String(element)))
                   // swal("Error!", "Intente nuevamente!", "error");
                });
            },
            abrirModalCrear(){
              this.DatosCliente={name:'',apellido:'',ci:'',telefono:'',sexo:''}
              this.titulo='Crear cliente'
              this.btnCrear=true
              this.btnEditar=false
            },
            carCLienteID(datos){
               this.DatosMembresia.cliente_id=datos.id;
            },
            abrirModalEditar(datos){
              this.DatosCliente={name:datos.name,apellido:datos.apellido,ci:datos.ci,telefono:datos.telefono,sexo:datos.sexo}
              this.titulo='Editar cliente'
              this.btnCrear=false
              this.btnEditar=true
              this.idcli=datos.id
             // $('#exampleModal').css({'display':'block'});
            // $('#exampleModal').modal('show');
            },
            detalles(datos){
               //console.log(datos);
                this.info=datos;
            },
            editar(){
              axios.put('editar_clientes/'+this.idcli,this.DatosCliente).then(res=>{
                this.idcli='';
                //$('#exampleModal').css({'display':'none'});
                   // var modalform= document.getElementById("staticBackdrop");
                   // modalform.hide();
                    //this.getUser();
                    //this.crearUsuario.name='';
                    //this.crearUsuario.email='';
                    //this.crearUsuario.password='';


                    swal("Exelente!", "Editado correctamente!", "success");
                    window.location.reload();
                }).catch(function(error){
                    var array = Object.values(error.response.data.errors);
                    array.forEach(element => swal(String(element)))
                    //swal("Error!", "Intente nuevamente!", "error");
                });
            },
            eliminar(datos){
              swal({
                    title: "¿Está seguro de eliminar a "+datos.name+"?",
                    text: "Se eliminara permanentemente!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                  })
                  .then((willDelete) => {
                    if (willDelete) {
                      axios.delete('eliminar_clientes/'+datos.id).then(res=>{
                      swal("Exelente!", "Eliminado correctamente!", "success");
                      window.location.reload();
                }).catch(function(error){
                    var array = Object.values(error.response.data.errors);
                    array.forEach(element => swal(String(element)))
                    //swal("Error!", "Intente nuevamente!", "error");
                });



                     /* swal("Usuario eliminado correctamente!", {
                        icon: "success",
                      });*/
                    }
                  });
            },
            getPrecios(){
                axios.get('listado_precios_membresia').then(res=>{
                    this.precios=res.data;
                    this.tabla();
                });
            },
            calculoTiempomembresia(event){
                // Extrae el valor seleccionado del evento
             const selectedValue = event.target.value;
             axios.get('mostrar_precio/'+selectedValue).then(res=>{
                    //alert('llego '+res.data.descripcion);
                           if (res.data.cantidad_meses===0) {
                                const fechaActual = new Date().toISOString().split('T')[0];
                                this.DatosMembresia.fecha_inicio = fechaActual;

                                //Con moment
                                // Crea un objeto Moment con la fecha actual
                                let fechaActualmoment = moment(fechaActual);

                                // Aumenta 14 días
                                let fechaAumentada = fechaActualmoment.add(14, 'days');

                                // Formatea la fecha
                                let fechaFormateadamoment = fechaAumentada.format('YYYY-MM-DD');

                              console.log(fechaFormateadamoment);
                              console.log(fechaActual);
                               this.DatosMembresia.fecha_fin = fechaFormateadamoment;
                               this.DatosMembresia.cantidad_meses = res.data.cantidad_meses;
                               this.DatosMembresia.monto_total = res.data.monto;
                               this.DatosMembresia.monto_precio= res.data.monto;
                                //console.log(fechaActual2);
                                this.esSoloLectura= true;

                            }

                            else{
                              /*Cuando es por un mes */
                                if(res.data.cantidad_meses>0 && res.data.es_promosion==0){
                                    const fechaActual = new Date().toISOString().split('T')[0];
                                    this.DatosMembresia.fecha_inicio = fechaActual;
                                    let fechaActualmoment = moment(fechaActual);
                                    // Aumenta un mes
                                    let fechaAumentada = fechaActualmoment.add(res.data.cantidad_meses, 'month');
                                    // Formatea la fecha
                                    let fechaFormateadamoment = fechaAumentada.format('YYYY-MM-DD');
                                    this.DatosMembresia.fecha_fin = fechaFormateadamoment;
                                    this.DatosMembresia.cantidad_meses = res.data.cantidad_meses;
                                    this.esSoloLectura= false;
                                    this.DatosMembresia.monto_total = res.data.monto;
                                    this.DatosMembresia.monto_precio= res.data.monto;

                                }
                                /*Cuando son promociones, mes estatico */
                                else{
                                    const fechaActual = new Date().toISOString().split('T')[0];
                                    this.DatosMembresia.fecha_inicio = fechaActual;
                                    let fechaActualmoment = moment(fechaActual);
                                    // Aumenta un mes
                                    let fechaAumentada = fechaActualmoment.add(res.data.cantidad_meses, 'month');
                                    // Formatea la fecha
                                    let fechaFormateadamoment = fechaAumentada.format('YYYY-MM-DD');
                                    this.DatosMembresia.fecha_fin = fechaFormateadamoment;
                                    this.DatosMembresia.cantidad_meses = res.data.cantidad_meses;
                                    this.esSoloLectura= true;
                                    this.DatosMembresia.monto_total = res.data.monto;
                                    this.DatosMembresia.monto_precio= res.data.monto;
                                }
                            }
                });

            },
            onChangeCantidadMeses(){
              let cantidad_meses = this.DatosMembresia.cantidad_meses;
              let precio_mes=this.DatosMembresia.monto_precio;
              let monto_total=0;
              const fechaActual = new Date().toISOString().split('T')[0];
              let fechaActualmoment = moment(fechaActual);
              // Aumenta de meses
              let fechaAumentada = fechaActualmoment.add(cantidad_meses, 'month');
              // Formatea la fecha
              let fechaFormateadamoment = fechaAumentada.format('YYYY-MM-DD');
              this.DatosMembresia.fecha_fin = fechaFormateadamoment;

              monto_total=precio_mes*cantidad_meses;
              this.DatosMembresia.monto_total =monto_total;




            }

        }
    }
</script>
