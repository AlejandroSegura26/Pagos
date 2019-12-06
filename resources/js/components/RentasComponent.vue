<template>
    <main class="main" style="width: 100%; height: 100%;">
        <!-- Breadcrumb -->
        <ol class="breadcrumb col-lg-12">
            <li class="breadcrumb-item"><a href="/principal">Tablero</a></li>
            <li class="breadcrumb-item"><a @click="menu=4" href="#">Rentas</a></li>
            
        </ol>
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-thumbtack"></i>&nbsp;&nbsp;Rentas&nbsp;
                    <button type="button" @click="abrirModal('registrar',0)" class="btn btn-secondary float-right">
                        <i class="fa fa-plus"></i>&nbsp;Nuevo
                    </button>
           
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <select class="form-control col-md-3" v-model="criterio">
                                   <option value="nombre">Nombre</option>
                                   <option value="telefono">Telefono</option>
                                   <option value="encargado">Encargado</option>
                                </select>
                                 <input type="text" v-model="buscar" @keyup.enter="listarRenteros(1,buscar,criterio)" class="form-control"
                                    placeholder="Texto a buscar">
                                <button type="submit" @click="listarRenteros(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i>
                                    Buscar</button>
                            </div>
                        </div>
                    </div>
                    <table class="table table-bordered table-striped table-sm">
                        <thead>
                            <tr>
                                <th>Opciones</th>
                                <th>Nombre</th>
                                <th>Telefono</th>
                                <th>Encargado</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="renta in arrayRentero" :key="renta.id">
                                <td>
                                      <button type="button" @click="abrirModal('actualizar',renta, renta.id)" class="btn btn-warning btn-sm">
                                        <i class="fas fa-pen"></i>
                                    </button> &nbsp;
                                     
                                       
                                        <template v-if="renta.estado">
                                        <button type="button" class="btn btn-danger btn-sm" @click="desactivarRenta(renta.id)">
                                            <i class="far fa-eye-slash"></i>
                                        </button>&nbsp;
                                          
                                        <button type="button" @click="abrirModal('pagar', renta,renta.id)" class="btn btn-warning btn-sm">
                                        <i class="fas fa-pen"></i>
                                        </button> &nbsp;
                                          
                                        </template>
                                        <template v-else>
                                        <button type="button" class="btn btn-danger btn-sm" @click="ActivarRenta(renta.id)">
                                            <i class="far fa-eye"></i>
                                        </button>&nbsp;
                                        </template>
                                        
                                    

                                </td>
                                <td v-text="renta.nombre"></td>
                                <td v-text="renta.telefono"></td>
                                <td v-text="renta.encargado"></td>
                                 <td > <template v-if="renta.estado">
                                     Activo
                                   </template>     
                                    <template v-else>
                                     Desactivado
                                    </template>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <nav>
                        <ul class="pagination">
                            <li class="page-item" v-if="pagination.current_page > 1">
                                <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page - 1,buscar,criterio)">Ant</a>
                            </li>
                            <li class="page-item" v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active' : '']">
                                <a class="page-link" href="#" @click.prevent="cambiarPagina(page,buscar,criterio)" v-text="page"></a>
                            </li>
                            <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                                <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page + 1,buscar,criterio)">Sig</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>

        </div>
        <!--Inicio del modal agregar/actualizar-->
        <div class="modal fade" tabindex="-1" :class="{'mostrar' : modal}" role="dialog" aria-labelledby="myModalLabel"
            style="display: none; overflow-y: scroll; padding-top: 55px;" aria-hidden="true">
            <div class="modal-dialog modal-primary modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" v-text="tituloModal"></h4>
                        <button type="button" class="close" @click="cerrarModal()" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form  v-if="tipoAccion <3" action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Nombre</label>
                                <div class="col-md-9">
                                    <input type="text" v-model="nombre" class="form-control"
                                        placeholder="Ingrese el nombre del servicio">
                                </div>
                            </div>
                            
                            
                           <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Telefono</label>
                                <div class="col-md-9">
                                    <input type="text" v-model="telefono" class="form-control"
                                        placeholder="Ingrese el telefono del encargado">
                                </div>
                            </div>
                          
                             <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Encargado</label>
                                <div class="col-md-9">
                                    <input type="email" v-model="encargado" class="form-control"
                                        placeholder="Ingrese el nombre del encargado">
                                </div>
                            </div> 
                            
                            <div v-show="errorRentero" class="form-group row div-error">
                                <div class="text-center text-error">
                                    <div v-for="error in errorMostrarMsjRentero" :key="error" v-text="error"></div>
                                </div>
                            </div>
                        </form>
                        
                       <form v-if="tipoAccion ==3" action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Provedor</label>
                                <div class="col-md-9">
                                    <input type="text" v-model="nombre" class="form-control"
                                        placeholder="Ingrese el nombre del servicio">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Monto</label>
                                <div class="col-md-9">
                                    <input type="text" v-model="cantidad" class="form-control"
                                        placeholder="Ingrese el monto">
                                </div>
                            </div>
                           
                            
                    
                            <div v-show="errorRentero" class="form-group row div-error">
                                <div class="text-center text-error">
                                    <div v-for="error in errorMostrarMsjRentero" :key="error" v-text="error"></div>
                                </div>
                            </div>
                        </form>
                   
                    </div>
                    <div class="modal-footer">
                        <span><b>(*)</b>&nbsp;Campo obligatorio de ingresar</span>
                        <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                        <button type="button" v-if="tipoAccion==1" class="btn btn-success" @click="registrarRentero()">Guardar</button>
                        <button type="button" v-if="tipoAccion==2" class="btn btn-warning" @click="actualizarRentero()">Actualizar</button>
                        <button type="button" v-if="tipoAccion==3" class="btn btn-warning" @click="pago()">Pagar</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!--Fin del modal-->
    </main>
</template>

<script>
    export default {
        //Propiedad 'data' de javascript donde se declaran las variables necesarias para el funcionamiento del modulo 'categorias', dentro de estas variables tenemos las encargadas de la paginacion, del crud, de la busqueda de registros y del activado y desactivado de la cliente
        data() {
            return {
            id:0,
            nombre:'',
            telefono:'',
            encargado:'',
            arrayRentero:[],
            modal: 0,
            tituloModal:'',
            menu:0,
            tipoAccion: 0,
            errorRentero: 0,
            errorMostrarMsjRentero:[],
            pagination: 
            {
              'total': 0,
              'current_page': 0,
              'per_page': 0,
              'last_page': 0,
              'from': 0,
              'to': 0,
            },
            offset: 3,
            criterio: 'titulo',
            buscar: ''
            }
        },
        //Métodos computados para realizar la paginacion, el metodo isActived -> devuelve la página actual, el metodo pagesNumber -> devuelve un arreglo con las diferentes paginas de acuerdo a cuantos registros se desean mostrar
        computed: {
            isActived: function() {
                return this.pagination.current_page;
            },
            pagesNumber: function() {
                //Verifica si la variable 'to' tiene algun valor, si no es caso, entonces inicializa el arreglo de las paginas como vacio y solo se mostraran los botones siguiente y anterior
                if (!this.pagination.to) {
                    return [];
                }
                //Se declara una variable que guarda la diferencia entre el valor de la pagina actual y un valor 'predeterminado'
                var from = this.pagination.current_page - this.offset;
                if (from < 1) {
                    from = 1;
                }
                //Se declara una variable que sirve para ir a una pagina de todas
                var to = from + (this.offset * 2);
                if (to >= this.pagination.last_page) {
                    to = this.pagination.last_page;
                }
                //Se declara un arreglo el cual recibira todas las paginas creadas mediante el metodo paginate y se usara para mostrarse en la opcion correspondiente mediante directivas v-text
                var pagesArray = [];
                while (from <= to) {
                    pagesArray.push(from);
                    from++;
                }
                return pagesArray;
            }
        },
        //Métodos para mostrar, guardar, actualizar, desactivar y activar el usuario
        methods: {
            //Metodo para obtener todos los registros de la bd mediante el uso del controlador definido y en este caso, se tiene tambien la implementacion de la paginacion para ver los registros de acuerdo a lo establecido en el modelo (10 modelos por pagina) y se implementa la busqueda de registros en este metodo debido a que es el que se encarga de mostrar los datos de acuerdo al criterio elegido si es que se ha introducido un texto o mostrar todos los datos en caso de que no sea asi
            listarRenteros(page,buscar,criterio) {
              let me = this;
                //Se le asigna a la ruta '/cliente' los parametros 'buscar' y 'criterio' mediante el metodo get que se utiliza para buscar un registro de acuerdo a lo que ha ingresado el usuario en el input para buscar
                var url = '/renta?page=' + page + '&buscar=' + buscar + '&criterio=' + criterio;
                axios.get(url).then(function (response) {
                    //Se crea una variable respuesta que guardara los datos de la consulta mediante ajax
                    var respuesta = response.data;
                    //Guarda los datos en el arreglo 'arrayUsuario'
                    me.arrayRentero = respuesta.renta.data; //*
                    //Guarda en el arreglo 'pagination' las variables necesarias para llevar a cabo estas tareas
                    me.pagination = respuesta.pagination;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
  
            //Metodo para mostrar una determinada pagina y los registros asignados a ella
            cambiarPagina(page,buscar,criterio){
                let me = this;
                //Actualiza la pagina actual
                me.pagination.current_page = page;
                //Envia la peticion para visualizar los datos de esa pagina
                me.listarRenteros(page,buscar,criterio);
            },
         
            registrarRentero() {
                if (this.validarRentero()) {
                    return;
                }
                let me = this;
                 axios.post('/renta/registrar',{
                 'nombre':this.nombre,
                 'telefono':this.telefono,
                 'encargado':this.encargado
                }).then(function (response) {
           
                  me.cerrarModal();
                    me.listarRenteros(1,'','nombre');
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            
            actualizarRentero() {
                  if (this.validarRentero()) {
                    return;
                }
                let me = this;
                
                axios.put('/renta/actualizar',{
                 'nombre':this.nombre,
                 'telefono':this.telefono,
                 'encargado':this.encargado,
                  'id':this.id
                }).then(function (response) {
                     me.cerrarModal();
                    me.listarRenteros(1,'','nombre');
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            
                 validarRentero() {
              this.errorProyecto = 0;
              this.errorMostrarMsjRentero = [];
              if (!this.nombre) this.errorMostrarMsjRentero.push("Ingresar el nombre del local");
              if (!this.telefono) this.errorMostrarMsjRentero.push("Ingresar el telefono del encargado.");
              if (!this.encargado) this.errorMostrarMsjRentero.push("Ingresar el nombre del encargado ");
              if (this.errorMostrarMsjRentero.length) this.errorRentero = 1;
                return this.errorRentero;
            },
         
              abrirModal(accion, data = [],id) {
                switch (accion) 
                {
                    case 'registrar':
                    {
                        this.modal = 1;
                        this.tituloModal = 'Registrar Renta';
                        this.tipoAccion = 1;
                        this.nombre="";
                        this.telefono="";
                        this.encargado="";
                        break;
                    }
                    case 'actualizar':
                    {
                        this.modal = 1;
                        this.id=id;
                        this.tituloModal = 'Actualizar Renta';
                        this.tipoAccion = 2;
                        this.nombre=data["nombre"];
                        this.telefono=data["telefono"];
                        this.encargado=data["encargado"];
                        break;
                      }
                    case 'pagar':
                    {
                        this.tipoAccion=3;
                        this.modal = 1;
                        this.tituloModal = 'Pago de renta';
                        this.id=data['id'];
                        this.nombre=data["nombre"];
                        this.cantidad=0;
                        break;
                      }
                  }
            },
             cerrarModal() {
                this.modal = 0;
                this.tituloModal = '';
                this.errorRentero= 0;
                this.nombre = '';
                this.telefono = '';
                this.encargado = '';
            },
            
            desactivarRenta(id) {
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn btn-success',
                        cancelButton: 'btn btn-danger'
                    },
                    buttonsStyling: false
                })
                swalWithBootstrapButtons.fire({
                    title: '¿Estás seguro de desactivar esta renta?     ',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Aceptar',
                    cancelButtonText: 'Cancelar',
                    reverseButtons: true
                }).then((result) => {
                    if (result.value) {
                        let me = this;
                        //Mediante axios se hace una peticion mediante ajax gracias a la ruta '/categoria/desactivar' para llamar al controlador y ejecutar la tarea correspondiente
                        axios.post('/renta/desactivar',{
                            'id':id,
                        }).then(function (response) {
                              swalWithBootstrapButtons.fire(
                            '¡finalizado!',
                            'La renta ha sido desactivad con éxito.',
                            'success'
                            ) 
                               me.listarRenteros(1,'','nombre');
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                    } else if (
                        /* Read more about handling dismissals below */
                        result.dismiss === Swal.DismissReason.cancel
                    ) {
                    }
                })
            },
         
            ActivarRenta(id) {
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn btn-success',
                        cancelButton: 'btn btn-danger'
                    },
                    buttonsStyling: false
                })
                swalWithBootstrapButtons.fire({
                    title: '¿Estás seguro de activar esta renta?     ',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Aceptar',
                    cancelButtonText: 'Cancelar',
                    reverseButtons: true
                }).then((result) => {
                    if (result.value) {
                        let me = this;
                        //Mediante axios se hace una peticion mediante ajax gracias a la ruta '/categoria/desactivar' para llamar al controlador y ejecutar la tarea correspondiente
                        axios.post('/renta/activar',{
                            'id':id,
                        }).then(function (response) {
                              swalWithBootstrapButtons.fire(
                            '¡finalizado!',
                            'La renta ha sido activada con éxito.',
                            'success'
                            ) 
                               me.listarRenteros(1,'','nombre');
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                    } else if (
                        /* Read more about handling dismissals below */
                        result.dismiss === Swal.DismissReason.cancel
                    ) {
                    }
                })
            },
          
          pago() {
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn btn-success',
                        cancelButton: 'btn btn-danger'
                    },
                    buttonsStyling: false
                })
                swalWithBootstrapButtons.fire({
                    title: '¿Estás seguro de hacer este pago?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Aceptar',
                    cancelButtonText: 'Cancelar',
                    reverseButtons: true
                }).then((result) => {
                    if (result.value) {
                        let me = this;
                        //Mediante axios se hace una peticion mediante ajax gracias a la ruta '/categoria/activar' para llamar al controlador y ejecutar la tarea correspondiente
                        axios.post('/renta/pagar',{
                            //Se le asignan los valores recopilados de los inputs del modal
                            'id': this.id,
                            'nombre':this.nombre,
                            'monto':this.cantidad
                          
                        }).then(function (response) {
                            //Se llama al metodo para enlistar las categorias y se muestra un mensaje mediante sweetalert
                               swalWithBootstrapButtons.fire(
                            '¡Pagado!',
                            'El pago ha sido realizado con éxito.',
                            'success'
                            )
                           me.listarRenteros(1,'','nombre');
                           me.cerrarModal();
                       
                          
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                    } else if (
                        /* Read more about handling dismissals below */
                        result.dismiss === Swal.DismissReason.cancel
                    ) {
                    }
                })
            },
        },
         mounted() {

            this.listarRenteros(1,this.buscar,this.criterio);

        }
    }
</script>
<!--Estilos para el modal y los mensajes de error-->
<style>
    .modal-content{
        width: 100% !important;
        position: absolute !important;
    }
    .mostrar{
        display: list-item !important;
        opacity: 1 !important;
        position: absolute !important;
        background-color: #3C29297A !important;
    }
    .div-error{
        display: flex;
        justify-content: center;
    }
    .text-error{
        color: red !important;
        font-weight: bold;
    }
</style>
<!--\ Fin de estilos para el modal y los mensajes de error-->
