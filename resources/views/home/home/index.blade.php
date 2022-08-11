 <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
       @foreach ($banner as $item => $key)
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
     @endforeach
    </div>
    <div class="carousel-inner">

      @foreach ($banner as $item)
      <div class="carousel-item {{$item->urutan == '1' ? 'active' : ''}}">
        {{-- <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="100%" height="100%" fill="#777"/></svg> --}}
        <img class="first-slide" src="{{$item->image}}" alt="First slide">
       
      </div>
      @endforeach

    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>


  <div class="container">
    <div class="row">
      <div class="col-md-8">
        <h3><b>Peta Perubahan Harga</b></h3>
        <div class="alert bg-success text-white"><i class="fas fa-history"></i> Diperbaharui pada {{format_indo(date('Y-m-d'))}}</div>
      </div>
      <div class="col-md-4">
        <form action="/" method="GET">
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
    <div class="col-md-8"> 
      <div class="wrapper-peta">
        @include('home.home.peta')

         <div class="row">
          <div class="col-md-3">
            <div class="py-3 mt-1 badge bg-success" style="width: 100%">Turun</div>
          </div>
           <div class="col-md-3">
            <div class="py-3 mt-1 badge bg-danger" style="width: 100%">Naik</div>
          </div>
           <div class="col-md-3">
            <div class="py-3 mt-1 badge bg-warning" style="width: 100%">Stabil</div>
          </div>
          <div class="col-md-3">
            <div class="py-3 mt-1 badge bg-info" style="width: 100%">Terpilih</div>
          </div>
        </div>

      </div>

    </div>

  <div class="col-md-4">

    <div class="wrapper-komoditi-peta">

    @foreach ($rekap as $item)
        
    <div class="row">
      <div class="col-md-7">
        <div class="text-success">
          <span>Kec. {{$item->kecamatan->name}}</span>
          <h5><strong>{{format_rupiah($item->harga)}}</strong></h5>
        </div>

        
      </div>

      @switch($item->status)
          @case('NAIK')
              <div class="col-md-4">
                    <div class="alert alert-danger"><i class="fas fa-arrow-up"></i> Naik <small>{{format_rupiah($item->selisih)}}</small></div>
              </div>
              @break
          @case('TURUN')
              <div class="col-md-4">
                    <div class="alert alert-success"><i class="fas fa-arrow-down"></i> Turun <small>{{format_rupiah($item->selisih)}}</small></div>
              </div>
              @break
          
          @case('STABIL')
              <div class="col-md-4">
                    <div class="alert alert-warning"><i class="fas fa-arrow-circle-o"></i> Stabil <small>{{format_rupiah($item->selisih)}}</small></div>
              </div>
              @break
          @default
              
      @endswitch
      
    </div>
        
        
  
      <hr>
    @endforeach

    </div>
    </div>
    
  </div>
</div>

<div class="p-5 bg-blue">
<div class="container my-5 ">
  <div class="row">
    <div class="col-md-12">
      <div class="row">
        <div class="col-md-8">
          <span>
            <h3><b>Perubahan Harga Komoditi</b></h3>
            <div class="badge bg-success"><i class="fas fa-history"></i> Diperbaharui pada </div>
          </span>
        </div>

        <div class="col-md-4">
          <span class="">
            <div class="input-group">
                <select class="form-select" id="inputGroupSelect04" aria-label="Example select with button addon">
                  <option selected>Pilih Kecamatan</option>
                  <option value="1">One</option>
                </select>

                <select class="form-select" id="inputGroupSelect04" aria-label="Example select with button addon">
                  <option selected>Pilih Pasar</option>
                  <option value="1">One</option>
                </select>
                
                <button class="btn btn-success" type="button">Button</button>
              </div>

              </span>
        </div>
      </div>

      <div class="row mt-3">

        @foreach ($rekapByKecamatan as $item)
            
        <div class="col-md-2">
          <div class="card card-komoditi">
            <div class="img-wrapper-komoditi">
              <img src="/{{$item->komoditi->gambar}}" class="card-img-top" width="100%" alt="...">
            </div>
            <div class="card-body">
              <p class="card-title">{{$item->komoditi->name}} </p>
              <h6><strong>{{format_rupiah($item->harga)}}/{{$item->komoditi->satuan}}</strong></h6><br>
              <div class="alert alert-success"><i class="fas fa-arrow-down"></i> Turun Rp. 2.000</div>
            </div>
          </div>
        </div>

        @endforeach        
      </div>

      <div class="text-center mt-3">
        <a href="" class="btn btn-success">Lihat Selengkapnya &RightArrow;</a>
      </div>
    </div>
  </div>
</div>
</div>
