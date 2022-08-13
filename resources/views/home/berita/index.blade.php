<div class="img-wrapper-cover">
  <img src="/img/pad.jpg" width="100%" alt="">
</div>

<div class="container my-4">

  <div class="row">
    <div class="col-md-8">
      <div class="text-success py-4"><h4><strong>Berita Terbaru</strong></h4></div>
      
      @foreach ($post as $item)
          
      <div class="card mt-2 shadow-sm rounded">
        <div class="d-flex">
          <img src="/{{$item->image}}" width="200px" alt="">
          
          <div class="content-text p-4">
            <h5><a href="" class="text-decoration-none"><strong>{{$item->title}}</strong></a></h5>
            <p>{{$item->excerpt}}</p>
          </div>
        </div>
      </div>

      @endforeach
    </div>

    <div class="col-md-4">
      <div class="text-success py-4"><h4><strong>Kategori</strong></h4></div>
      <div class="card p-3">
        @foreach ($kategori as $item)
        <a href="" class="text-decoration-none my-2"><strong>{{$item->name}}</strong></a>
        @endforeach
      </div>

      <div class="text-success pt-4"><h4><strong>Berita Tentang Pasar</strong></h4></div>
      <div class="card p-3">
        @foreach ($kategori as $item)
          <div class="card mt-2 shadow-sm rounded">
            <div class="d-flex" >
              <div class="" style="width: 100px; max-height: 100px; overflow: hidden;">
                <img src="/img/pad.jpg" width="100%" alt="">
              </div>
              <div class="p-3">
                <a href = "" class="text-decoration-none">Judul berita Terkait</a>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>


    </div>

    

  </div>
</div>