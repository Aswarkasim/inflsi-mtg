<div class="row">
  <div class="col-md-8">
    <div class="card">
      <div class="card-body">
        {{-- Make table for data komoditi --}}
        <table class="table">
          <thead>
            <tr>
              <th>Komoditi</th>
              <th>Satuan</th>
              <th>Harga</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($survey_detail as $row)
            <tr>
              <td>{{$row->komoditi->name}}</td>
              <td>{{$row->komoditi->satuan}}</td>
              <td>
                <input type="number" id="update-harga{{$row->id}}" name="harga{{$row->id}}" value="{{$row->harga}}" class="form-control" onchange="updateHarga({{$row->id}})">
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>


<script>

function updateHarga(id){
  console.log('harga')
  var harga = $("[name='harga"+id+"']").val()
  
  $.ajax({
    method:'GET',
    url: '/admin/survey/detail/update?id='+id+'&harga='+harga,
    dataType:'json',
    success: function(data){
      console.log(data)
    }
  });
}

</script>