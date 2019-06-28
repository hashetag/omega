@include('frontend.includes.header')
  @include('frontend.search')
    <div class="main-container">
      <div class="container">
      	<div class="row">
					
      		@show
    			@yield('content')

          </div>
				</div>
      </div>
    </div>
  @include('frontend.includes.banner')
@include('frontend.includes.footer')
  
