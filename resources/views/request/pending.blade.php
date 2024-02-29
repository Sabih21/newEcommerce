<!-- resources/views/pending.blade.php -->


    <div class="container">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Waiting for Approval</h4>
                <p class="card-text">Your request is still pending approval from the admin. Please be patient.</p>
                <a href="{{ route('dashboard') }}" class="btn btn-primary">Refresh</a>
            </div>
        </div>
    </div>
