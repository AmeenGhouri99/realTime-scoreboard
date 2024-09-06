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
                                <h2 class="content-header-title float-start mb-0">Add New User</h2>
                                <div class="breadcrumb-wrapper">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="#">Users</a></li>
                                        <li class="breadcrumb-item active">Add New User</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Bread Crumb END-->

                <!-- Main body START -->
                <div class="card p-2">

                <!-- Image Section START-->
                <div class="d-flex mb-2">
                    <a href="#" class="me-25">
                        <img src="{{asset('app-assets/images/portrait/small/avatar-s-11.jpg')}}" id="account-upload-img" class="uploadedAvatar rounded me-50" alt="profile image" height="80" width="80" />
                    </a>
                    <!-- Upload and Reset Button START-->
                    <div class="d-flex align-items-end mt-75 ms-1">
                        <div>
                            <label for="account-upload" class="btn btn-sm btn-primary mb-75 me-75">Upload</label>
                            <input type="file" id="account-upload" hidden accept="image/*" />
                            <button type="button" id="account-reset" class="btn btn-sm btn-outline-secondary mb-75">Reset</button>
                            <p class="mb-0">Allowed file types: png, jpg, jpeg.</p>
                        </div>
                    </div>
                    <!-- Upload and Reset Button END-->
                </div>
                <!--Image Section END -->

                <!-- Add New User Form START-->
                <form class="add-new-user pt-0">
                    <div class="row pt-1 pb-1">
                    <div class="col-4">
                        <label class="form-label" for="basic-icon-default-fullname">First Name</label>
                        <input type="text" class="form-control dt-full-name" id="basic-icon-default-fullname" placeholder="John" name="user-fullname" />
                    </div>
                    <div class="col-4">
                        <label class="form-label" for="basic-icon-default-uname">Last Name</label>
                        <input type="text" id="basic-icon-default-uname" class="form-control dt-uname" placeholder="Doe" name="user-name" />
                    </div>
                    <div class="col-4">
                        <label class="form-label" for="basic-icon-default-email">Email</label>
                        <input type="text" id="basic-icon-default-email" class="form-control dt-email" placeholder="email@example.com" name="user-email" />
                    </div>
                    </div>
                    <div class="row pt-1 pb-1">
                    <div class="col-4">
                        <label class="form-label" for="basic-icon-default-contact">Phone</label>
                        <input type="text" id="basic-icon-default-contact" class="form-control dt-contact" placeholder="+1 (111) 222-33-44" name="user-contact" />
                    </div>
                    <div class="col-4">
                        <label class="form-label" for="basic-icon-default-company">Refferel Code</label>
                        <input type="text" id="basic-icon-default-company" class="form-control dt-contact" placeholder="A1B2C3" name="user-company" />
                    </div>
                    <div class="col-4">
                        <label class="form-label" for="password">Password</label>
                        <input type="password" id="password" class="form-control dt-contact" placeholder="********" name="user-contact" />
                    </div>
                    </div>


                                <div class="row pt-1 pb-1">
                                    <div class="col-4">
                                <button type="submit" class="btn btn-primary me-1 data-submit">Submit</button>
                                <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                            </div>
                                </div>
                        </form>
                <!-- Add New User Form END-->

                </div>
                <!-- Main Body END -->
            </div>
        </div>
    </div>
    <!-- END: Content-->

@endsection