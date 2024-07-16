<div id="bootstrap-data-table-export_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
  <form action="" method="Get" enctype="multipart/form-data">
      <div class="row">
          <div class="col-sm-12 col-md-12">
              <div id="bootstrap-data-table-export_filter" class="dataTables_filter">
                <label style="width: 100%">search : 
                <input type="search" class="form-control form-control-sm" placeholder="" id="search" name="search"  value="{{Request::get('search')}}">
                <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                </button>
                </label>
              </div>
         
          </div>
        </div>
      
  </form>
</div>