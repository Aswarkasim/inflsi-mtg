<div class="row">
  <div class="col-md-4">
    <div class="p-3  card">
      <div class="card-body">

        @if (Request::is('admin/survey/create'))
          <form action="/admin/survey" method="POST" enctype="multipart/form-data">  
        @else 
          <form action="/admin/survey/{{$survey->id}}" method="POST" enctype="multipart/form-data">  
            @method('PUT')
        @endif
          @csrf


          <div class="form-group">
            <label for="">Tanggal</label>
            <input type="date" class="form-control  @error('tanggal') is-invalid @enderror"  name="tanggal"  value="{{isset($survey) ? $survey->tanggal : old('tanggal')}}" placeholder="Nama">
             @error('tanggal')
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
                  <option value="{{$k->id}}" {{ isset($survey) ? $survey->kecamatan_id == $k->id ? 'selected' : '' : ''  }}>{{$k->name}}</option>
              @endforeach
            </select>
             @error('kecamatan_id')
                <div class="invalid-feedback">
                  {{$message}}
                </div>
             @enderror
          </div>

           {{-- <div class="form-group">
            <label for="">Desa</label>
           <select class="form-control" id="desa" name="desa_id" disabled required>
              <option value="">--Pilih Desa--</option>
            </select>
             @error('desa_id')
                <div class="invalid-feedback">
                  {{$message}}
                </div>
             @enderror
          </div> --}}

            <div class="form-group">
            <label for="">Pasar</label>
           <select class="form-control" id="pasar" name="pasar_id" disabled required>
              <option value="">--Pilih Pasar--</option>
            </select>
             @error('pasar_id')
                <div class="invalid-feedback">
                  {{$message}}
                </div>
             @enderror
          </div>

          {{-- <div class="form-group">
            <label for="">Pasar</label>
            <select name="pasar_id" class="form-control @error('pasar_id') is-invalid @enderror" id="">
              <option value="">-- Pasar --</option>
              @foreach ($pasar as $d)
                  <option value="{{$d->id}}" {{ isset($survey) ? $survey->pasar_id == $k->id ? 'selected' : '' : ''}}>{{$d->name}}</option>
              @endforeach
            </select>
             @error('pasar_id')
                <div class="invalid-feedback">
                  {{$message}}
                </div>
             @enderror
          </div> --}}


     {{-- {!!form_input($errors, 'name', 'Nama', isset($survey) ? $survey : null)!!} --}}

          <a href="/admin/survey" class="btn btn-info "><i class="fa fa-arrow-left"></i> Kembali</a>
         <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
        
        </form>
      </div>
    </div>
  </div>
</div>

<script>

    $(document).ready(function(){
    $('#kecamatan option[value=""]').prop('selected',true);
    // $('#pasar option[value!=""]').remove();

    kecamatan = $('#kecamatan')
    kecamatan.on('change', function() {
        $this = $(this)
        pasar = $('#pasar')

        if ($this.val() !== '') {
            $.ajax({
                url: "{{url('/region/get-pasar-by-kecamatan')}}" +'/' +$this.val() , 
                type: 'GET',
                dataType: 'json',
                success: function(response){
                    if (response !== 'NOT OK') {
                        pasar.removeAttr('disabled')
                        pasar.html(response)
                    }
                }
            });
        } else {
            pasar.prop('disabled', true)
            pasar.find('option').val('').text('Pilih Pasar')
        }
    })  
  });

  
  // $(document).ready(function(){
  //   $('#kecamatan option[value=""]').prop('selected',true);
  //   $('#desa option[value!=""]').remove();

  //   kecamatan = $('#kecamatan')
  //   kecamatan.on('change', function() {
  //       $this = $(this)
  //       desa = $('#desa')

  //       if ($this.val() !== '') {
  //           $.ajax({
  //               url: "{{url('/region/get-desa')}}" +'/' +$this.val() , 
  //               type: 'GET',
  //               dataType: 'json',
  //               success: function(response){
  //                   if (response !== 'NOT OK') {
  //                       desa.removeAttr('disabled')
  //                       desa.html(response)
  //                   }
  //               }
  //           });
  //       } else {
  //           desa.prop('disabled', true)
  //           desa.find('option').val('').text('Pilih Desa')
  //       }
  //   })  
  // });


  // $(document).ready(function(){
  //   $('#desa option[value=""]').prop('selected',true);
  //   $('#pasar option[value!=""]').remove();

  //   desa = $('#desa')
  //   desa.on('change', function() {
  //       $this = $(this)
  //       pasar = $('#pasar')

  //       if ($this.val() !== '') {
  //           $.ajax({
  //               url: "{{url('/region/get-pasar')}}" +'/' +$this.val() , 
  //               type: 'GET',
  //               dataType: 'json',
  //               success: function(response){
  //                   if (response !== 'NOT OK') {
  //                       pasar.removeAttr('disabled')
  //                       pasar.html(response)
  //                   }
  //               }
  //           });
  //       } else {
  //           pasar.prop('disabled', true)
  //           pasar.find('option').val('').text('Pilih Pasar')
  //       }
  //   })
  // });
</script>