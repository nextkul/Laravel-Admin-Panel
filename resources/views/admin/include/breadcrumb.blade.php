<?php $link = "" ?>
   <!-- Content Header (Page header) -->
   <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"> @yield('breadcrumb')</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">
              <a href="/">Home</a> >                
              @for($i = 1; $i <= count(Request::segments()); $i++)
                @if($i < count(Request::segments()) & $i > 0)
                <?php $link .= "/" . Request::segment($i); ?>
                <a href="#">{{ ucwords(str_replace('-',' ',Request::segment($i)))}}</a> /
                @else {{ucwords(str_replace('-',' ',Request::segment($i)))}}
                @endif
              @endfor
              </li>
              <!-- <li class="breadcrumb-item active">Dashboard</li> -->
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

               

