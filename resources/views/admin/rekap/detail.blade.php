<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-body">
        {{-- Make table for data komoditi --}}

        <div class="row">
          <div class="col-md-4">
            <table class="table">
               <td>Tanggal</td>
                {{-- <td>: {{$rekap->tanggal}}</td> --}}
            </tr>
            </table>
          </div>
{{-- @php
    echo 'Survery ID :'.$rekap->id;
@endphp --}}
          <div class="col-md-8">
            <form action="/admin/rekap/detail" method="POST">

              @csrf

              {{-- <input type="hidden" name="rekap_id" value="{{$rekap->id}}"> --}}
              <div class="row">
                <div class="col-md-6">

                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">Harga</label>
                    <input type="number" class="form-control" name="harga" required placeholder="0">
                  </div>
                </div>
              </div>
              
              <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Tambah</button>
            </form>
          </div>
        </div>

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
            @foreach ($rekap_detail as $row)

            @isset($row->komoditi)
                
            <tr>
              <td>{{$row->komoditi->name}}</td>
               @foreach ($kecamatan as $k)
              <td>
                @php
                    $rekap = \App\Models\RekapSurvey::with('komoditi')->whereKomoditiId($row->komoditi_id)->whereTanggal($rekap_tanggal)->whereKecamatanId($k->id)->first();
                    echo isset($rekap) ? format_rupiah($rekap->harga) : '';
                @endphp
              </td>
              
              @endforeach
            </tr>

            @endisset

            @endforeach
          </tbody>
        </table>
        </div>
      </div>
    </div>
  </div>
</div>

