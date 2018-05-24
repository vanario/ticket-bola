@extends('template')

@section('title', 'List Report')
@section('content')

<div class="content-list">
    <div class="row">
        <div class="col-sm-8">
            <div class="list-report">
                <div class="list-report__title">
                    <h4>Report Club</h4>
                </div>
                <div class="list-report__action">
                    <a href="{{ url('report/club/') }}" class="btn btn-block btn-primary btn-flat">Detail Report Club</a>
                </div>
            </div>
            {{-- <div class="list-report">
                <div class="list-report__title">
                    <h4>Report Club</h4>
                </div>
                <div class="list-report__action">
                    <a type="button" class="btn btn-block btn-primary btn-flat">Detail Report Club</a>
                </div>
            </div> --}}
        </div>
    </div>
</div>
@include('sweet::alert')
@endsection


