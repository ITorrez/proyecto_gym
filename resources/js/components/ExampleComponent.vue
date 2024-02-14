<template>
    <div class="card">
        <div class="card-header">Listar Usuarios
            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal" @click="abrirModalCrear">
                Crear usuarios
                <i class="fa fa-user-plus"></i>
            </button>
        </div>

            <div class="card-body">
                <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="sampleTable">
                          <thead>
                            <tr>
                              <th>ID</th>
                              <th>NAME</th>
                              <th>APELLIDO</th>
                              <th>TELEFONO</th>
                              <th>TIPO</th>
                              <th>EMAIL</th>
                              <th>PASSWORD</th>
                              <th>Accion</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr v-for="user in usuarios">
                               <td>{{ user.id }}</td>
                               <td>{{ user.name }}</td>
                               <td>{{ user.apellido }}</td>
                               <td>{{ user.telefono }}</td>
                               <td v-if="user.tipo===1">{{ 'ADMINISTRADOR' }}</td>
                               <td v-else>{{ 'RECEPCIONISTA' }}</td>
                               <td>{{ user.email }}</td>
                               <td>{{ user.password }}</td>

                               <td>
                                  <button class="btn btn-warning btn-block btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal" @click="abrirModalEditar(user)" ><i class="fa fa-edit"></i> </button>
                                  <button class="btn btn-danger btn-block btn-sm" @click="eliminar(user)"><i class="fa fa-trash"></i></button>
                                  <button class="btn btn-info btn-block btn-sm" data-bs-toggle="modal" data-bs-target="#modalinfo" @click="detalles(user)"><i class="fa fa-info-circle"></i></button>

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
               <input type="text" v-model="crearUsuario.name" class="form-control" id="name" placeholder="Nombre">
            </div>
            <div class="mb-3">
               <label for="apellido" class="form-label">Apellido</label>
               <input type="text" v-model="crearUsuario.apellido" class="form-control" id="apellido" placeholder="apellido">
            </div>
            <div class="mb-3">
               <label for="telefono" class="form-label">Telefono</label>
               <input type="text" v-model="crearUsuario.telefono" class="form-control" id="telefono" placeholder="telefono">
            </div>
            <div class="mb-3">
               <label for="email" class="form-label">Email</label>
               <input type="email" v-model="crearUsuario.email" class="form-control" id="email" placeholder="Correo">
            </div>
            <div class="mb-3">
               <label for="password" class="form-label">Password</label>
               <!-- <input type="password" v-model="crearUsuario.password" class="form-control" id="password" placeholder="Contraseña"> -->
               <span id="show-hide-passwd" action="hide" class="input-group-addon glyphicon glyphicon glyphicon-eye-open"></span>


               <div class="input-group">
                  <span class="input-group-text" id="basic-addon1" action="hide" @click.prevent="verpassword">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                  <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0"></path>
                  <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7"></path>
                  </svg>
                  </span>
                  <input type="password" v-model="crearUsuario.password" class="form-control" id="password" placeholder="Contraseña">
              </div>




            </div>

            <div class="mb-3">
               <label for="tipo" class="form-label">Tipo</label>
               <select id="tipo" v-model="crearUsuario.tipo" class="form-control">
                    <option disabled selected value="">Seleccione tipo</option>
                    <option value="1">Administrador</option>
                    <option value="2">Recepcionista</option>
               </select>
            </div>

           </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" id="btncrear" @click.prevent="crear" v-if="btnCrear">Guardar</button>
        <button type="button" class="btn btn-primary" id="btnactualizar" @click.prevent="editar" v-if="btnEditar">Actualizar</button>
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
                <th scope="row">Apellido</th>
                <td>{{ info.apellido }}</td>
              </tr>
              <tr>
                <th scope="row">E-mail</th>
                <td>{{ info.email }}</td>
              </tr>
              <tr>
                <th scope="row">Fecha creacion</th>
                <td>{{ fecha(info.created_at) }}</td>
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
        },
        data(){
            return {
                usuarios:[],
                info:[],
                crearUsuario:{name:'',apellido:'',telefono:'',tipo:'', email:'',password:''},
                titulo:'',
                btnCrear:false,
                btnEditar:false,
                idUser:''

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
                axios.get('listar_usuarios').then(res=>{
                    this.usuarios=res.data;
                    this.tabla();
                });
            },

            crear(){
                const myButton = document.getElementById('btncrear');
                        myButton.disabled = true;
                        myButton.style.opacity = 0.7;
                        myButton.textContent = 'Ejecutando proceso...';

                        //simulación de espera para ejecución de un proceso

                axios.post('crear_usuarios',this.crearUsuario).then(res=>{
                 //   this.getUser()
                // alert('Guardado');
                $('#exampleModal').css({'display':'none'});
                   // var modalform= document.getElementById("staticBackdrop");
                   // modalform.hide();
                    this.getUser();
                    this.crearUsuario.name='';
                    this.crearUsuario.email='';
                    this.crearUsuario.password='';


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
              this.crearUsuario={name:'',email:'',password:''}
              this.titulo='Crear usuario'
              this.btnCrear=true
              this.btnEditar=false
            },
            abrirModalEditar(datos){
              this.crearUsuario={name:datos.name,
                                 apellido:datos.apellido,
                                 telefono:datos.telefono,
                                 tipo:datos.tipo,
                                 password:datos.password,
                                 email:datos.email}
              this.titulo='Actualizar usuario'
              this.btnCrear=false
              this.btnEditar=true
              this.idUser=datos.id
             // $('#exampleModal').css({'display':'block'});
            // $('#exampleModal').modal('show');
            },
            detalles(datos){
               //console.log(datos);
                this.info=datos;
            },
            editar(){
                const myButton = document.getElementById('btnactualizar');
                        myButton.disabled = true;
                        myButton.style.opacity = 0.7;
                        myButton.textContent = 'Ejecutando proceso...';
              axios.put('editar_usuarios/'+this.idUser,this.crearUsuario).then(res=>{
                this.idUser='';
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
                    myButton.textContent = 'Guardar';
                   myButton.style.opacity = 1;
                   myButton.disabled = false;
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
                      axios.delete('eliminar_usuarios/'+datos.id).then(res=>{
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
            verpassword(){
               var tipo=document.getElementById("password");
               if (tipo.type=='password')
               {
                  tipo.type='text';
               }else{
                tipo.type='password';
               }
            }

        }
    }

    $(document).on('ready',function(){
        $('#basic-addon1').on('click',function(e){
            alert('cdfb gfv');
            // e.preventDefault();
            // var current =$(this).attr('action');
            // if (current==='hide'){
            //     $(this).prev().attr('type','text');
            //     //$(this).removeClass
            // }
            // if (current==='show'){
            //     $(this).prev().attr('type','password');
            // }
        })
    })


</script>
