  @if (isset($data_survey))

  <div class="my-3">
    <h4><b>Rata-rata harga komditi kecamatan se-Mamuju Tengah</b></h4>
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