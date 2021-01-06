@if ($errors->any())
          <ul>
              @foreach ($errors->all() as $error)
              <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-ban"></i>{{ $error }}</h5>                
              </div>
              @endforeach
          </ul>
@endif
