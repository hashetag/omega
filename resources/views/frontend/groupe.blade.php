<!-- Comienzo de aside -->
<div class="col-md-3 page-sidebar mobile-filter-sidebar">
  <aside>
    <div class="sidebar-modern-inner">
      <div class="block-title has-arrow sidebar-header">
        <h5><a href="{{ url('/') }}">Categorías de Empresa</a></h5>
      </div>
      <div class="block-content categories-list  list-filter ">
        <ul class=" list-unstyled">
          @foreach ($groupes as $groupe)
            <li class="{{ request()->groupe == $groupe->slug ? 'active' : '' }}">
              <a href="{{ url($groupe->slug) }}"><span class="title">{{ $groupe->name }}</span>
                <span class="count">
                  &nbsp;
                  <?php 
<<<<<<< HEAD
                    $emps = DB::table('empresas')->where('isAdmin', 0)->where('groupe_id', $groupe->id)->count();
=======
                    $emps = DB::table('empresas')->where('groupe_id', $groupe->id)->count();
>>>>>>> a7f46dba2b390825d66a2b719184eec6042b2b72
                    echo $emps;
                  ?>
                </span>
              </a>
            </li>
          @endforeach
	        </ul>
      </div>  
      <div style="clear:both"></div>
    </div>
  </aside>
</div>
<!-- fin de aside -->

