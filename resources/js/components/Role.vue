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
          <i class="fa fa-align-justify"></i> Roles
        </div>
        <div class="card-body">
          <div class="form-group row">
            <div class="col-md-6">
              <div class="input-group">
                <select class="form-control col-md-3" v-model="criteria">
                  <option value="name">name</option>
                  <option value="description">Description</option>
                </select>
                <input type="text"  v-model="search" @keyup.enter="listarRole(1, search, criteria)" class="form-control" placeholder="Texto a buscar">
                <button type="submit" @click="listarRole(1, search, criteria)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
              </div>
            </div>
          </div>
          <table class="table table-bordered table-striped table-sm">
            <thead>
              <tr>
                <th>Nombre</th>
                <th>Description</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="role in arrayRole" :key="role.id">
                <td>{{role.name}}</td>
                <td>{{role.description}}</td>
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
  </main>
</template>
<script>
  export default {
    data(){
      return {
        role_id: 0,
        name :'',
        description :'',
        arrayRole : [],
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
      //listarRole (negocio_id){
      listarRole (page, search, criteria){

        let me=this;
       
        var url= '/admin/role?page=' + page + '&search='+ search + '&criteria='+ criteria;
        axios.get(url).then(function (response) {
          var result= response.data;
          me.arrayRole = result.roles.data;
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
        me.listarRole(page, search, criteria);
      }
    },
    mounted(){
      //this.listarRole(negocio_id);
      this.listarRole(1, this.search, this.criteria);
    }
  }
</script>
