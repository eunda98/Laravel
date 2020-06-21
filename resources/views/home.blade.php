@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Home</div>

                <div class="card-body">
                    <h3>Opciones</h3>

                    <a href="album" class="btn btn-danger">Albumes</a>
                    <a href="estudiantes" class="btn btn-primary">Canciones</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
