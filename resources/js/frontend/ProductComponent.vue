<template>
  <div class="item-list">
    <div class="row">
      <div class="col-md-3 no-padding photobox">
        <div class="add-image"> <a href="{{ URL::current().'/'.$prod->slug }}"><img class="thumbnail no-margin" src="{{'img_product/'.$prod->picture}}" alt="img" width="150" height="150"></a>
        </div>
      </div>
      <!--/.photobox-->
      <div class="col-md-6 add-desc-box">
        <div class="ads-details">
          <h5 class="add-title">
            <a href="{{ URL::current().'/'.$prod->slug }}" class="text-black"> {{ $prod->name }} </a>  
          </h5>
        </div>
      </div>
      <div class="col-md-3 text-center  price-box">
        <h3 class="item-price "> <strong>{{ '$'. $prod->price }} </strong></h3>
        <div style="clear: both"></div>
        <a class="btn btn-warning " href="">
          Agregar <i class="fa fa-shopping-basket"></i>
        </a>
        <!-- <button class="btn btn-warning" href="#product->$prod->id" data-toggle="modal">
          <span>Agregar al carrito</span>
        </button> -->
      </div>
    </div>
  </div>
</template>

<script>
  Vue.prototype.$empresa_id = document.querySelector("meta[name='empresa-id']").getAttribute('content');
  export default {
    data(){
      return {
        arrayProduct : [],
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
      listarProduct (empresa_id, page, search, criteria){
        var emp_id =this.$empresa_id;

        let me=this;
        //var url= '/admin/product/'+emp_id+'?page=' + page + '&search='+ search + '&criteria='+ criteria;
        axios.get(url).then(function (response) {
          //'empresa_id' : this.empresa_id,
          var result= response.data;
          me.arrayProduct = result.products.data;
          me.pagination= result.pagination;
        })
        .catch(function (error){
          console.log(error);
        });
      }
    },
    mounted(){
      this.listarProduct(this.$empresa_id, 1, this.search, this.criteria);
    }
  }
</script>
