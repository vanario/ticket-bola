@extends('template') 
@section('title', 'Create Jadwal') 
@section('content') 

<div class="row">
    <section class="content">
        <div class="content-list">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <form method="POST" action="{{ route('jadwal.store')}}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                        <div class="modal-header">
                            <h4>Tambah Jadwal</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-6">
                                        <label for="">Jadwal</label>
                                        <select name="gttopstadion" class="form-control input-sm" required>
                                            <option value="">Club</option>
                                            @foreach($list_club as $gtcode => $name)
                                            <option value="{{$gtcode}}">{{$name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Nama Home</label>
                                        <input type="text" name="namehome" id="namehome" class="form-control input-sm" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Nama Away</label>
                                        <input type="text" name="nameaway" id="nameaway" class="form-control input-sm" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Tanggal</label>
                                        <input type="text" name="date" id="date" class="form-control input-sm" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Jam</label>
                                        <input type="text" name="jam" id="jam" class="form-control input-sm" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Kota</label>
                                        <input type="text" name="kota" id="kota" class="form-control input-sm" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Stadion</label>
                                        <input type="text" name="stadion" id="stadion" class="form-control input-sm" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Event</label>
                                        <input type="text" name="event" id="event" class="form-control input-sm" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                          <div>
                            <input type="submit" value="Simpan" class="btn btn-green">
                          </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@include('sweet::alert') 
@endsection 
@section('script')
<script src="{{ asset('adminlte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('adminlte/bower_components/bootstrap-timepicker/js/bootstrap-timepicker.js') }}"></script>
<script type="text/javascript">
$(function() {

    init_datepicker();
    init_timepicker();
    init_showTabs();

    function smartwizard() {
        $('#smartwizard').smartWizard({
            selected: 0,
            keyNavigation: false,
            theme: 'arrows',
            transitionEffect: 'fade',
            toolbarSettings: {
                toolbarPosition: 'bottom',
                showNextButton: false, // show/hide a Next button
                showPreviousButton: false, // show/hide a Previous button
                toolbarExtraButtons: []
            }
        });
    }

     $(function() {

        function init_showTabs() {
            $('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
                localStorage.setItem('activeTab', $(e.target).attr('href'));
            });
            var activeTab = localStorage.getItem('activeTab');
            console.log(activeTab);
            if (activeTab) {
               $('a[href="' + activeTab + '"]').tab('show');
            }
        };             
    })

    function init_datepicker() {
        $('#date').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true
        });
    };

    function init_timepicker() {
        $('#jam').timepicker({
            format: 'H:i:s',
            autoclose: true
        });
    };
});

function readURLdepan(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            $('#image-previewdepan').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
$("#gambardepan").change(function() {
    readURLdepan(this);
});

function readURLtengah(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            $('#image-previewtengah').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
$("#gambartengah").change(function() {
    readURLtengah(this);
});

function readURLbelakang(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            $('#image-previewbelakang').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
$("#gambarbelakang").change(function() {
    readURLbelakang(this);
});
</script>
@endsection