@extends('layouts.basic')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Messenger</div>
                <div id="app" class="card-body">

                    <messenger :user="{{ auth()->user() }}"></messenger>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
