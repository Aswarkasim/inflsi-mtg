<div class="img-wrapper-cover">
  <img src="/img/pad.jpg" width="100%" alt="">
</div>

<div class="container">

  <div class="row mt-4">
    <div class="col-md-8">
      <h4 class="text-success"><strong>RATA RATA HARGA KOMODITI TERKINI</strong></h4>
    </div>

    <div class="col-md-4">
        <form action="/komoditi" method="GET">
        <span class="">
          <div class="input-group">


            <select class="form-select" name="kecamatan_id">
              <option>Pilih Kecamatan</option>
              @foreach ($kecamatan as $item)
                  <option value="{{$item->id}}" {{$item->id == request('kecamatan_id') ? 'selected' : '';}}>{{$item->name}}</option>
              @endforeach
            </select>
            
              <button type="submit" class="btn btn-success" type="button"><i class="fas fa-search"></i> Cari</button>
            </div>
            
          </span>
        </form>
      </div>

  </div>
  <div class="row mt-3">
    
    @foreach ($rekap as $item)
        
      <div class="col-md-2 mt-3">
        <div class="card card-komoditi shadow">
          <div class="img-wrapper-komoditi">
            <img src="/{{$item->komoditi->gambar}}" class="card-img-top" width="100%" alt="...">
          </div>
          <div class="card-body">
            <p class="card-title">{{$item->komoditi->name}} </p>
            <h6><strong>{{format_rupiah($item->harga)}}/{{$item->komoditi->satuan->name}}</strong></h6><br>
            
            @php
            $alert = '';
            $icon = '';
                switch ($item->status) {
                  case 'NAIK':
                    $alert = 'danger';
                    $icon = 'fa-arrow-up';
                    break;

                  case 'TURUN':
                    $alert = 'success';
                    $icon = 'fa-arrow-down';
                    break;
                  
                  case 'STABIL':
                    $alert = 'warning';
                     $icon = 'fa-circle';
                    break;

                  case 'KOSONG':
                    $alert = 'secondary';
                     $icon = 'fa-file';
                    break;

                    
                  
                  default:
                    # code...
                    break;
                }
            @endphp
            <div class="alert alert-{{$alert}}"><i class="fas {{$icon}}"></i> {{$item->status . ' '. format_rupiah($item->selisih)}}</div>
          </div>
        </div>
      </div>
      
      @endforeach        
    </div>

    <div class="d-flex justify-content-center mt-5">

        {{$rekap->appends(request()->except('page'))->links()}}
      
    </div>
  </div>

  <div class="container">
    <div class="row">
      <div class="col-md-8">
        <h3 class="card-title text-success"><strong>Fluktuasi Harga</strong></h3>
      </div>
      <div class="col-md-4">
         <form action="/komoditi" method="GET">
          <input type="hidden" value="{{request('kecamatan_id')}}" name="kecamatan_id">
            <span class="">
              <div class="input-group">
                <select class="form-select" name="komoditi_id">
                  <option>Pilih Komoditi</option>
                  @foreach ($komoditi as $item)
                      <option value="{{$item->id}}" {{$item->id == request('komoditi_id') ? 'selected' : '';}}>{{$item->name}}</option>
                  @endforeach
                </select>
                
                  <button type="submit" class="btn btn-success" type="button"><i class="fas fa-search"></i> Cari</button>
                </div>
                
              </span>
            </form>
      </div>
    </div>
      <div class="row">
          <div class="col-md-12">
            <!-- AREA CHART -->
            <div class="card shadow">

              </div>
              <div class="card-body">
                <div class="chart">
                  <canvas id="areaChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

          </div>
    </div>
  </div>
{{-- <script src="/plugins/jquery/jquery.min.js"></script> --}}
  <script src="/plugins/chart.js/Chart.min.js"></script>

  
<script>
  $(function () {
    /* ChartJS
     * -------
     * Here we will create a few charts using ChartJS
     */

    //--------------
    //- AREA CHART -
    //--------------

    // Get context with jQuery - using jQuery's .get() method.
    var areaChartCanvas = $('#areaChart').get(0).getContext('2d')

    var areaChartData = {
      labels  : ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
      datasets: [
        {
          label               : 'Digital Goods',
          backgroundColor     : '#00a859',
          borderColor         : '#00a859',
          pointRadius          : false,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : [28, 48, 40, 19, 86, 27, 90]
        },
      ]
    }

    var areaChartOptions = {
      maintainAspectRatio : false,
      responsive : true,
      legend: {
        display: false
      },
      scales: {
        xAxes: [{
          gridLines : {
            display : false,
          }
        }],
        yAxes: [{
          gridLines : {
            display : false,
          }
        }]
      }
    }

    // This will get the first returned node in the jQuery collection.
    new Chart(areaChartCanvas, {
      type: 'line',
      data: areaChartData,
      options: areaChartOptions
    })

  })
</script>