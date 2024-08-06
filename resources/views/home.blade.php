<x-user.header></x-user.header>
<x-user.navbar></x-user.navbar>
<style>
  .carousel-item img {
      width: 100%;
      height: 500px;
      object-fit: cover;
  }
</style>
<div id="imageCarousel" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
      <!-- Slide 1 -->
      @foreach($sliders as $slider)
      <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
          <img src="{{$slider['image']}}" class="d-block w-100" alt="Image 1">
      </div>
      @endforeach
  </div>
  <a class="carousel-control-prev" href="#imageCarousel" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#imageCarousel" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
  </a>
</div>

<section id="course" class="recent-blog-posts">
  <div class="container" data-aos="fade-up">

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>Selamat. </strong> {{ session('success') }}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
    @endif

    @if (session('galat'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          Terjadi kesalahan ketika melakukan pendaftaran
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          Terjadi kesalahan ketika melakukan pendaftaran
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
    @endif

    @if (session('rusak'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          {{session('rusak')}}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
    @endif

    <div class="section-title">
      <h2>Academy</h2>
      <h3>List <span>Pelatihan</span></h3>
    </div>

    <div class="row mb-2">
      <div class="col-lg-12">
        <div class="input-group d-flex justify-content-center justify-content-md-end px-4">
          <form action="{{ route('home') }}" class="form-inline" method="get">
            <input type="text" value="{{$query}}" name="query" class="form-control" style="max-width: 200px; border-radius: 10px;" placeholder="Cari Pelatihan" aria-label="" aria-describedby="basic-addon2">
            <div class="input-group-append">
              <button class="btn btn-success rounded" style="border-radius: 10px;" type="submit">Cari</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="row">

      @forelse ($rows as $row)
      <!-- Start Post Item -->
      <div class="col-xl-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
        <div class="post-item position-relative h-100">

          <div class="post-img position-relative overflow-hidden">
            <img src="{{$row['image']}}" class="img-fluid" alt="">
            <span class="post-date">{{$row['metode']}}</span>
          </div>

          <div class="post-content d-flex flex-column">

            <h3 class="post-title">{{$row['title']}}</h3>

            <div class="meta d-flex align-items-center">
              <div class="d-flex align-items-center">
                <i class="bi bi-person"></i> <span class="ps-2">{{$row['regist_start']}}</span>
              </div>
              <span class="px-3 text-black-50">/</span>
              <div class="d-flex align-items-center">
                <i class="bi bi-folder2"></i> <span class="ps-2">{{$row['regist_end']}}</span>
              </div>
            </div>
            <hr>
            <p>{{$row['lokasi']}}</p>
            <hr>
            <a href="{{ route('course.detail', ['slug' => $row['slug']]) }}" class="readmore stretched-link">
                <span>Baca Selengkapnya</span>
                <i class="bi bi-arrow-right"></i>
            </a>

          </div>

        </div>
      </div>


      @empty
          <div class="alert alert-danger">
            Pelatihan belum Tersedia.
          </div>
      @endforelse
      <div class="d-flex justify-content-center mt-4">
        {{ $rows->appends(['query' => $query])->links('pagination::bootstrap-5') }}
      </div>

  </div>
</section><!-- End Services Section -->

{{-- <x-user.contact></x-user.contact> --}}
<x-user.footer></x-user.footer>