
<link rel="stylesheet" href="/dist/peta/peta.css">

<svg viewBox="0 0 520 425" id="mateng-map" xmlns="http://www.w3.org/2000/svg">

  <path style="fill:none" d="M0 0h519.916v424.56H0z"/>
  
  @foreach ($rekap as $item)

  @php
      $warna = '#6c757d';

      switch ($item->status) {
        case 'NAIK':
          $warna = '#ff0b0b';
          break;

        case 'TURUN':
          $warna = '#00a859';
          break;

        case 'STABIL':
          $warna = '#ffc107';
          break;
        
        default:
           $warna = '#6c757d';
          break;
      }
  @endphp

  

      <g style="fill:{{$warna}}">

        <title>Kec. {{$item->kecamatan->name}}</title>
        <desc>
          {{-- <image xlink:href="http://res.cloudinary.com/dedebrahma/image/upload/v1509515203/sungai_mesuji_auzieb.jpg" alt="Sungai perbatasan mesuji"></image> --}}
          <p>{{format_rupiah($item->harga)}} </p>
          <small>{{format_rupiah($item->selisih)}}</small>
          <status>{{ mb_strtoupper($item->status)}}</status>
        </desc>
        <path d="{{$item->kecamatan->peta}}"/>
      </g>
      @endforeach
      
    </svg>

    <div id="kecamatanInfo" class="card mb-5 shadow p-3">Papan Informasi</div>

<script src="/dist/peta/peta.js"></script>