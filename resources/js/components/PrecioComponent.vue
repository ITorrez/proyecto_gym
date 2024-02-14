<template>
    <div class="card">
        <div class="card-header">Listar Precios
            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal" @click="abrirModalCrear">
                Crear Precio
                <i class="fa fa-user-plus"></i>
            </button>
        </div>

            <div class="card-body">
                <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="sampleTable">
                          <thead>
                            <tr>
                              <th>ID</th>
                              <th>MONTO</th>
                              <th>DESCRIPCION</th>
                              <th>CANTIDAD MESES</th>
                              <th>PROMOCION</th>
                              <th>Accion</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr v-for="precio in precios">
                               <td>{{ precio.id }}</td>
                               <td>{{ precio.monto }}</td>
                               <td>{{ precio.descripcion }}</td>
                               <td>{{ precio.cantidad_meses }}</td>
                               <td v-if="precio.es_promosion==1">{{ 'SI' }}</td>
                               <td v-else>{{ 'NO' }}</td>
                               <td>
                                   <button class="btn btn-warning btn-block btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal" @click="abrirModalEditar(precio)" ><i class="fa fa-edit"></i> </button>
                                  <button class="btn btn-danger btn-block btn-sm" @click="eliminar(precio)"><i class="fa fa-trash"></i></button>
                                  <!-- <button class="btn btn-info btn-block btn-sm" data-bs-toggle="modal" data-bs-target="#modalinfo" @click="detalles(precio)"><i class="fa fa-info-circle"></i></button> -->

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
               <label for="monto" class="form-label">Monto</label>
               <input type="text" v-model="Datosprecio.monto" class="form-control" id="monto" placeholder="Monto">
            </div>
            <div class="mb-3">
               <label for="descripcion" class="form-label">Descripcion</label>
               <input type="text" v-model="Datosprecio.descripcion" class="form-control" id="descripcion" placeholder="Descripcion">
            </div>
            <div class="mb-3">
               <label for="cantidad_meses" class="form-label">Cantidad meses</label>
               <input type="text" v-model="Datosprecio.cantidad_meses" class="form-control" id="cantidad_meses" placeholder="Cantidad de meses">
            </div>

            <div class="mb-3">
               <label for="es_promosion" class="form-label">Promocion?</label>
               <select id="es_promosion" v-model="Datosprecio.es_promosion" class="form-control">
                    <option disabled selected value="">Seleccione</option>
                    <option value="0">No</option>
                    <option value="1">Si</option>
               </select>
            </div>


           </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" @click.prevent="crear" id="btncrear" v-if="btnCrear">Guardar</button>
        <button type="button" class="btn btn-primary" @click.prevent="editar" id="btneditar" v-if="btnEditar">Actualizar</button>
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
            <input type="text" v-model="DatosMembresia.cliente_id" class="form-control" id="id cliente" >

            <div class="mb-3">
               <label for="fecha_inicio" class="form-label">Fecha Inicio</label>
               <input type="date" v-model="DatosMembresia.fecha_inicio" class="form-control" id="fecha_inicio" >
            </div>
            <div class="mb-3">
               <label for="fecha_fin" class="form-label">Fecha fin</label>
               <input type="date" v-model="DatosMembresia.fecha_fin" class="form-control" id="fecha_fin" >
            </div>

            <div class="mb-3">
               <label for="tipo" class="form-label">Tipo</label>
               <select id="tipo" v-model="DatosMembresia.tipo" class="form-control">
                    <option disabled selected value="">Seleccione tipo</option>
                    <option value="1">Gymnasio</option>
                    <option value="2">Zumba</option>
               </select>
            </div>

            <div class="mb-3">
               <label for="monto_total" class="form-label">Monto total</label>
               <input type="text" v-model="DatosMembresia.monto_total" class="form-control" id="monto_total" placeholder="Monto total">
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
            this.getPrecios();
        },
        data(){
            return {
                precios:[],
                info:[],
                Datosprecio:{monto:'',descripcion:'',cantidad_meses:'',es_promosion:''},
                DatosMembresia:{fecha_inicio:'',fecha_fin:'',tipo:'',monto_total:'',cliente_id:''},
                titulo:'',
                titulo_membresia:'Registrar Membresia',
                btnCrear:false,
                btnEditar:false,
                idprecio:''

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
            getPrecios(){
                axios.get('listar_precios').then(res=>{
                    this.precios=res.data;
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
                const myButton = document.getElementById('btncrear');
                        myButton.disabled = true;
                        myButton.style.opacity = 0.7;
                        myButton.textContent = 'Ejecutando proceso...';

                axios.post('crear_precio',this.Datosprecio).then(res=>{
                 //   this.getUser()
                // alert('Guardado');
                //$('#exampleModal').css({'display':'none'});
                   // var modalform= document.getElementById("staticBackdrop");
                   // modalform.hide();
                    this.getPrecios();
                    this.Datosprecio.monto='';
                    this.Datosprecio.descripcion='';
                    this.Datosprecio.cantidad_meses='';


                    swal("Exelente!", "Creado correctamente!", "success");
                    window.location.reload();
                }).catch(function(error){
                  var array = Object.values(error.response.data.errors);
                    array.forEach(element => swal(String(element)))
                   // swal("Error!", "Intente nuevamente!", "error");
                   myButton.textContent = 'Guardar';
                   myButton.style.opacity = 1;
                   myButton.disabled = false;
                });
            },
            abrirModalCrear(){
              this.Datosprecio={name:'',apellido:'',ci:'',telefono:'',sexo:''}
              this.titulo='Crear precio'
              this.btnCrear=true
              this.btnEditar=false
            },
            carCLienteID(datos){
               this.DatosMembresia.cliente_id=datos.id;
            },
            abrirModalEditar(datos){
              this.Datosprecio={monto:datos.monto,
                                descripcion:datos.descripcion,
                                cantidad_meses:datos.cantidad_meses,
                                es_promosion:datos.es_promosion}
              this.titulo='Actualizar precio'
              this.btnCrear=false
              this.btnEditar=true
              this.idprecio=datos.id
             // $('#exampleModal').css({'display':'block'});
            // $('#exampleModal').modal('show');
            },
            detalles(datos){
               //console.log(datos);
                this.info=datos;
            },
            editar(){
                const myButton = document.getElementById('btneditar');
                        myButton.disabled = true;
                        myButton.style.opacity = 0.7;
                        myButton.textContent = 'Ejecutando proceso...';
              axios.put('editar_precio/'+this.idprecio,this.Datosprecio).then(res=>{
                this.idprecio='';
                //$('#exampleModal').css({'display':'none'});
                   // var modalform= document.getElementById("staticBackdrop");
                   // modalform.hide();
                    //this.getUser();
                    //this.crearUsuario.name='';
                    //this.crearUsuario.email='';
                    //this.crearUsuario.password='';


                    swal("Exelente!", "Actualizado correctamente!", "success");
                    window.location.reload();
                }).catch(function(error){
                    var array = Object.values(error.response.data.errors);
                    array.forEach(element => swal(String(element)))
                    //swal("Error!", "Intente nuevamente!", "error");
                    myButton.textContent = 'Actualizar';
                   myButton.style.opacity = 1;
                   myButton.disabled = false;
                });
            },
            eliminar(datos){
              swal({
                    title: "¿Está seguro de eliminar el precio: "+datos.descripcion+"?",
                    text: "Se eliminara permanentemente!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                  })
                  .then((willDelete) => {
                    if (willDelete) {
                      axios.delete('eliminar_precio/'+datos.id).then(res=>{
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
            }

        }
    }
</script>
