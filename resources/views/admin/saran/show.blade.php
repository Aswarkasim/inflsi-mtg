<div class="row">
  <div class="col-md-6">

    <a href="/admin/saran" class="btn btn-primary my-2"><i class="fas fa-arrow-left"></i> Kembali</a>
<div class="card card-primary card-outline">
  <div class="card-header">
    <h3 class="card-title">Saran dan masukan dari {{$saran->name}}</h3>

    {{-- <div class="card-tools">
      <a href="#" class="btn btn-tool" title="Previous"><i class="fas fa-chevron-left"></i></a>
      <a href="#" class="btn btn-tool" title="Next"><i class="fas fa-chevron-right"></i></a>
    </div> --}}
  </div>
  <!-- /.card-header -->
  <div class="card-body p-0">
    <div class="mailbox-read-info">
      <h5>{{$saran->subjek}}</h5>
      <h6>Dari: {{$saran->name}}
        <span class="mailbox-read-time float-right">{{$saran->created_at}}</span></h6>
    </div>
    <!-- /.mailbox-read-info -->
    <div class="mailbox-controls with-border text-center">


    </div>
    <!-- /.mailbox-controls -->
    <div class="mailbox-read-message">
     {{$saran->desc}}
    </div>
    <!-- /.mailbox-read-message -->
  </div>

  <!-- /.card-footer -->
  <div class="card-footer">
    {{-- <a href="/admin/saran/delete/{{$saran->id}}" class="btn btn-default"><i class="far fa-trash-alt"></i> Hapus</a> --}}
  </div>
  <!-- /.card-footer -->
</div>


</div>
</div>