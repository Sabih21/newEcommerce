<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ $title ?? 'Admin Dashboard' }}</title>
    @include('admin.styles')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        @include('admin.navbar')
        @include('admin.sidebar')
        <div class="content-wrapper">

            <div class="container mt-5">
                <h1 class="mb-4">Companies</h1>
            
                <!-- Button to trigger create company modal -->
                <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#addCompanyModal">
                    Add Company
                </button>
            
                <!-- Company list -->
                <ul class="list-group">
                    @foreach ($companies as $company)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ $company->company_name }}
                            <div class="btn-group" role="group">
                                <!-- Button to trigger edit company modal -->
                                <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editCompanyModal{{ $company->id }}">
                                    Edit
                                </button>
                                <!-- Form to delete company -->
                                <form action="{{ route('companies.destroy', $company->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this company?')">Delete</button>
                                </form>
                            </div>
                        </li>
            
                        <!-- Edit Company Modal -->
                        <div class="modal fade" id="editCompanyModal{{ $company->id }}" tabindex="-1" role="dialog" aria-labelledby="editCompanyModalLabel{{ $company->id }}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editCompanyModalLabel{{ $company->id }}">Edit Company</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Form to edit company -->
                                        <form action="{{ route('companies.update', $company->id) }}" method="post">
                                            @csrf
                                            @method('PATCH')
                                            <div class="form-group">
                                                <label for="editCompanyName{{ $company->id }}">Company Name:</label>
                                                <input type="text" class="form-control" id="editCompanyName{{ $company->id }}" name="company_name" value="{{ $company->company_name }}" required>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </ul>
            
                <!-- Create Company Modal -->
                <div class="modal fade" id="addCompanyModal" tabindex="-1" role="dialog" aria-labelledby="addCompanyModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addCompanyModalLabel">Add Company</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <!-- Form to add a new company -->
                                <form action="{{ route('companies.store') }}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label for="addCompanyName">Company Name:</label>
                                        <input type="text" class="form-control" id="addCompanyName" name="company_name" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Add</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@include('admin.footer')
@include('admin.scripts')
</body>
</html>
