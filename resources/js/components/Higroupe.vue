<template>
  <main class="main">
    <ol class="breadcrumb">
      <li class="breadcrumb-item">Home</li>
      <li class="breadcrumb-item"><a href="#">Admin</a></li>
      <li class="breadcrumb-item active">Dashboard</li>
    </ol>
    <div class="container-fluid">
      <div class="card">
        <div class="card-header">
          <i class="fa fa-align-justify"></i> Super Categorías De Empresas
          <button type="button" @click="abrirModal('higroupe', 'registrar')" class="btn btn-secondary" >
              <i class="icon-plus"></i>&nbsp;Nuevo
          </button>
        </div>
        <div class="card-body">
          <div class="form-group row">
            <div class="col-md-6">
              <div class="input-group">
                <select class="form-control col-md-3" v-model="criteria">
                  <option value="name">name</option>
                  <option value="description">Descripción</option>
                </select>
                <input type="text"  v-model="search" @keyup.enter="listarHigroupe(1, search, criteria)" class="form-control" placeholder="Texto a buscar">
                <button type="submit" @click="listarHigroupe(1, search, criteria)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
              </div>
            </div>
          </div>
          <table class="table table-bordered table-striped table-sm">
            <thead>
              <tr>
                <th>Opciones</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>URL</th>
                <th>Estado</th>
                <th>Eliminar</th>
              </tr>
              </tr>
            </thead>
            <tbody>
              <tr v-for="higroupe in arrayHigroupe" :key="higroupe.id">
                <td>
                  <button type="button" @click="abrirModal('higroupe', 'actualizar', higroupe)" class="btn btn-warning btn-sm">
                    <i class="icon-pencil"></i>
                  </button> &nbsp;
                  <template v-if="higroupe.status">
                    <button type="button" class="btn btn-success btn-sm" @click="desactivarHigroupe(higroupe.id)">
                    <i class="icon-check"></i>
                  </button>
                  </template>
                  <template v-else>
                    <button type="button" class="btn btn-danger btn-sm" @click="activarCategoria(higroupe.id)">
                    <i class="icon-close"></i>
                  </button>
                  </template>
                </td>
                <td>{{higroupe.name}}</td>
                <td>{{higroupe.description}}</td>
                <td>{{higroupe.slug}}</td>
                <td>
                  <div v-if="higroupe.status">
                    <span class="badge badge-success">Activado</span>
                  </div>
                  <div v-else>
                    <span class="badge badge-danger">desactivado</span>
                  </div>
                </td>
                <td>
                  <button type="button" class="btn btn-danger btn-sm" @click="eliminarHigroupe(higroupe.id)">
                    <i class="icon-trash"></i>
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
          <nav>
            <ul class="pagination">
              <li class="page-item" v-if="pagination.current_page > 1">
                <a class="page-link" href="#" @click.prevent="changePage(pagination.current_page - 1,search,criteria)">Ant</a>
              </li>
              <li class="page-item" v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active' : '']">
                <a class="page-link" href="#" @click.prevent="changePage(page,search,criteria)" v-text="page"></a>
              </li>
              <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                <a class="page-link" href="#" @click.prevent="changePage(pagination.current_page + 1,search,criteria)">Sig</a>
              </li>
            </ul>
          </nav>
        </div>
      </div>
    </div>
    <div class="modal fade" tabindex="-1" :class="{'mostrar': modal}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
      <div class="modal-dialog modal-primary modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">{{tituloModal}}</h4>
            <button type="button" class="close" @click="cerrarModal()" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
              <div class="form-group row">
                <label class="col-md-3 form-control-label" for="text-input">nombre</label>
                <div class="col-md-9">
                  <input type="text" v-model="name" class="form-control" placeholder="nombre de categoría">
                  <span class="help-block">(*) Ingrese el nombre de la super categoría</span>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-md-3 form-control-label" for="email-input">Descripción</label>
                <div class="col-md-9">
                  <input type="text" v-model="description" class="form-control" placeholder="Ingrese descripción">
                </div>
              </div>
              <div v-show="errorHigroupe" class="form-group">
                <div class="row error text-danger">
                  <div v-for="error in errorMostrarMsjHigroupe" :key="error">{{error}}</div>
                </div>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
            <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarHigroupe()">Guardar</button>
            <button type="button" v-else class="btn btn-primary" @click="actualizarHigroupe()">Actualizar</button>
          </div>
        </div>
      </div>
    </div>
  </main>
</template>
<script>
  export default {
    data(){
      return {
        higroupe_id :'',
        name :'',
        description :'',
        arrayHigroupe : [],
        modal : 0,
        tituloModal : '',
        tipoAccion: 0,
        errorHigroupe : 0,
        errorMostrarMsjHigroupe : [],
        pagination : {
          'total' : 0,
          'current_page' : 0,
          'per_page' : 0,
          'last_page' : 0,
          'from' : 0,
          'to' : 0,
        },
        offset : 3,
        criteria : 'name',
        search : '',
      }
    },
    computed:{
      isActived: function(){
        return this.pagination.current_page;
      },
      //Calcula los elementos de la paginación
      pagesNumber: function() {
        if(!this.pagination.to) {
          return [];
        }
        
        var from = this.pagination.current_page - this.offset; 
        if(from < 1) {
          from = 1;
        }

        var to = from + (this.offset * 2); 
        if(to >= this.pagination.last_page){
          to = this.pagination.last_page;
        }  

        var pagesArray = [];
        while(from <= to) {
          pagesArray.push(from);
          from++;
        }
        return pagesArray;             
      }
    },
    methods :{
      //listarHigroupe (negocio_id){
      listarHigroupe (page, search, criteria){

        let me=this;
        var url= '/admin/higroupe?page=' + page + '&search='+ search + '&criteria='+ criteria;
        axios.get(url).then(function (response) {
          var result= response.data;
          me.arrayHigroupe = result.higroupes.data;
          me.pagination= result.pagination;
        })
        .catch(function (error){
          console.log(error);
        });
      },
      changePage(page, search, criteria){
        let me = this;
        //Actualiza la página actual
        me.pagination.current_page = page;
        //Envia la petición para visualizar la data de esa página
        me.listarHigroupe(page, search, criteria);
      },
      //registrarHigroupe (negocio_id){
      registrarHigroupe (){
        
        if (this.validarHigroupe()) {
          return;
        }

        let me=this;
        axios.post('/admin/higroupe/registrar',{
          'name' : this.name,
          'description' : this.description
        }).then(function (response){
          me.cerrarModal();
          //me.listarHigroupe();
          me.listarHigroupe(1, '', 'name');
        })
        .catch(function (error){
          console.log(error);
        });
      },
      actualizarHigroupe (id){
        
        if (this.validarHigroupe()) {
          return;
        }

        let me=this;
        axios.put('/admin/higroupe/actualizar/'+id,{
          'id' : this.higroupe_id,
          'name' : this.name,
          'description' : this.description
        }).then(function (response){
          me.cerrarModal();
          //me.listarHigroupe();
          me.listarHigroupe(1, '', 'name');
        })
        .catch(function (error){
          console.log(error);
        });
      },
      validarHigroupe(){
        this.errorHigroupe = 0;
        this.errorMostrarMsjHigroupe = [];

        if (!this.name) this.errorMostrarMsjHigroupe.push("El nombre de la Super categoría no puede estar vacío.");
        if (this.errorMostrarMsjHigroupe.length) this.errorHigroupe = 1;

        return this.errorHigroupe;
      },
      desactivarHigroupe(id){
       swal({
        title: 'Esta seguro de desactivar esta super categoría?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Aceptar!',
        cancelButtonText: 'Cancelar',
        reverseButtons: true
        }).then((result) => {
        if (result.value) {
          let me = this;

          /*var id = this.id;*/
          axios.put('/admin/higroupe/desactivar/'+id,{
            /*'id': id*/
          }).then(function (response) {
            me.listarHigroupe(1, '', 'name');
            swal(
            'Desactivado!',
            'El registro ha sido desactivado con éxito.',
            'success'
            )
          }).catch(function (error) {
            console.log(error);
          });
        } else if (
          // Read more about handling dismissals
            result.dismiss === swal.DismissReason.cancel
          ) {
              
          }
        }) 
      },
      activarCategoria(id){
        swal({
          title: 'Esta seguro de activar esta super categoría?',
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Aceptar!',
          cancelButtonText: 'Cancelar',
          reverseButtons: true
        }).then((result) => {
        if (result.value) {
          let me = this;

          axios.put('/admin/higroupe/activar/'+id,{
            'id': id
          }).then(function (response) {
            me.listarHigroupe(1, '', 'name');
            swal(
            'Activado!',
            'El registro ha sido activado con éxito.',
            'success'
            )
          }).catch(function (error) {
            console.log(error);
          });
        } else if (
          // Read more about handling dismissals
          result.dismiss === swal.DismissReason.cancel
        ) {
            
        }
        }) 
      },      
      eliminarHigroupe(id){
        swal({
          title: 'Esta seguro de borrar esta super categoría?',
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Aceptar!',
          cancelButtonText: 'Cancelar',
          reverseButtons: true
        }).then((result) => {
        if (result.value) {
          let me = this;

          axios.delete('/admin/higroupe/eliminar/'+id,{
            'id': id
          }).then(function (response) {
            me.listarHigroupe(1, '', 'name');
            swal(
            'Eliminado!',
            'La Super Categoria ha sido eliminado con éxito.',
            'success'
            )
          }).catch(function (error) {
            console.log(error);
          });
        } else if (
          // Read more about handling dismissals
          result.dismiss === swal.DismissReason.cancel
        ) {
            
        }
        }) 
      },
      cerrarModal(){
        this.modal = 0;
        this.tituloModal = '';
        this.name = '';
        this.description = '';
        this.errorHigroupe=0;

      },
      abrirModal (modelo, accion, data =[]){
        switch(modelo){
          case "higroupe":{
            switch(accion){
              case 'registrar':{
                this.modal = 1;
                this.tituloModal = 'Registrar Super Categoría';
                this.name = '';
                this.description = '';
                this.tipoAccion = 1;
                break;
              }
              case 'actualizar':{
                this.modal = 1;
                this.tituloModal = 'Actualizar Super Categoría';
                this.higroupe_id = data['id'];
                this.name = data['name'];
                this.description = data['description'];
                this.tipoAccion = 2;
                break;
              }
            }
          }
        }
      }
    },
    mounted(){
      //this.listarHigroupe(negocio_id);
      this.listarHigroupe(1, this.search, this.criteria);
    }
  }
</script>
<style>
  .modal-content{
    width: 100% !important; 
    position: absolute !important; 
  }
  .mostrar{
    display: list-item !important;
    opacity: 1 !important; 
    position: absolute !important; 
    background-color: #3c29297a !important; 
  }
  .error{
    justify-content:center;
  }

</style>