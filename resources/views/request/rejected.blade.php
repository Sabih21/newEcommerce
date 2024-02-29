<!-- resources/views/rejected.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Request Rejected</h4>
                <p class="card-text">Unfortunately, your request has been rejected by the admin. If you have any questions, please contact support.</p>
                <button class="btn btn-primary" onclick="location.reload()">Refresh</button>
            </div>
        </div>
    </div>
@endsection
