{{-- 
<div class="img-wrapper-cover">
  <img src="/img/3.jpg" alt="">
</div> --}}

<div class="img-wrapper-cover">
  <img src="/img/pad.jpg" width="100%" alt="">
</div>



<div class="container my-5">
  <div class="text-center mb-4">
    <h1 class="brush-font text-success"><b>Kontak Kami</b></h1>
    <h5>Anda dapat menghubungi kami dengan mudah</h5>
  </div>
{{-- <hr> --}}
  <div class="row">

    <div class="col-md-6">
      <div class="card p-4 shadow rounded">
        <h3 class=""><strong>Kirim Saran</strong></h3>
        <hr>
        <form action="/contact/send" method="POST">
          @csrf
          <input type="text" class="form-control mb-3 @error('name') is-invalid @enderror" style="height: 50px" name="name" placeholder="Nama Anda">
          @error('name')
            <div class="invalid-feedback">
              {{$message}}
            </div>
          @enderror

          <input type="text" class="form-control mb-3 @error('nohp') is-invalid @enderror" style="height: 50px" name="nohp" placeholder="No. Hp/ WA">
           @error('nohp')
            <div class="invalid-feedback">
              {{$message}}
            </div>
          @enderror


          <input type="text" class="form-control mb-3 @error('subjek') is-invalid @enderror" style="height: 50px" name="subjek" placeholder="Subjek">
           @error('subjek')
            <div class="invalid-feedback">
              {{$message}}
            </div>
          @enderror

          <textarea name="desc" class="form-control @error('name') is-invalid @enderror" placeholder="Pesan Anda" id="" cols="30" rows="10"></textarea>
           @error('desc')
            <div class="invalid-feedback">
              {{$message}}
            </div>
          @enderror

          <button class="btn btn-success mt-3"><i></i><i class="fas fa-paper-plane"></i> Kirim</button>
        </form>
      </div>
    </div>
    <div class="col-md-6">
      
      <div class="d-flex mt-4">
        <i class="far fa-map fa-3x text-orange"></i>
        <div class="px-3">
          <h5 class="text-orange"><strong>Alamat</strong></h5>
          <p>{{$contact->alamat}}</p>
        </div>
      </div>

      <div class="d-flex mt-4">
        <i class="fas fa-phone fa-3x text-orange"></i>
        <div class="px-3">
          <h5 class="text-orange"><strong>Telepon</strong></h5>
          <p>{{$contact->no_telp}}</p>
        </div>
      </div>

       <div class="d-flex mt-4">
        <i class="fas fa-envelope fa-3x text-orange"></i>
        <div class="px-3">
          <h5 class="text-orange"><strong>Email</strong></h5>
          <p>{{$contact->email}}</p>
        </div>
      </div>


      <div class="ratio ratio-4x3">

        {!!$contact->maps!!}
      </div>
      
      
    </div>
    </div>
</div>

