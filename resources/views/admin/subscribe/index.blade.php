@extends('admin.layout.master')
@section('main-content')
<div class="page-content">
<div class="container-fluid">
    <!-- start page title -->
    <div class="row">
      <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
          <h4 class="mb-sm-0 font-size-18"> Subscribe</h4>
          <div class="page-title-right">
            <ol class="breadcrumb m-0">
              <li class="breadcrumb-item"><a href="javascript: void(0);"> Dashboard</a></li>
              {{-- <li class="breadcrumb-item"><a href="javascript: void(0);"> Prodcuts</a></li> --}}
              <li class="breadcrumb-item active"> Subscribe</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <!-- end page title -->




    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="table-responsive"><!-- id="example2" -->
              <table class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th width="5">Sl No.</th>
                    <th>Email</th>
                    <th>Delete</th>
                  </tr>
                </thead>
                <tbody>
                    @if(count($subscribe)>0)
                        @foreach ($subscribe as $key=> $item)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $item->email }}</td>
                                <td><a href="{{ route('admin.subscribe.delete_subscribe', $item->id) }}" onclick="return confirm('Are you sure want to delete this Subscribe ?')"><i class="far fa-trash-alt"></i></a></td>
                            </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="9">No Recourds Found !</td>
                        </tr>
                    @endif
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- end col -->

  </div>
</div>

@endsection
