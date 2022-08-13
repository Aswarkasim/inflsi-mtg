<div class="row">
  <div class="col-md-12">

<div class="card">
<div class="card-body">
  <a href="/admin/rekap/create" class="btn btn-primary mb-3"><i class="fa fa-sync-alt"></i> Sinkronasi</a>

  <div class="float-right">
    <form action="" method="get">
    <div class="input-group input-group-sm">
        <input type="text" name="cari" class="form-control" placeholder="Cari..">
        <span class="input-group-append">
          <button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-search"></i></button>
          <a href="/admin/rekap" class="btn btn-info btn-flat"><i class="fa fa-sync-alt"></i></a>
        </span>
      </div>
      </form>
  </div>
<table id="example1" class="table table-striped">
  <thead>
    <tr>
      <th>No</th>
      <th>Tanggal</th>
      <th>Action</th>
    </tr>
  </thead>

  <tbody>
    @foreach ($rekap as $row)
        
    <tr>
      <td width="50px">{{$loop->iteration}}</td>
      <td><a href="/admin/rekap/detail/{{$row->id}}"><b> {{$row->tanggal}}</b></a></td>
      <td>
         <form action="/admin/rekap/delete/{{$row->id}}" method="post">
            @method('delete')
            @csrf
            <button type="submit" class="btn btn-danger" id="delete"><i class="fa fa-times"></i> Hapus</button>
          </form>
      </td>
    </tr>

    @endforeach

  </tbody>
</table>

  <div class="float-right">
    {{$rekap->links()}}
  </div>
</div>
</div>

  </div>
</div>

<!-- /.card-body -->


