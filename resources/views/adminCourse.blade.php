<x-admin.header></x-admin.header>
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
<div class="page-heading">
    <h3>
        {{$row[0]['title']}}
        <a href="{{ route('admin.course.edit', ['slug' => $row[0]['slug']]) }}" class="btn btn-warning text-dark">
            <i class="fa fa-edit"></i> Ubah
        </a>
    </h3>
    <span class="badge bg-info">{{$row[0]['metode']}}</span>
    <span class="badge bg-dark">Pendaftaran : {{$row[0]['regist_start']}} - {{$row[0]['regist_end']}}</span>
</div>

<div class="page-content">
    <section class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    @if($row[0]['image'] != null)
                    <center class="mb-1">
                        <img src="{{$row[0]['image']}}" alt="" style="max-height: 320px; max-width: 320px;">
                    </center>
                    @endif

                    <strong><label for="helpInputTop">Deskripsi Pelatihan</label></strong>
                    <p>{{$row[0]['body']}}</p>

                    <strong><label for="helpInputTop">Lokasi Pelatihan</label></strong>
                    <p>{{$row[0]['lokasi']}}</p>
                </div>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="card">
            <div class="card-header">
                Tabel Peserta Pelatihan
            </div>
            <a href="{{ route('pelatihan.exportParticipants', $row[0]['id']) }}" class="btn btn-success">Export Participants to Excel</a>
            <div class="card-body">
                <table class="table" id="table1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Institut</th>
                            <th>Jabatan/Kelas</th>
                            <th>No. HP</th>
                            <th>Tanggal Daftar</th>
                            <th>#</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        @forelse ($rows as $participant)
                        <tr>
                            <td>{{$no++}}</td>
                            <td>{{$participant['name']}}</td>
                            <td>{{$participant['institut']}}</td>
                            <td>{{$participant['jabatan']}}</td>
                            <td>{{$participant['no_hp']}}</td>
                            <td>{{$participant['created_at']}}</td>
                            <td class="form-inline">
                                <a href="{{ route('admin.peserta.edit', ['id' => $participant['id']]) }}" class="btn btn-outline-warning">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <button type="button" class="btn btn-outline-danger" onclick="confirmDeletion({{ $participant['id'] }})">
                                    <i class="fa fa-trash"></i>
                                </button>
                                
                                <form id="delete-form-{{ $participant['id'] }}" action="{{route('admin.peserta.destroy', ['id' => $participant['id']])}}" method="post" style="display: none;">
                                    @method("delete")
                                    @csrf
                                    <input type="hidden" name="pelatihan_id" id="" value="{{ $participant['pelatihan_id'] }}">
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr class="bg-light">
                            <td colspan="7">
                                <div class="alert alert-danger">
                                    Data Peserta Tidak Ada.
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>

<script>
function confirmDeletion(id) {
    if (confirm('Apakah Anda yakin ingin menghapus peserta ini?')) {
        document.getElementById('delete-form-' + id).submit();
    }
}
</script>

<x-admin.footer></x-admin.footer>