<div class="row">
  <div class="col-md-6">
    <div class="p-3  card">
      <div class="card-body">

        @if (Request::is('admin/komoditi/satuan/create'))
          <form action="/admin/komoditi/satuan" method="POST">  
        @else
          <form action="/admin/komoditi/satuan/{{$satuan->id}}" method="POST">  
            @method('PUT')
        @endif
          @csrf
          <div class="form-group">
            <label for="">Nama</label>
            <input type="text" class="form-control  @error('name') is-invalid @enderror"  name="name"  value="{{isset($satuan) ? $satuan->name : old('name')}}" placeholder="Nama">
             @error('name')
                <div class="invalid-feedback">
                  {{$message}}
                </div>
             @enderror
          </div>

           <div class="form-group">
            <label for="">Desc</label>
            <input type="text" class="form-control  @error('desc') is-invalid @enderror"  name="desc"  value="{{isset($satuan) ? $satuan->desc : old('desc')}}" placeholder="Desc">
             @error('desc')
                <div class="invalid-feedback">
                  {{$message}}
                </div>
             @enderror
          </div>

     {{-- {!!form_input($errors, 'name', 'Nama', isset($satuan) ? $satuan : null)!!} --}}

          <a href="/admin/komoditi/satuan" class="btn btn-info "><i class="fa fa-arrow-left"></i> Kembali</a>
         <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
        
        </form>
      </div>
    </div>
  </div>
</div>

