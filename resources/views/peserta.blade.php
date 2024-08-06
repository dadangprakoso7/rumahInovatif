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
        
    }
    .valid-feedback {
        color: green;
        display: inline;
        
    }
    .custom-file-input:lang(en)~.custom-file-label::after {
        content: "Browse";
    }
    .alert-gray {
        background-color: #f8f9fa;
        color: #6c757d;
        border: 1px solid #dee2e6;
        border-radius: .25rem;
        padding: .75rem 1.25rem;
    }
  </style>
  
            <div class="page-heading">
                <h3>
                    {{$row[0]['name']}}
                </h3>
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
                                <form action="{{route('admin.peserta.update', ['id' => $row[0]['id']])}}" method="POST" id="newForm" enctype="multipart/form-data" novalidate>
                                    @method('put')      
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
        
                                            <div class="form-group">
                                        
                                                <label for="helpInputTop">Nama peserta</label>
                                                <small class="text-muted valid-feedback">eg.<i>Wajib di isi</i></small>
                                                <input name="name" value="{{$row[0]['name']}}" type="text" class="form-control is-valid" id="helpInputTop" placeholder="Nama Peserta" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="helpInputTop">Institusi / Sekolah</label>
                                                <small class="text-muted valid-feedback">eg.<i>Wajib di isi</i></small>
                                                <input name="institut" value="{{$row[0]['institut']}}" type="text" class="form-control is-valid" id="helpInputTop" placeholder="Institusi / Sekolah" required>
                                            </div>                                        

                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="helpInputTop">Kelas / Jabatan</label>
                                                <small class="text-muted valid-feedback">eg.<i>Wajib di isi</i></small>
                                                <input name="jabatan" value="{{$row[0]['jabatan']}}" type="text" class="form-control is-valid" id="helpInputTop" placeholder="Kelas / Jabatan" required>    
                                            </div>

                                            <div class="form-group">
                                                <label for="helpInputTop">Nomor Telepon</label>
                                                <small class="text-muted valid-feedback"><i>Jika diisi, hanya bisa diisi dengan angka dengan 10-13 digit</i></small>
                                                <input name="no_hp" value="{{$row[0]['no_hp']}}" type="text" class="form-control is-valid" id="helpInputTop" pattern="^[0-9]{10,13}$" placeholder="Nomer Telepon">
                                            </div>

                                            <input type="hidden" value="{{$row[0]['pelatihan_id']}}" name="pelatihan_id">

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary">Ubah</button>
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
                // Fungsi untuk memvalidasi form dan menampilkan pesan kesalahan
                (function() {
                    'use strict';
                    window.addEventListener('load', function() {
                        var form = document.getElementById('newForm');
                        var imageAlert = document.getElementById('imageAlert');
                        form.addEventListener('submit', function(event) {
                            var inputs = form.querySelectorAll('input, textarea, select');
                            var isValid = true;
              
                            inputs.forEach(function(input) {
                                if (!input.checkValidity()) {
                                    input.classList.add('is-invalid');
                                    input.classList.remove('is-valid');
                                    input.nextElementSibling.style.display = 'block'; // Tampilkan pesan kesalahan
                                    isValid = false;
                                } else {
                                    input.classList.add('is-valid');
                                    input.classList.remove('is-invalid');
                                    input.nextElementSibling.style.display = 'none'; // Sembunyikan pesan kesalahan
                                }
                            });
              
                            // Validasi file image
                            var imageInput = document.getElementById('image');
                            if (imageInput.files.length > 0) {
                                var file = imageInput.files[0];
                                if (file.size > 2 * 1024 * 1024 || !file.type.startsWith('image/')) {
                                    imageAlert.classList.remove('d-none'); // Tampilkan alert abu-abu
                                    imageInput.classList.add('is-invalid');
                                    imageInput.classList.remove('is-valid');
                                    isValid = false;
                                } else {
                                    imageAlert.classList.add('d-none'); // Sembunyikan alert abu-abu
                                    imageInput.classList.add('is-valid');
                                    imageInput.classList.remove('is-invalid');
                                }
                            } else {
                                // Jika file image kosong, tidak perlu validasi
                                imageAlert.classList.add('d-none'); // Sembunyikan alert abu-abu
                                imageInput.classList.remove('is-invalid');
                                imageInput.classList.remove('is-valid');
                            }
              
                            if (!isValid) {
                                event.preventDefault();
                                event.stopPropagation();
                            }
                        }, false);

                        
              
                        // Tambahkan event listener untuk perubahan input
                        form.querySelectorAll('input, textarea, select').forEach(function(input) {
                            input.addEventListener('input', function() {
                                if (input.checkValidity()) {
                                    input.classList.add('is-valid');
                                    input.classList.remove('is-invalid');
                                    input.nextElementSibling.style.display = 'none'; // Sembunyikan pesan kesalahan
                                } else {
                                    input.classList.add('is-invalid');
                                    input.classList.remove('is-valid');
                                    input.nextElementSibling.style.display = 'block'; // Tampilkan pesan kesalahan
                                }
                            });
                        });
                    }, false);
                })();
              </script>