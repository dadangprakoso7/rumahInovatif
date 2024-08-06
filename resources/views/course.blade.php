<x-user.header></x-user.header>
<x-user.navbar></x-user.navbar>
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
<section class="breadcrumbs">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h2>{{$row[0]['title']}}</h2> 
        </div>
    </div>
</section><!-- Breadcrumbs Section -->

@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Selamat. </strong> {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        Gagal melakukan pendataran
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<!-- ======= Portfolio Details Section ======= -->
<section id="course" class="portfolio-details">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="portfolio-details-slider swiper">
                    <div class="portfolio-description">
                        @if($row[0]['image'] != null)
                        <center class="mb-1">
                            <img src="{{$row[0]['image']}}" alt="" style="max-height: 320px;max-width:320px">
                        </center>
                        @endif
                        <h2>Deskripsi Pelatihan</h2>
                        <p>{{$row[0]['body']}}</p>
                        <h2>Lokasi Pelatihan</h2>
                        <p>{{$row[0]['lokasi']}}</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="portfolio-info">
                    <h3>Informasi Pelatihan</h3>
                    <ul class="cilik">
                        <li><strong>Tgl. Awal Pendaftaran</strong>: {{$row[0]['regist_start']}}</li>
                        <li><strong>Tgl. Akhir Pendaftaran</strong>: {{$row[0]['regist_end']}}</li>
                        <li><strong>Tgl. Awal Pelatihan</strong>: {{$row[0]['event_start']}}</li>
                        <li><strong>Tgl. Akhir Pelatihan</strong>: {{$row[0]['event_end']}}</li>
                        <li><strong>Metode</strong>: {{$row[0]['metode']}}</li>
                    </ul>
                </div>

                @php
                    $registStart = new DateTime($row[0]['regist_start']);
                    $today = new DateTime();   
                @endphp

                @if ($registStart <= $today)
                <button type="button" class="btn btn-outline-primary w-100 mt-2" data-toggle="modal" data-target="#exampleModal">
                    Daftar Sekarang
                </button>
                @endif

                <form action="{{ route('course.detail', ['slug' => $row[0]['slug']]) }}" method="POST"  id="participantForm" novalidate>
                    @csrf
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Daftar Sekarang</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="name">Nama</label>
                                        <input type="text"  name="name"  class="form-control" id="helpInputTop" placeholder="Masukkan Nama Peserta" required>
                                        <span class="invalid-feedback">Nama wajib diisi.</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="institut">Institusi</label>
                                        <input type="text"  name="institut"  class="form-control" id="helpInputTop" placeholder="Masukkan Nama Institut / Asal Sekolah" required>
                                        <span class="invalid-feedback">Institusi wajib diisi.</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="kelas">Kelas / Jabatan</label>
                                        <input type="text" class="form-control" id="kelas" name="jabatan" required>
                                        <span class="invalid-feedback">Kelas wajib diisi.</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="phone">Nomor Telepon</label>
                                        <input type="text"  name="no_hp"  class="form-control" id="helpInputTop" inputmode="numeric" pattern="^[0-9]{10,13}$" placeholder="Masukkan Kelas / Jabatan">
                                        <span class="invalid-feedback">Jika diisi, nomor telepon harus berupa angka dan terdiri dari 10 hingga 13 digit.</span>
                                    </div>
                                    <input type="hidden" name="pelatihan_id" value="{{$row[0]['id']}}">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section><!-- End Portfolio Details Section -->


<x-user.footer></x-user.footer>
<script>
    // Fungsi untuk memvalidasi form dan menampilkan pesan kesalahan
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            var form = document.getElementById('participantForm');
            
            var validateInput = function(input) {
                if (input.checkValidity()) {
                    input.classList.add('is-valid');
                    input.classList.remove('is-invalid');
                    input.nextElementSibling.style.display = 'none'; // Sembunyikan pesan kesalahan
                } else {
                    input.classList.add('is-invalid');
                    input.classList.remove('is-valid');
                    input.nextElementSibling.style.display = 'block'; // Tampilkan pesan kesalahan
                }
            };

            var inputs = form.querySelectorAll('input');
            inputs.forEach(function(input) {
                validateInput(input); // Validasi saat halaman dimuat
                input.addEventListener('input', function() {
                    validateInput(input); // Validasi saat input diubah
                });
            });

            form.addEventListener('submit', function(event) {
                var isValid = true;
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



