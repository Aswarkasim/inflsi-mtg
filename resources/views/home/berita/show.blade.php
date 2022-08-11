<style>

</style>
<div class="img-wrapper-cover">
  <img src="/{{$wisata->cover}}" width="100%" alt="">
</div>

<div class="bg-cream py-4">
  <div class="container">
    <h3><strong>{{$wisata->name}}</strong></h3>
     <div class="d-flex">
        <h6 class="price-wisata text-primary"><b>{{format_rupiah($wisata->harga)}}</b></h6>
        <h6 class="text-muted">/Per {{$wisata->satuan}}</h6> 
      </div>
  </div>
</div>

<div class="container py-5">
  <div class="row">
    <div class="col-md-7">
      
       <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/">Home</a></li>
          <li class="breadcrumb-item"><a href="/wisata">Wisata</a></li>
          <li class="breadcrumb-item active" aria-current="page">Detail - {{$wisata->name}} </li>
        </ol>
      </nav>

      <h3><b>Deskripsi</b></h3>
      <p>{!!$wisata->desc!!}</p>

     {{-- {!!$wisata->maps!!} --}}

     {{-- <iframe src="{{$wisata->maps}}" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe> --}}
 <div class="ratio ratio-4x3">
     {!!$wisata->maps!!}
 </div>
    </div>

    <div class="col-md-5">
      <div class="bg-cream p-3">
        <h4><strong>Akses</strong></h4>
        <div class="form-group mt-2">
          <label for="" class="text-primary"><b>Kecamatan</b></label><br>
          <span class="text-muted"><strong><i class="fas fa-map-marker-alt"></i> {{$wisata->kecamatan->name}}</strong></span>
        </div>
          <hr>
        <div class="form-group mt-2">
          <label for="" class="text-primary"><b>Alamat</b></label><br>
          <span class="text-muted"><strong><i class="fas fa-map-marked-alt"></i> {{$wisata->alamat}}</strong></span>
        </div>
        <hr>
        <div class="form-group mt-2">
          <label for="" class="text-primary"><b>Kontak Person</b></label><br>
          <span class="text-muted"><strong><i class="fas fa-phone"></i> {{$wisata->nohp}}</strong></span>
          <a href="https://wa.me/{{$wisata->nohp}}" target="blank" class="btn btn-wisata mt-3"><i class="fas fa-phone"></i> Hubungi Sekarang</a>
        </div>

      </div>
      
      <div class="mt-5">
        <h4><strong>Saran Destinasi</strong></h4>
      </div>

      @foreach($saran as $item)
          @if ($item->id != $wisata->id)
              
          <div class="wrapper-card-saran p-2 mt-2">
            <div class="d-flex">
              <div class="img-wrapper-saran">
                <img src="/{{$item->cover}}" width="200px" alt="">
              </div>
              <div class="d-block p-3">
                <h6><a href="/wisata/detail/{{$item->id}}" class="price-wisata text-primary text-decoration-none"><strong>{{$item->name}}</strong></a></h6>
                <span><i class="fas fa-map-marker-alt"></i> Kec. Karossa</span>
              </div>
            </div>
          </div>
          
          @endif
          @endforeach

    </div>
  </div>
</div>