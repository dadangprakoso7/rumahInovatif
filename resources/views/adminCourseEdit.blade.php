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
        display: block;
    }
    .valid-feedback {
        color: green;
        display: block;
    }
  </style>
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
 </p>
            <div class="page-heading">
                <h3>
                    {{$row[0]['title']}}
                </h3>
                <span class="badge bg-info">{{$row[0]['metode']}}</span>
                <span class="badge bg-dark">Pendaftaran : {{$row[0]['regist_start']}} - {{$row[0]['regist_end']}}</span>
            </div>
            <div class="page-content">
                <section class="row">
                    <div class="col-12 col-lg-12">
                        <img src="assets/images/kominfo/downloadnow.jpeg" class="w-100" style="max-height: 28rem !important;" alt="">
                    </div>
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Ubah Data</h4>
                            </div>
    
                            <div class="card-body">
                                <form id="participantForm" novalidate action="{{route('admin.course.update', ['slug' => $row[0]['slug']])}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('put')
                                    
                                    <div class="row">
                                      <div class="col-md-6 col-6">
                                        <div class="form-group">
                                          <label for="title">Judul Pelatihan</label>
                                          <input type="text" class="form-control" value="{{$row[0]['title']}}" id="title" name="title" required>
                                          <span class="invalid-feedback">Judul wajib diisi.</span>
                                        </div>
                    
                                        
                    
                                        <div class="form-group">
                                          <label for="image">Unggah Gambar</label>
                                          <small class="text-muted"><i>Maximal 2Mb</i></small>
                                          <div class="row">
                                            <div class="col-md-6 col-3">
                                                <input type="file" class="form-control-file form-control" id="image" name="image" accept="image/*">                                                
                                            </div>
                                            <div class="col-md-6 col-3">
                                                <input type="checkbox" class="form-check-input" id="hapusGambar" name="hapusGambar" value="1">
                                                <label for="checkbox1">Hapus Gambar</label>
                                            </div>
                                            
                                          </div>
                                          <div class="row">
                                            <div class="col-md-12 col-6">
                                              @error('image')
                                              <span class="text-danger">Hanya gambar dengan ukuran maksimal 2 MB yang diperbolehkan.</span>
                                              @enderror
                                            </div>
                                          </div>
                                          
                                          
                                        </div>
                    
                                        <div class="form-group">
                                          <img src="https://via.placeholder.com/150x250" height="220px" width="100%" alt="">
                                        </div>
                                      </div>
                                      <div class="col-md-6 col-6">
                                        <div class="form-group">
                                          <label for="title">Tanggal Pendaftaran</label>
                                          <div class="row">
                                            <div class="col-md-6 col-3">
                                              <label for="regist_start">Awal</label>
                                              <input type="date" class="form-control" value="{{$row[0]['regist_start']}}" id="regist_start" name="regist_start" required>
                                              <span class="invalid-feedback">Tanggal wajib diisi.</span>
                                            </div>
                                            <div class="col-md-6 col-3">
                                              <label for="regist_end">Akhir</label>
                                              <input type="date" class="form-control" value="{{$row[0]['regist_end']}}" id="regist_end" name="regist_end" required>
                                              <span class="invalid-feedback">Tanggal wajib diisi.</span>
                                            </div>
                                          </div>
                                        </div>
                    

                                        <div class="form-group">
                                          <label for="lokasi">Lokasi Pelatihan</label>
                                          <input type="text" class="form-control" value="{{$row[0]['lokasi']}}" id="lokasi" name="lokasi" required>
                                          <span class="invalid-feedback">Lokasi wajib diisi.</span>
                                        </div>
                    
                                        <div class="form-group">
                                          <label for="metode">Metode</label>
                                          <select name="metode" class="form-control" id="metode" required>
                                              <option value="">Pilih Metode</option>
                                              <option value="online" <?php if($row[0]['metode'] == "online"){echo "selected";}?>>Online / Daring</option>
                                              <option value="offline" <?php if($row[0]['metode'] == "offline"){echo "selected";}?>>Offline / Luring</option>
                                          </select>
                                          <span class="invalid-feedback">Metode wajib dipilih.</span>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="col-md-12 col-12">
                                        <div class="form-group">
                                          <label for="body">Deskripsi Pelatihan</label>
                                          <textarea class="form-control" id="body" name="body" rows="4" required>{{$row[0]['body']}}</textarea>
                                          <span class="invalid-feedback">Deskripsi wajib diisi.</span>
                                        </div>
                                      </div>
                                      <div class="col-md-12 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary">Ubah Data</button>
                                      </div>
                                    </div>
                                  </form>
                            </div>
                        </div>
                    </div>
                </section>

            </div>

            <x-admin.footer></x-admin.footer>
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
                        var inputIds = ['title', 'lokasi',  'regist_start', 'regist_end', 'metode', 'body'];
              
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
                                if (file.size > 2 * 1024 * 1024) {
                                    fileInput.classList.add('is-invalid');
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
            
            