
  <div class="my-3">
    <h4><b>Rata-rata Harga Komoditi kecamatan {{$kecamatan_detail->name}} pada {{format_indo(request('tanggal'))}}</b></h4>
  </div>
<div class="table-responsive mt-2">
  <table class="table">
    <thead>
      <tr>
        <th>No</th>
        <th>Komoditi</th>
        <th>Harga</th>
        <th>Selisih</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>
        
      @foreach ($data_kecamatan as $row)
     @php
         switch ($row->status) {
          case 'STABIL':
            $status = 'alert-warning';
            $icon = 'fa-circle';
            break;

          case 'NAIK':
            $status = 'alert-danger';
            $icon = 'fa-arrow-up';
            break;

          case 'TURUN':
            $status = 'alert-success';
            $icon = 'fa-arrow-down';
            break;

           case 'KOSONG':
            $status = 'alert-secondary';
            $icon = 'fa-file';
            break;
            
          
          default:
            # code...
            break;
         }
     @endphp
      <tr>
        <td>{{$loop->iteration}}</td>
        <td>{{$row->komoditi->name}}</td> 
        <td>{{format_rupiah($row->harga)}}</td> 
        <td>{{format_rupiah($row->selisih)}}</td>
        <td>
          <div class="alert {{$status}}"><i class="fas {{$icon}}"></i> {{$row->status}}</div>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
  </div>

