<div class="row">
  <div class="col-md-6">
    <div class="p-3  card">
      <div class="card-body">

        @if (Request::is('admin/komoditi/komoditi/create'))
          <form action="/admin/komoditi/komoditi" method="POST" enctype="multipart/form-data">  
        @else 
          <form action="/admin/komoditi/komoditi/{{$komoditi->id}}" method="POST" enctype="multipart/form-data">  
            @method('PUT')
        @endif
          @csrf
          <div class="form-group">
            <label for="">Nama</label>
            <input type="text" class="form-control  @error('name') is-invalid @enderror"  name="name"  value="{{isset($komoditi) ? $komoditi->name : old('name')}}" placeholder="Nama">
             @error('name')
                <div class="invalid-feedback">
                  {{$message}}
                </div>
             @enderror
          </div>
          
          <div class="form-group">
            <label for="">Satuan</label>
            <select name="satuan_id" class="form-control @error('satuan_id') is-invalid @enderror" id="">
              <option value="">-- Satuan --</option>
              @foreach ($satuan as $item)
                  <option value="{{$item->id}}" {{isset($komoditi) ? $item->id == $komoditi->satuan_id ? 'selected' : '' : ''}}>{{$item->name}}</option>
              @endforeach
            </select>
             @error('satuan_id')
                <div class="invalid-feedback">
                  {{$message}}
                </div>
             @enderror
          </div>

          <div class="form-group">
            <label for="">Deskripsi</label>
            <input type="text" class="form-control  @error('desc') is-invalid @enderror"  name="desc"  value="{{isset($komoditi) ? $komoditi->desc : old('desc')}}" placeholder="Deskripsi">
             @error('desc')
                <div class="invalid-feedback">
                  {{$message}}
                </div>
             @enderror
          </div>

          <div class="form-group">
            <label for="">Gambar</label>
            <input type="file" class="form-control  @error('gambar') is-invalid @enderror"  name="gambar"  value="{{isset($komoditi) ? $komoditi->gambar : old('gambar')}}" placeholder="Gambar">
             @error('gambar')
                <div class="invalid-feedback">
                  {{$message}}
                </div>
             @enderror
             <br>
             @if (isset($komoditi))
              <img src="/{{$komoditi->gambar}}" width="100px" alt="">
                 
             @endif
          </div>

     {{-- {!!form_input($errors, 'name', 'Nama', isset($komoditi) ? $komoditi : null)!!} --}}

          <a href="/admin/komoditi/komoditi" class="btn btn-info "><i class="fa fa-arrow-left"></i> Kembali</a>
         <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
        
        </form>
      </div>
    </div>
  </div>
</div>

