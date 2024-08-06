<x-admin.header></x-admin.header>
<style>
  .is-invalid {
      border-color: red;
  }
  .is-valid {
      border-color: green;
  }
  .invalid-feedback {
      color: red;
      display: none;
  }
  .valid-feedback {
      color: green;
      display: none;
  }
</style>
<div class="page-heading">
    <h3>Daftar Semua Pelatihan</h3>
</div>
<div class="page-content">
  <section class="row">
    <div class="col-12 col-lg-12">
        <p>
          @if (session('success'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          @endif

          @if (session('danger'))
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('danger') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          @endif

          @if (session('warning'))
          <div class="alert alert-warning alert-dismissible fade show" role="alert">
            {{ session('warning') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          @endif

          @if (session('galat'))
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('galat') }}
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



        <form action="{{ route('admin.course') }}" class="form-inline" method="get">
          <button class="btn btn-outline-primary mr-1 my-1" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
            Tambah Data
          </button>
          <div class="row gx-0">
            <div class="col-lg-9 col-6">
              <input type="text" value="{{$query}}" name="query" class="form-control w-100" placeholder="Cari Pelatihan">
            </div>
            <div class="col-lg-3 col-6">
              <button type="submit" class="btn btn-outline-success">Cari</button>
            </div>
          </div>
        </form>
        </p>
        <div class="collapse" id="collapseExample">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Tambah Data</h4>
            </div>
            <div class="card-body">
              <form id="participantForm" novalidate action="{{ route('admin.course.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="row">
                  <div class="col-md-6 col-6">
                    <div class="form-group">
                      <label for="title">Judul Pelatihan</label>
                      <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
                      <span class="invalid-feedback">Judul Pelatihan wajib diisi.</span>
                    </div>

                    

                    <div class="form-group">
                      <label for="image">Unggah Gambar</label>
                      <small class="text-muted"><i>Maximal 2Mb,Ukuran 1000x2000px</i></small>
                      <input type="file" class="form-control-file form-control" id="image" name="image" accept="image/*">
                      @error('image')
                      <span class="text-danger">Hanya gambar dengan ukuran maksimal 2 MB yang diperbolehkan.</span>
                      @enderror
                    </div>

                    <div class="form-group">
                      <img src="https://via.placeholder.com/1000x500" height="220px" width="100%" alt="">
                    </div>
                  </div>
                  <div class="col-md-6 col-6">
                    <div class="form-group">
                      <label for="title">Tanggal Pendaftaran</label>
                      <div class="row">
                        <div class="col-md-6 col-3">
                          <label for="regist_start">Awal</label>
                          <input type="date" class="form-control" id="regist_start" name="regist_start" value="{{ old('regist_start') }}" required>
                          <span class="invalid-feedback">Tanggal wajib diisi.</span>
                        </div>
                        <div class="col-md-6 col-3">
                          <label for="regist_end">Akhir</label>
                          <input type="date" class="form-control" id="regist_end" name="regist_end" value="{{ old('regist_end') }}" required>
                          <span class="invalid-feedback">Tanggal wajib diisi.</span>
                        </div>
                      </div>
                    </div>

                    {{-- <div class="form-group">
                      <label for="title">Tanggal Pelatihan</label>
                      <div class="row">
                        <div class="col-md-6 col-3">
                          <label for="event_start">Awal</label>
                          <input type="date" class="form-control" id="event_start" name="event_start" required>
                          <span class="invalid-feedback">Tanggal wajib diisi.</span>
                        </div>
                        <div class="col-md-6 col-3">
                          <label for="event_end">Akhir</label>
                          <input type="date" class="form-control" id="event_end" name="event_end" required>
                          <span class="invalid-feedback">Tanggal wajib diisi.</span>
                        </div>
                      </div>
                    </div> --}}

                    <div class="form-group">
                      <label for="lokasi">Lokasi Pelatihan</label>
                      
                      <input type="text" class="form-control" id="lokasi" name="lokasi" value="{{ old('lokasi') }}" required>
                      <span class="invalid-feedback">Lokasi wajib diisi.</span>
                    </div>

                    <div class="form-group">
                      <label for="metode">Metode</label>
                      <select name="metode" class="form-control" id="metode" required>
                          <option value="">Pilih Metode</option>
                          <option value="online">Online / Daring</option>
                          <option value="offline">Offline / Luring</option>
                      </select>
                      <span class="invalid-feedback">Metode wajib dipilih.</span>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12 col-12">
                    <div class="form-group">
                      <label for="body">Deskripsi Pelatihan</label>
                      <textarea class="form-control" id="body" name="body" rows="4" required>{{ old('body') }}</textarea>
                      <span class="invalid-feedback">Deskripsi wajib diisi.</span>
                    </div>
                  </div>
                  <div class="col-md-12 d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">Tambahkan</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
    </div>
  </section>

  <section class="row">
    @foreach($rows as $row)
    <div class="col-md-12">
      <div class="card mb-3">
          <div class="card-body">
            <h5 class="card-title">
              {{$row['title']}}
              {{-- <span class="badge bg-success mr-1 mt-1">Buka</span> --}}
            </h5>
            <h6 class="card-subtitle mb-2 text-muted text-sm form-inline">
              <i class="fa fa-calendar mx-1"></i> {{$row['regist_start']}} - {{$row['regist_end']}} |
              <i class="fa fa-mobile mx-1"></i> Metode : {{$row['metode']}} |
              <i class="fa fa-user mx-1"></i> Peserta : {{$row['jumlah_peserta']}}
            </h6>
            <div class="d-flex">
              <a href="{{ route('admin.course.detail', ['slug' => $row['slug']]) }}" class="mx-1 btn btn-sm btn-primary rounded">
                <i class="fa fa-eye"></i> Detail
              </a>
              <a href="{{ route('admin.course.edit', ['slug' => $row['slug']]) }}" class="mx-1 btn btn-sm btn-secondary text-light rounded">
                <i class="fa fa-wrench"></i> Sunting
              </a>

              <button type="button" class="btn btn-danger" onclick="confirmDeletion('{{ $row['slug'] }}')">
                <i class="fa fa-trash"></i> Hapus
              </button>
              
              <form id="delete-form-{{ $row['slug'] }}" action="{{route('admin.course.destroy', ['slug' => $row['slug']])}}" method="post" style="display: none;">
                  @method("delete")
                  @csrf
              </form>

  

              
            </div>
          </div>
      </div>
    </div>
    @endforeach
    <div class="d-flex justify-content-center mt-4">
      {{ $rows->appends(['query' => $query])->links('pagination::bootstrap-5') }}
    </div>
  </section>
  
</div>

<x-admin.footer></x-admin.footer>
<script>
  function confirmDeletion(slug) {
      if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
          document.getElementById('delete-form-' + slug).submit();
      }
  }
  </script>
<script>

  (function() {
      'use strict';
      window.addEventListener('load', function() {
          var form = document.getElementById('participantForm');

          var validateInput = function(input) {
              if (input.checkValidity()) {
                  input.classList.add('is-valid');
                  input.classList.remove('is-invalid');
                  input.nextElementSibling.style.display = 'none';
              } else {
                  input.classList.add('is-invalid');
                  input.classList.remove('is-valid');
                  input.nextElementSibling.style.display = 'block';
              }
          };

          // List of IDs to be validated
          // var inputIds = ['title', 'lokasi', 'regist_start', 'regist_end', 'event_start', 'event_end', 'metode', 'body'];
          var inputIds = ['title', 'lokasi', 'regist_start', 'regist_end', 'metode', 'body'];

          // Function to get elements by IDs and validate them
          var inputs = inputIds.map(function(id) {
              return document.getElementById(id);
          });

          inputs.forEach(function(input) {
              validateInput(input);
              input.addEventListener('input', function() {
                  validateInput(input);
              });
              input.addEventListener('change', function() {
                  validateInput(input);
              });
          });

          form.addEventListener('submit', function(event) {
              var isValid = true;
              var fileInput = document.getElementById('image');
              
              if (fileInput.files.length > 0) {
                  var file = fileInput.files[0];
                  if (!file.type.startsWith('image/') || file.size > 2 * 1024 * 1024) {
                      fileInput.classList.add('is-invalid');
                      fileInput.classList.remove('is-valid');
                      fileInput.nextElementSibling.style.display = 'block';
                      isValid = false;
                  } else {
                      fileInput.classList.remove('is-invalid');
                      fileInput.classList.add('is-valid');
                      fileInput.nextElementSibling.style.display = 'none';
                  }
              }

              inputs.forEach(function(input) {
                  validateInput(input);
                  if (!input.checkValidity()) {
                      isValid = false;
                  }
              });

              if (!isValid) {
                  event.preventDefault();
                  event.stopPropagation();
              }
          }, false);
      }, false);
  })();
</script>
