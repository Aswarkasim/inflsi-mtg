<table>
  <thead>
    <tr>
      <td>Tanggal</td>
      <td>Kecamatan</td>
      <td>Komoditi</td>
      <td>Harga</td>
      <td>Selisih Harga Sebelumnya</td>
      <td>Status</td>
    </tr>
  </thead>
  <tbody>
    @foreach ($rekap as $item)
    <tr>
      <td>{{$item->tanggal}}</td>
      <td>{{$item->kecamatan_name}}</td>
      <td>{{$item->komoditi_name}}</td>
      <td>{{$item->harga}}</td>
      <td>{{$item->selisih}}</td>
      <td>{{$item->status}}</td>
    </tr>
    @endforeach
  </tbody>
</table>