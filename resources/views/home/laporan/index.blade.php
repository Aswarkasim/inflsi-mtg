<div class="container my-4">
  <div class="row">
    <div class="text-center">
      <h4><strong>LAPORAN INFLASI DAERAH</strong></h4>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <form action="/laporan/show" method="get">
        {{-- @csrf --}}
        <input type="hidden" name="show" value="true">
        <div class="input-group">
            <select class="form-select" name="kecamatan_id" id="kecamatan">
              <option>Pilih Kecamatan</option>
              @foreach ($kecamatan as $item)
              <option value="{{$item->id}}">{{$item->name}}</option>
              @endforeach
              
            </select>

            
            <select class="form-select" name="pasar_id" id="pasar">
              <option>Pilih Pasar</option>
            </select>

            <input type="date" name="tanggal" class="form-control">
            {{-- <input type="date" name="date_start" class="form-control"> --}}
            {{-- <input type="date" name="date_end" class="form-control"> --}}
            
            <button type="submit" class="btn btn-success" type="button">Tampilkan</button>
          </div>

        </form>
    </div>
    {{-- <div class="col-md-4"></div> --}}
  </div>


  @if (isset($data_survey))
    <div class="table-responsive mt-2">
        <table class="table">
          <thead>
            <tr>
              <th>Komoditi</th>
              @foreach ($kecamatan as $k)
              <th>{{$k->name}}</th>
              @endforeach
            </tr>
          </thead>
          <tbody>
            @foreach ($data_survey as $row)
            <tr>
              <td>{{$row->komoditi->name}}</td>
               @foreach ($kecamatan as $k)
              <td>
                @php
                    $rekap = \App\Models\RekapSurvey::with('komoditi')->whereKomoditiId($row->komoditi_id)->latest('tanggal')->whereKecamatanId($k->id)->first();
                    echo isset($rekap) ? format_rupiah($rekap->harga) : '';
                @endphp
              </td>
              
              @endforeach
            </tr>
            @endforeach
          </tbody>
        </table>
        </div>

      
  @endif

  {{-- <div class="alert alert-info mt-4 p-4">
    <i class="fas fa-info"></i> Belum ada data
  </div> --}}

  <div class="row mt-4">
    <div class="col-md-12">

    </div>

    
  </div>
</div>

        {{-- <script src="/plugins/jquery/jquery.min.js"></script> --}}

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

  </script>