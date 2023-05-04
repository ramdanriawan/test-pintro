<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ env('APP_NAME') }}</title>
    <link href="{{ url('lumino/css/bootstrap.min.css' ) }}" rel="stylesheet">
    <link href="{{ url('lumino/css/font-awesome.min.css' ) }}" rel="stylesheet">
    <link href="{{ url('lumino/css/datepicker3.css' ) }}" rel="stylesheet">
    <link href="{{ url('lumino/css/styles.css' ) }}" rel="stylesheet">

    <!--Custom Font-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.datatables.net/select/1.3.1/css/select.dataTables.min.css">
    <link href="{{ url("vendor/datatables/dataTables.bootstrap4.css") }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pretty-checkbox@3.0/dist/pretty-checkbox.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/material_blue.css">
    <style>
        ._3emE9--dark-theme .-S-tR--ff-downloader {
            background: rgba(30, 30, 30, .93);
            border: 1px solid rgba(82, 82, 82, .54);
            box-shadow: 0 4px 7px rgba(30, 30, 30, .55);
            color: #fff
        }

        ._3emE9--dark-theme .-S-tR--ff-downloader ._6_Mtt--header ._2VdJW--minimize-btn {
            background: #3d4b52
        }

        ._3emE9--dark-theme .-S-tR--ff-downloader ._6_Mtt--header ._2VdJW--minimize-btn:hover {
            background: #131415
        }

        ._3emE9--dark-theme .-S-tR--ff-downloader ._10vpG--footer {
            background: rgba(30, 30, 30, .93)
        }

        ._2mDEx--white-theme .-S-tR--ff-downloader {
            background: #fff;
            border: 1px solid rgba(82, 82, 82, .54);
            box-shadow: 0 4px 7px rgba(30, 30, 30, .55);
            color: #314c75
        }

        ._2mDEx--white-theme .-S-tR--ff-downloader ._6_Mtt--header {
            font-weight: 700
        }

        ._2mDEx--white-theme .-S-tR--ff-downloader ._2dFLA--container ._2bWNS--notice {
            border: 0;
            color: rgba(0, 0, 0, .88)
        }

        ._2mDEx--white-theme .-S-tR--ff-downloader ._10vpG--footer {
            background: #fff
        }

        .-S-tR--ff-downloader {
            display: block;
            overflow: hidden;
            position: fixed;
            bottom: 20px;
            right: 7.1%;
            width: 330px;
            height: 180px;
            background: rgba(30, 30, 30, .93);
            border-radius: 2px;
            color: #fff;
            z-index: 99999999;
            border: 1px solid rgba(82, 82, 82, .54);
            box-shadow: 0 4px 7px rgba(30, 30, 30, .55);
            transition: .5s
        }

        .-S-tR--ff-downloader._3M7UQ--minimize {
            height: 62px
        }

        .-S-tR--ff-downloader._3M7UQ--minimize .nxuu4--file-info,
        .-S-tR--ff-downloader._3M7UQ--minimize ._6_Mtt--header {
            display: none
        }

        .-S-tR--ff-downloader ._6_Mtt--header {
            padding: 10px;
            font-size: 17px;
            font-family: sans-serif
        }

        .-S-tR--ff-downloader ._6_Mtt--header ._2VdJW--minimize-btn {
            float: right;
            background: #f1ecec;
            height: 20px;
            width: 20px;
            text-align: center;
            padding: 2px;
            margin-top: -10px;
            cursor: pointer
        }

        .-S-tR--ff-downloader ._6_Mtt--header ._2VdJW--minimize-btn:hover {
            background: #e2dede
        }

        .-S-tR--ff-downloader ._13XQ2--error {
            color: red;
            padding: 10px;
            font-size: 12px;
            line-height: 19px
        }

        .-S-tR--ff-downloader ._2dFLA--container {
            position: relative;
            height: 100%
        }

        .-S-tR--ff-downloader ._2dFLA--container .nxuu4--file-info {
            padding: 6px 15px 0;
            font-family: sans-serif
        }

        .-S-tR--ff-downloader ._2dFLA--container .nxuu4--file-info div {
            margin-bottom: 5px;
            width: 100%;
            overflow: hidden
        }

        .-S-tR--ff-downloader ._2dFLA--container ._2bWNS--notice {
            margin-top: 21px;
            font-size: 11px
        }

        .-S-tR--ff-downloader ._10vpG--footer {
            width: 100%;
            bottom: 0;
            position: absolute;
            font-weight: 700
        }

        .-S-tR--ff-downloader ._10vpG--footer ._2V73d--loader {
            animation: n0BD1--rotation 3.5s linear forwards;
            position: absolute;
            top: -120px;
            left: calc(50% - 35px);
            border-radius: 50%;
            border: 5px solid #fff;
            border-top-color: #a29bfe;
            height: 70px;
            width: 70px;
            display: flex;
            justify-content: center;
            align-items: center
        }

        .-S-tR--ff-downloader ._10vpG--footer ._24wjw--loading-bar {
            width: 100%;
            height: 18px;
            background: #dfe6e9;
            border-radius: 5px
        }

        .-S-tR--ff-downloader ._10vpG--footer ._24wjw--loading-bar ._1FVu9--progress-bar {
            height: 100%;
            background: #8bc34a;
            border-radius: 5px
        }

        .-S-tR--ff-downloader ._10vpG--footer ._2KztS--status {
            margin-top: 10px
        }

        .-S-tR--ff-downloader ._10vpG--footer ._2KztS--status ._1XilH--state {
            float: left;
            font-size: .9em;
            letter-spacing: 1pt;
            text-transform: uppercase;
            width: 100px;
            height: 20px;
            position: relative
        }

        .-S-tR--ff-downloader ._10vpG--footer ._2KztS--status ._1jiaj--percentage {
            float: right
        }
    </style>

    <link href="{{ url("css/style.css") }}" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#sidebar-collapse"
                    aria-expanded="true"><span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span></button>
                <a class="navbar-brand" href="#"><span>APLIKASI PENGGAJIAN DAN ABSENSI</span> RAMDAN RIAWAN</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <ul class="nav navbar-top-links navbar-right">
                        <li class="dropdown">
                            <a class="dropdown-toggle count-info bg-red" data-toggle="dropdown" href="{{ route('logout') }}" onclick="event.preventDefault(); if(confirm('Yakin akan logut?')) this.closest('form').submit(); ">
                                <i class="fa fa-sign-out"></i>
                            </a>
                        </li>
                    </ul>
                </form>
            </div>
        </div>
    </nav>

    <div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar collapse in" aria-expanded="true" style="">
        <div class="profile-sidebar">
            <div class="profile-userpic" style='padding-left: 15px;'>
                <i class='fa fa-user fa-3x'></i>
            </div>
            <div class="profile-usertitle">
                <div class="profile-usertitle-name">{{ auth()->user()->name }}</div></div>
            <div class="clear"></div>
        </div>
        <div class="divider"></div>

        <ul class="nav menu">
            @if(in_array(auth()->user()->email, ['admin@gmail.com']))
            <li @if(Request::segment(1) == 'dashboard' && Request::segment(2) != 'laporan') class="active" @endif><a href="{{ route('dashboard') }}"><em class="fa fa-dashboard">&nbsp;</em> Dashboard</a></li>
            @endif
            
            @if(in_array(auth()->user()->email, ['admin@gmail.com']))
            <li @if(Request::segment(1) == 'user' && Request::segment(2) != 'laporan') class="active" @endif><a href="{{ route('user.profile') }}"><em class="fa fa-user">&nbsp;</em> Profile</a></li>
            @endif
            
            @if(in_array(auth()->user()->email, ['admin@gmail.com']))
            <li @if(Request::segment(1) == 'jabatan' && Request::segment(2) != 'laporan') class="active" @endif><a href="{{ route('jabatan.index') }}"><em class="fa fa-table">&nbsp;</em> Jabatan</a></li>
            @endif
            
            @if(in_array(auth()->user()->email, ['admin@gmail.com']))
            <li @if(Request::segment(1) == 'pegawai' && Request::segment(2) != 'laporan') class="active" @endif><a href="{{ route('pegawai.index') }}"><em class="fa fa-table">&nbsp;</em> Pegawai</a></li>
            @endif
            
            @if(in_array(auth()->user()->email, ['admin@gmail.com']))
            <li @if(Request::segment(1) == 'riwayat_jabatan' && Request::segment(2) != 'laporan') class="active" @endif><a href="{{ route('riwayat_jabatan.index') }}"><em class="fa fa-table">&nbsp;</em> Riwayat Jabatan</a></li>
            @endif
            
            @if(in_array(auth()->user()->email, ['admin@gmail.com']))
            <li @if(Request::segment(1) == 'cuti' && Request::segment(2) != 'laporan') class="active" @endif><a href="{{ route('cuti.index') }}"><em class="fa fa-table">&nbsp;</em> Cuti</a></li>
            @endif
            
            @if(in_array(auth()->user()->email, ['admin@gmail.com']))
            <li @if(Request::segment(1) == 'penggajian' && Request::segment(2) != 'laporan') class="active" @endif><a href="{{ route('penggajian.index') }}"><em class="fa fa-table">&nbsp;</em> Penggajian</a></li>
            @endif

            @if(in_array(auth()->user()->email, ['admin@gmail.com', 'guru@gmail.com', 'kepsek@gmail.com']))
            <li @if(Request::segment(1) == 'absensi' && Request::segment(2) != 'laporan') class="active" @endif><a href="{{ route('absensi.index') }}"><em class="fa fa-table">&nbsp;</em> Absensi</a></li>
            @endif

            @if(in_array(auth()->user()->email, ['admin@gmail.com', 'guru@gmail.com', 'kepsek@gmail.com']) || preg_match('/guru/', auth()->user()->email))
            <li class="parent ">
                <a data-toggle="collapse" href="#sub-item-1" class="collapsed" aria-expanded="false">
                    <em class="fa fa-navicon">&nbsp;</em>
                    Laporan
                    <span data-toggle="collapse" href="#sub-item-1" class="icon pull-right collapsed" aria-expanded="false">
                        <em class="fa fa-report @if(Request::segment(2) == 'laporan') fa-minus @else fa-plus @endif"></em>
                    </span>
                </a>
                
                <ul class="children @if(Request::segment(2) == 'laporan') collapsed @else collapse @endif" id="sub-item-1" aria-expanded="false" style="height: 0px;">
                    @if(in_array(auth()->user()->email, ['admin@gmail.com']))
                    <li><a @if(request()->path() == 'jabatan/laporan') class="active" @endif href="{{ route('jabatan.laporan') }}"><em class="fa fa-table">&nbsp;</em> Jabatan</a></li>
                    @endif

                    @if(in_array(auth()->user()->email, ['admin@gmail.com']))
                    <li><a @if(request()->path() == 'pegawai/laporan') class="active" @endif href="{{ route('pegawai.laporan') }}"><em class="fa fa-table">&nbsp;</em> Pegawai</a></li>
                    @endif

                    @if(in_array(auth()->user()->email, ['admin@gmail.com']))
                    <li><a @if(request()->path() == 'riwayat_jabatan/laporan') class="active" @endif href="{{ route('riwayat_jabatan.laporan') }}"><em class="fa fa-table">&nbsp;</em> Riwayat Jabatan</a></li>
                    @endif

                    @if(in_array(auth()->user()->email, ['admin@gmail.com']))
                    <li><a @if(request()->path() == 'cuti/laporan') class="active" @endif href="{{ route('cuti.laporan') }}"><em class="fa fa-table">&nbsp;</em> Cuti</a></li>
                    @endif

                    @if(in_array(auth()->user()->email, ['admin@gmail.com', 'guru@gmail.com', 'kepsek@gmail.com']))
                    <li><a @if(request()->path() == 'penggajian/laporan') class="active" @endif href="{{ route('penggajian.laporan') }}"><em class="fa fa-table">&nbsp;</em> Penggajian</a></li>
                    @endif

                    @if(in_array(auth()->user()->email, ['admin@gmail.com']) || preg_match('/guru/', auth()->user()->email))
                    <li><a @if(request()->path() == 'absensi/laporan') class="active" @endif href="{{ route('absensi.laporan') }}"><em class="fa fa-table">&nbsp;</em> Absensi</a></li>
                    @endif
				</ul>
            </li>
            @endif
        </ul>
    </div>

    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <div class="container pt-3">
            @if(session()->has("error"))
            <div class="alert alert-danger" role="alert">
                {{ session()->get("error") }}
            </div>
            @elseif(session()->has("success"))
            <div class="alert alert-success" role="alert">
                {{ session()->get("success") }}
            </div>
            @elseif(session()->has("warning"))
            <div class="alert alert-warning" role="alert">
                {{ session()->get("warning") }}
            </div>
            @endif
        </div>

        @yield('content')
    </div>

    <script src="{{ url('monster-admin-lite/assets/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ url('lumino/js/bootstrap.min.js') }}"></script>
    <script src="{{ url('lumino/js/bootstrap-datepicker.js') }}"></script>
    <script src="{{ url('lumino/js/custom.js') }}"></script>

    {{-- dropzone --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/min/dropzone.min.js"></script>

    {{-- datatable --}}
    <script src="{{ url("vendor/datatables/jquery.dataTables.js") }}"></script>
    <script src="{{ url("vendor/datatables/dataTables.bootstrap4.js") }}"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.0/js/buttons.flash.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js"></script>
    
    {{-- ckeditor --}}
    {{-- <script src="https://cdn.ckeditor.com/ckeditor5/18.0.0/classic/ckeditor.js"></script> --}}
    <script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>

    {{-- flatpickr --}}
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://npmcdn.com/flatpickr/dist/l10n/id.js"></script>

    <script>
        $(document).ready(function () {
            // untuk merubah position modal
            modalId = 0;
            $(document).on('click', '.lblHapus', function() {
                modalId = $(this).data('modal-id');

                $(`#modal-${modalId} .modal-dialog`).css({
                    "position": 'absolute',
                    'left' : event.pageX - 170,
                    "top": event.pageY - 170
                });

                $(`#modal-${modalId} .btn-modal`).click((e) => {
    
                    $(`#modal-${modalId}`).modal('hide');
                });

                $(document).on('keypress', (e) => {
                    if(e.which == 13) {
                        if(modalId > 0) {
                            
                            $(`#modal-${modalId} .btn-modal`).click();
                        }

                        modalId = 0;
                    }
                });
            });
            

            // dropzone
            Dropzone.options.imageUpload = {
                maxFilesize         :       1,
                acceptedFiles: ".jpeg,.jpg,.png,.gif"
            };

            // menghilangkan alert
            $('.alert').fadeOut(5000);

            // flatpickr
            $(".flatpickr").flatpickr({
                enableTime: false,
                dateFormat: "d-M-Y",
                locale: 'id'
            });

            // flatpickr
            $(".flatpickr2").flatpickr({
                enableTime: false,
                dateFormat: "d-M-Y H:i",
                locale: 'id',
                enableTime: true
            });

            $('[data-toggle="popover"]').popover({
                html: true
            });

            $('input[type="range"]').on("change mousemove", function () {
                $(this).next().html($(this).val());
            });
            
            // agar filter dari datatable bisa dipake buat nyari juga
            $('#dataTable_filter input').attr('name', 'q');
            $('#dataTable_filter input').val(q);
            $('#dataTable_filter input').attr('id', 'inputSearch');
            $('#dataTable_filter input').attr('placeholder', placeholder);

            var formHtml = `<form action="${urlSearch}">`;

            $('#dataTable_filter input').wrap(formHtml);

            $(document).keydown(function (e) {
                if (e.keyCode == 13 && $("#inputSearch").is(':focus')) {
                    $('#dataTable_filter form').submit();
                }
            });

            function inArray(needle, haystack) {
                var length = haystack.length;
                for (var i = 0; i < length; i++) {
                    if (typeof haystack[i] == 'object') {
                        if (arrayCompare(haystack[i], needle)) return true;
                    } else {
                        if (haystack[i] == needle) return true;
                    }
                }

                return false;
            }

            var selector_soal_ids = [];
            $('.mapel_detail_ids, .mode, .jenis_soal').change(function () {
                // hilangkan mapel yang tidak terkait
                $(`#modal-test-mode ul`).hide();

                $.each($(".mapel_detail_ids:checked"), (index, mapel_detail_id) => {
                    const selector_soal =
                        `#modal-test-mode ul[data-mapel-detail_id='${mapel_detail_id.value}'][data-jenis='${$(".jenis_soal").val()}'][data-mode='${$(".mode").val()}']`;
                    selector_soal_ids.push(selector_soal + " input[type='checkbox']");

                    $(selector_soal).show();
                });
            });

            $('#mode').change(function (e) {
                if (inArray($(this).val(), ['Pilgan Normal', 'Essay Normal'])) {

                    $('#modal-test-mode').modal();
                }
            });

            $('#form-test').submit(function (e) {
                // e.preventDefault()

                if (!inArray($('#soal_ids').val(), ['', '[]'])) {
                    return;
                }

                var selector_soal_id_checkeds = [];
                $.each(selector_soal_ids, function (index, selector_soal_id) {
                    $(`${selector_soal_id}:checked`).map(function () {
                        selector_soal_id_checkeds.push($(this).val());
                    });
                })

                $('#soal_ids').val(JSON.stringify(selector_soal_id_checkeds));
            })

            

            // baris kode ini untuk menambahkan kelas dan juga guru ketika tombol tambah diklik (di maple create)
            $('#mapelBtnAdd').click(function () {
                const mapelFormKelasGuru = $('#mapelFormKelasGuru')
                const mapleFormKelasGuruAdd = $('#mapelFormKelasGuruAdd');

                mapelFormKelasGuru.append(mapleFormKelasGuruAdd.html());
            })

            

            // ini harus dibuat supaya ck editor bisa upload gambar
            CKEDITOR.config.filebrowserUploadMethod = 'form';

            // ini adalah inisialisasi setiap ck editor, dari id 0 sampai 3, jadi kalo perlu ckeditornya
            // kita tinggal pasang aja id yang tersedia dibawah ini, dan ck editor pun langsung tampil
            CKEDITOR.replace('editor-0', {
                height: 200,
                filebrowserUploadUrl: "{{ url('ckeditor/upload') }}"
            });
            CKEDITOR.replace('editor-1', {
                height: 200,
                filebrowserUploadUrl: "{{ url('ckeditor/upload') }}"
            });
            CKEDITOR.replace('editor-2', {
                height: 200,
                filebrowserUploadUrl: "{{ url('ckeditor/upload') }}"
            });
            CKEDITOR.replace('editor-3', {
                height: 200,
                filebrowserUploadUrl: "{{ url('ckeditor/upload') }}"
            });
            CKEDITOR.replace('editor-4', {
                height: 200,
                filebrowserUploadUrl: "{{ url('ckeditor/upload') }}"
            });

            function getIdOfRows(selector) {
                var ids = [];
                for (data of selector) {
                    ids.push(data.dataset.id);
                }

                return ids;
            }

            // ini adalah baris kode untuk mengatur penambahan soal essay
            // jadi ketika button tambah diklik maka baris ini akan menambahkan bobot dan textbox soal
            var number = $(`form .btnHapusEditor`).length - 1;
            $('#listSoalEssayBtnAdd').on('click', function () {
                number++;

                $("#listSoalEssay").append($('#listSoalEssayToAdd').html())

                $('form #hapusEditor-x').attr('data-hapus', `hapusEditor_${number}`);
                $('form #hapusEditor-x').attr('id', '')
                $(`form .btnHapusEditor`).last().attr('data-target',
                    `[data-hapus='hapusEditor_${number}'`);
                $(`form .btnHapusEditor`).last().attr('data-hapus', `hapusEditor_${number}`)

                $('form #editor-x').attr('id', `editor_${number}`);
                CKEDITOR.replace(`editor_${number}`, {
                    height: 200,
                    filebrowserUploadUrl: "{{ url('ckeditor/upload') }}"
                })
            })

            // ini adalah baris kode untuk mengatur kalo seandainy ada error di bagia create soalessay nya
            // bobot kita jadikan patokan karena jumlah bobot itu sama dengan jumlah soal
            @if(old('bobot') != "")
            @foreach(old('bobot') as $index => $bobot)
            CKEDITOR.replace(`editor-{{ $index }}`, {
                height: 200,
                filebrowserUploadUrl: "{{ url('ckeditor/upload') }}"
            })
            @endforeach
            @endif

            // baris kode ini untuk mengatur event ketika user mengklik tombol hapus di bagian create soal essay
            // numbernya harus kita kurangin setiap editornya berkurang
            // supaya penomoran ckeditornya tidak berantakan
            $(document).on('click', 'form .btnHapusEditor', function () {
                if (confirm("Yakin akan menghapus soal ini?")) {
                    $($(this).data('target')).remove()

                    number--;
                }
            })

            // dibaris ini kita mengatur datatable untuk semua halaman
            // ketika data dihalaman tersebut ditampilkan maka datatabel akan mengatur desain tablenya
            // dari mulai filter, tombol hapus semua, aktifkan, dll..
            // pengaturan ini tidak sama untuk beberapa halaman
            // sehingga kita perlu melakukan if conditional lagi
            $('#dataTable').DataTable({
                paging: true,
                pageLength: 5,
                dom: 'Blfrtip',
                "columnDefs": [{
                    "orderable": false,
                    "targets": columnOrders
                }],
                buttons: tampilkan_buttons === false ? (button_manual === false ? [] : button_manual) :
                    [{
                            extend: 'selectAll',
                            text: 'Pilih Semua',
                            className: "btn btn-primary buttons-select-all btn-sm"
                        },
                        {
                            extend: "selectNone",
                            text: 'Batal Pilih',
                            className: "btn btn-primary buttons-select-none  btn-sm"
                        },
                        {
                            text: 'Hapus',
                            className: "btn btn-primary btn-sm",
                            action: function (e, dt, node, config) {
                                var ids = JSON.stringify(getIdOfRows($('tr.selected')));
                                if (confirm("Yakin akan menghapus semua data yang dipilih?")) {
                                    // $(`#modal-hapus-semua .modal-dialog`).css({
                                    //     "position": 'absolute',
                                    //     'left' : event.pageX - 170,
                                    //     "top": event.pageY - 170
                                    // });

                                    // $('#modal-hapus-semua').modal('show');
                                    
                                    location.href = `${locationHrefHapusSemua}?ids=${ids}`;
                                }
                            }
                        },
                        {
                            text: 'Tambah',
                            className: "btn btn-primary btn-sm",
                            action: function (e, dt, node, config) {
                                location.href = locationHrefCreate
                            }
                        },
                        // khusus halaman user
                        // @if(Route::current()->action['as'] == 'user.index') {
                        //     text: 'Aktifkan User',
                        //     className: "btn btn-primary btn-sm",
                        //     action: function (e, dt, node, config) {
                        //         var ids = JSON.stringify(getIdOfRows($('tr.selected')));
                        //         if (confirm("Yakin akan mengaktifkan semua data yang dipilih?")) {
                        //             location.href = `${locationHrefAktifkanSemua}?ids=${ids}`;
                        //         }
                        //     }
                        // },
                        // @endif
                        // @if(Route::current()->action['as'] == 'user.index' && request()->kelas_id) {
                        //     text: 'Naik Kelas',
                        //     className: "btn btn-primary btn-sm",
                        //     action: function (e, dt, node, config) {
                        //         var ids = JSON.stringify(getIdOfRows($('tr.selected')));
                        //         if (confirm(
                        //             "Yakin akan menaikkan kelas untuk siswa yang dipilih?")) {
                        //             location.href = `${locationHrefNaikKelas}?ids=${ids}`;
                        //         }
                        //     }
                        // }
                        // @endif
                    
                    
                    ],
                select: true,
            });
        });
    </script>
</body>
</html>