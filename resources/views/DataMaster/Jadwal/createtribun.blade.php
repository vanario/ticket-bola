@extends('template') @section('title', 'Create Jadwal') @section('content') @section('css-plugin')
<link href="{{ asset('js/smartWizard/dist/css/smart_wizard.css') }}" rel="stylesheet" type="text/css" />
<!-- Optional SmartWizard theme -->
<link href="{{ asset('js/smartWizard/dist/css/smart_wizard_theme_arrows.css') }}" rel="stylesheet" type="text/css" /> @endsection
<div class="row">
    <section class="content">
        <div class="content-list">
            <div class="box-list">
                <div id="step-2" class="tab-pane">
                    <form method="POST" action="{{ route('jadwal.storetrib')}}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="col-md-6">
                                        @if($gtcodetrib != "")
                                        <input type="hidden" name="gtcodetrib" value="{{ $gtcodetrib }}" id="gtcodetrib" class="form-control input-sm" required> @endif
                                        <label for="">Tribun</label>
                                        <select name="tribun" class="form-control" id="tribun" required>
                                            <option value="">Pilih Tribun</option>
                                            <option value="vip">VIP</option>
                                            <option value="vip 1">VIP 1</option>
                                            <option value="vip 2">VIP 2</option>
                                            <option value="tribun timur">Tribun Timur</option>
                                            <option value="tribun utara">Tribun Utara</option>
                                            <option value="tribun selatan">Tribun Selatan</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12" style="margin-top: 15px; ">
                                            <label for="">Tribun Depan</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" name="pricedepan" id="pricedepan" class="form-control input-sm" placeholder="Harga" required>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" name="qtydepan" id="qtydepan" class="form-control input-sm" placeholder="Jumlah" required>
                                        </div>
                                        <div class="col-md-6" style="margin-top: 25px;">
                                            <label for="">Gambar Tribun Depan</label>
                                            <input type="file" id="gambardepan" name="gambardepan" class="validate" multiple required>
                                            <div class="input-field col s6">
                                                <img src="" id="image-previewdepan" style="max-width:200px;max-height:200px;" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12" style="margin-top: 15px; ">
                                            <label for="">Tribun Tengah</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" name="pricetengah" id="pricetengah" class="form-control input-sm" placeholder="Harga" required>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" name="qtytengah" id="qtytengah" class="form-control input-sm" placeholder="Jumlah" required>
                                        </div>
                                        <div class="col-md-6" style="margin-top: 25px;">
                                            <label for="">Gambar Trbun Tengah</label>
                                            <input type="file" id="gambartengah" name="gambartengah" class="validate" multiple required>
                                            <div class="input-field col s6">
                                                <img src="" id="image-previewtengah" style="max-width:200px;max-height:200px;" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12" style="margin-top: 15px; ">
                                            <label for="">Tribun Belakang</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" name="pricebelakang" id="pricebelakang" class="form-control input-sm" placeholder="Harga" required>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" name="qtybelakang" id="qtybelakang" class="form-control input-sm" placeholder="Jumlah" required>
                                        </div>
                                        <div class="col-md-6" style="margin-top: 25px;">
                                            <label for="">Gambar Tribun Belakang</label>
                                            <input type="file" id="gambarbelakang" name="gambarbelakang" class="validate" multiple required>
                                            <div class="input-field col s6">
                                                <img src="" id="image-previewbelakang" style="max-width:200px;max-height:200px;" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <div>
                                    <input type="submit" value="Simpan" class="btn btn-green">
                                </div>
                            </div>
                        </div>
                </div>
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

    smartwizard();
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
                showNextButton: true, // show/hide a Next button
                showPreviousButton: true, // show/hide a Previous button
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