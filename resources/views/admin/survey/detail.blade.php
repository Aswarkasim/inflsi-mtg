<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-body">
        {{-- Make table for data komoditi --}}

        <div class="row">
          <div class="col-md-4">
            <table class="table">
               <td>Tanggal</td>
                <td>: {{$survey->tanggal}}</td>
            </tr>
              <tr>
                <td>Nama Pasar</td>
                <td>: {{$survey->pasar->name}}</td>
              </tr>
            </table>
          </div>
{{-- @php
    echo 'Survery ID :'.$survey->id;
@endphp --}}
          <div class="col-md-8">
            <form action="/admin/survey/detail" method="POST">

              @csrf

              <input type="hidden" name="survey_id" value="{{$survey->id}}">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">

                   
                    <label for="">Komoditi</label>
                    <select name="komoditi_id" id="" required class="form-control">
                      {{-- <option value="">--Komoditi---</option> --}}
                      @foreach ($komoditi as $item)
                       @php
                        $cek = \App\Models\SurveyDetail::whereSurveyId($survey->id)->whereKomoditiId($item->id)->first();
                        if(!$cek){
                          echo '<option value="'.$item->id.'">'.$item->name.'</option>';
                        }
                      @endphp
                      
                      @endforeach
                    </select>
                  </div>
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
              <th>Satuan</th>
              <th>Harga</th>
              <th>Selisih</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($survey_detail as $row)

            @isset($row->komoditi)
                
            <tr>
              <td>{{$row->komoditi->name}}</td>
              <td>{{$row->komoditi->satuan->name}}</td>
              <td>{{format_rupiah($row->harga)}}</td>
              <td>{{format_rupiah($row->range)}}</td>
              <td>{{$row->status}}</td>
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

