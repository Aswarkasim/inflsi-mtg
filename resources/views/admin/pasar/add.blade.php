<div class="row">
  <div class="col-md-6">
    <div class="p-3  card">
      <div class="card-body">

        @if (Request::is('admin/master/pasar/create'))
          <form action="/admin/master/pasar" method="POST">  
        @else
          <form action="/admin/master/pasar/{{$pasar->id}}" method="POST">  
            @method('PUT')
        @endif
          @csrf
          <div class="form-group">
            <label for="">Nama</label>
            <input type="text" class="form-control  @error('name') is-invalid @enderror"  name="name"  value="{{isset($pasar) ? $pasar->name : old('name')}}" placeholder="Nama">
             @error('name')
                <div class="invalid-feedback">
                  {{$message}}
                </div>
             @enderror
          </div>

          <div class="form-group">
            <label for="">Kecamatan</label>
            <select name="kecamatan_id" id="kecamatan" class="form-control @error('kecamatan_id') is-invalid @enderror" id="">
              <option value="">-- Kecamatan --</option>
              @foreach ($kecamatan as $k)
                  <option value="{{$k->id}}" {{ isset($pasar) ? $pasar->kecamatan_id == $k->id ? 'selected' : '' : ''  }}>{{$k->name}}</option>
              @endforeach
            </select>
             @error('kecamatan_id')
                <div class="invalid-feedback">
                  {{$message}}
                </div>
             @enderror
          </div>

           <div class="form-group">
            <label for="">Desa</label>
           <select class="form-control" id="desa" name="desa_id" disabled required>
              <option value="">--Pilih Desa--</option>
            </select>
             @error('desa_id')
                <div class="invalid-feedback">
                  {{$message}}
                </div>
             @enderror
          </div>

     {{-- {!!form_input($errors, 'name', 'Nama', isset($pasar) ? $pasar : null)!!} --}}

          <a href="/admin/master/pasar" class="btn btn-info "><i class="fa fa-arrow-left"></i> Kembali</a>
         <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
        
        </form>
      </div>
      
    </div>
  </div>
</div>


<script>
  $(document).ready(function(){
    $('#kecamatan option[value=""]').prop('selected',true);
    $('#desa option[value!=""]').remove();

    kecamatan = $('#kecamatan')
    kecamatan.on('change', function() {
        $this = $(this)
        desa = $('#desa')

        if ($this.val() !== '') {
            $.ajax({
                url: "{{url('/region/get-desa')}}" +'/' +$this.val() , 
                type: 'GET',
                dataType: 'json',
                success: function(response){
                    if (response !== 'NOT OK') {
                        desa.removeAttr('disabled')
                        desa.html(response)
                    }
                }
            });
        } else {
            desa.prop('disabled', true)
            desa.find('option').val('').text('Pilih Kecamatan')
        }
    })  
  });
</script>

