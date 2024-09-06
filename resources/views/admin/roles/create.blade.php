@extends('admin.layouts.main')
@section('main-section')

    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-wrapper container-xxl p-0">
            <div class="content-body">

                <!-- Bread Crumb START-->
                <div class="content-header row">
                    <div class="content-header-left col-md-9 col-12 mb-2">
                        <div class="row breadcrumbs-top">
                            <div class="col-12">
                                <h2 class="content-header-title float-start mb-0">Add New Role</h2>
                                <div class="breadcrumb-wrapper">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="#">Roles</a></li>
                                        <li class="breadcrumb-item active">Add New Role</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Bread Crumb END-->

                <!-- Add Role Form START-->
                <div class="card p-2">
                <form action="" method="">
                    <div class="col-4">
                        <label class="form-label" for="modalRoleName">Role Name</label>
                        <input type="text" id="modalRoleName" name="modalRoleName" class="form-control" placeholder="Enter role name" tabindex="-1" data-msg="Please enter role name" />
                    </div>
                    <div class="col-12">
                        <h4 class="mt-2 pt-50">Role Permissions</h4>

                        <!-- Permission Table START-->
                        <div class="table-responsive">
                            <table class="table table-flush-spacing">
                                <tbody>
                                    <tr>
                                        <td class="text-nowrap fw-bolder">
                                            Administrator Access
                                            <span data-bs-toggle="tooltip" data-bs-placement="top" title="Allows a full access to the system">
                                            <i data-feather="info"></i></span>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="selectAll" />
                                                <label class="form-check-label" for="selectAll"> Select All </label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-nowrap fw-bolder">User Management</td>
                                        <td>
                                            <div class="d-flex">
                                                <div class="form-check me-3 me-lg-5">
                                                    <input class="form-check-input" type="checkbox" id="userManagementRead" />
                                                    <label class="form-check-label" for="userManagementRead"> Read </label>
                                                </div>
                                                <div class="form-check me-3 me-lg-5">
                                                    <input class="form-check-input" type="checkbox" id="userManagementWrite" />
                                                    <label class="form-check-label" for="userManagementWrite"> Write </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="userManagementCreate" />
                                                    <label class="form-check-label" for="userManagementCreate"> Create </label>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-nowrap fw-bolder">Content Management</td>
                                        <td>
                                            <div class="d-flex">
                                                <div class="form-check me-3 me-lg-5">
                                                    <input class="form-check-input" type="checkbox" id="contentManagementRead" />
                                                    <label class="form-check-label" for="contentManagementRead"> Read </label>
                                                </div>
                                                <div class="form-check me-3 me-lg-5">
                                                    <input class="form-check-input" type="checkbox" id="contentManagementWrite" />
                                                    <label class="form-check-label" for="contentManagementWrite"> Write </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="contentManagementCreate" />
                                                    <label class="form-check-label" for="contentManagementCreate"> Create </label>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-nowrap fw-bolder">Disputes Management</td>
                                        <td>
                                            <div class="d-flex">
                                                <div class="form-check me-3 me-lg-5">
                                                    <input class="form-check-input" type="checkbox" id="dispManagementRead" />
                                                    <label class="form-check-label" for="dispManagementRead"> Read </label>
                                                </div>
                                                <div class="form-check me-3 me-lg-5">
                                                    <input class="form-check-input" type="checkbox" id="dispManagementWrite" />
                                                    <label class="form-check-label" for="dispManagementWrite"> Write </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="dispManagementCreate" />
                                                    <label class="form-check-label" for="dispManagementCreate"> Create </label>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-nowrap fw-bolder">Database Management</td>
                                        <td>
                                            <div class="d-flex">
                                                <div class="form-check me-3 me-lg-5">
                                                    <input class="form-check-input" type="checkbox" id="dbManagementRead" />
                                                    <label class="form-check-label" for="dbManagementRead"> Read </label>
                                                </div>
                                                <div class="form-check me-3 me-lg-5">
                                                    <input class="form-check-input" type="checkbox" id="dbManagementWrite" />
                                                    <label class="form-check-label" for="dbManagementWrite"> Write </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="dbManagementCreate" />
                                                    <label class="form-check-label" for="dbManagementCreate"> Create </label>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-nowrap fw-bolder">Financial Management</td>
                                        <td>
                                            <div class="d-flex">
                                                <div class="form-check me-3 me-lg-5">
                                                    <input class="form-check-input" type="checkbox" id="finManagementRead" />
                                                    <label class="form-check-label" for="finManagementRead"> Read </label>
                                                </div>
                                                <div class="form-check me-3 me-lg-5">
                                                    <input class="form-check-input" type="checkbox" id="finManagementWrite" />
                                                    <label class="form-check-label" for="finManagementWrite"> Write </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="finManagementCreate" />
                                                    <label class="form-check-label" for="finManagementCreate"> Create </label>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-nowrap fw-bolder">Reporting</td>
                                        <td>
                                            <div class="d-flex">
                                                <div class="form-check me-3 me-lg-5">
                                                    <input class="form-check-input" type="checkbox" id="reportingRead" />
                                                    <label class="form-check-label" for="reportingRead"> Read </label>
                                                </div>
                                                <div class="form-check me-3 me-lg-5">
                                                    <input class="form-check-input" type="checkbox" id="reportingWrite" />
                                                    <label class="form-check-label" for="reportingWrite"> Write </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="reportingCreate" />
                                                    <label class="form-check-label" for="reportingCreate"> Create </label>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-nowrap fw-bolder">API Control</td>
                                        <td>
                                            <div class="d-flex">
                                                <div class="form-check me-3 me-lg-5">
                                                    <input class="form-check-input" type="checkbox" id="apiRead" />
                                                    <label class="form-check-label" for="apiRead"> Read </label>
                                                </div>
                                                <div class="form-check me-3 me-lg-5">
                                                    <input class="form-check-input" type="checkbox" id="apiWrite" />
                                                    <label class="form-check-label" for="apiWrite"> Write </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="apiCreate" />
                                                    <label class="form-check-label" for="apiCreate"> Create </label>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-nowrap fw-bolder">Repository Management</td>
                                        <td>
                                            <div class="d-flex">
                                                <div class="form-check me-3 me-lg-5">
                                                    <input class="form-check-input" type="checkbox" id="repoRead" />
                                                    <label class="form-check-label" for="repoRead"> Read </label>
                                                </div>
                                                <div class="form-check me-3 me-lg-5">
                                                    <input class="form-check-input" type="checkbox" id="repoWrite" />
                                                    <label class="form-check-label" for="repoWrite"> Write </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="repoCreate" />
                                                    <label class="form-check-label" for="repoCreate"> Create </label>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-nowrap fw-bolder">Payroll</td>
                                        <td>
                                            <div class="d-flex">
                                                <div class="form-check me-3 me-lg-5">
                                                    <input class="form-check-input" type="checkbox" id="payrollRead" />
                                                    <label class="form-check-label" for="payrollRead"> Read </label>
                                                </div>
                                                <div class="form-check me-3 me-lg-5">
                                                    <input class="form-check-input" type="checkbox" id="payrollWrite" />
                                                    <label class="form-check-label" for="payrollWrite"> Write </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="payrollCreate" />
                                                    <label class="form-check-label" for="payrollCreate"> Create </label>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- Permission Table END -->
                        
                    </div>
                    <div class="col-4 text-center mt-2">
                        <button type="submit" class="btn btn-primary me-1">Submit</button>
                        <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal" aria-label="Close">
                                            Discard
                        </button>
                    </div>
                </form>
                </div>
                <!-- Add Role Form END-->
                
            </div>
        </div>
    </div>
    <!-- END: Content-->

@endsection