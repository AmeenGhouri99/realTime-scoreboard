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
                  <h2 class="content-header-title float-start mb-0">Roles</h2>
                  <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                      <li class="breadcrumb-item active">Roles</li>
                    </ol>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <!-- Bread Crumb END-->
        
        <!--Mian Body Starts Here-->

          <!-- Role Cards START-->
            <div class="row g-2">

              <!-- Administrator Role Card START-->
              <div class="col-xl-4 col-lg-6 col-md-6">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex justify-content-between">
                      <h6 class="fw-normal mb-2">Total 4 users</h6>
                      <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Vinnie Mostowy" class="avatar avatar-sm pull-up">
                          <img class="rounded-circle" src="{{asset('app-assets/images/avatars/5.png')}}" alt="Avatar">
                        </li>
                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Allen Rieske" class="avatar avatar-sm pull-up">
                          <img class="rounded-circle" src="{{asset('app-assets/images/avatars/12.png')}}" alt="Avatar">
                        </li>
                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Julee Rossignol" class="avatar avatar-sm pull-up">
                          <img class="rounded-circle" src="{{asset('app-assets/images/avatars/6.png')}}" alt="Avatar">
                        </li>
                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Kaith D'souza" class="avatar avatar-sm pull-up">
                          <img class="rounded-circle" src="{{asset('app-assets/images/avatars/3.png')}}" alt="Avatar">
                        </li>
                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="John Doe" class="avatar avatar-sm pull-up">
                          <img class="rounded-circle" src="{{asset('app-assets/images/avatars/1.png')}}" alt="Avatar">
                        </li>
                      </ul>
                    </div>
                    <div class="d-flex justify-content-between align-items-end mt-1">
                      <div class="role-heading">
                        <h4 class="mb-1">Administrator</h4>
                        <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#addRoleModal" class="role-edit-modal"><span>Edit Role</span></a>
                      </div>
                      <a href="javascript:void(0);" class="text-muted"><i class="ti ti-copy ti-md"></i></a>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Administrator Role Card END-->

              <!-- Manager Role Card START-->
              <div class="col-xl-4 col-lg-6 col-md-6">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex justify-content-between">
                      <h6 class="fw-normal mb-2">Total 7 users</h6>
                      <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Jimmy Ressula" class="avatar avatar-sm pull-up">
                          <img class="rounded-circle" src="{{asset('app-assets/images/avatars/4.png')}}" alt="Avatar">
                        </li>
                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="John Doe" class="avatar avatar-sm pull-up">
                          <img class="rounded-circle" src="{{asset('app-assets/images/avatars/1.png')}}" alt="Avatar">
                        </li>
                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Kristi Lawker" class="avatar avatar-sm pull-up">
                          <img class="rounded-circle" src="{{asset('app-assets/images/avatars/2.png')}}" alt="Avatar">
                        </li>
                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Kaith D'souza" class="avatar avatar-sm pull-up">
                          <img class="rounded-circle" src="{{asset('app-assets/images/avatars/3.png')}}" alt="Avatar">
                        </li>
                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Danny Paul" class="avatar avatar-sm pull-up">
                          <img class="rounded-circle" src="{{asset('app-assets/images/avatars/7.png')}}" alt="Avatar">
                        </li>
                      </ul>
                    </div>
                    <div class="d-flex justify-content-between align-items-end mt-1">
                      <div class="role-heading">
                        <h4 class="mb-1">Manager</h4>
                        <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#addRoleModal" class="role-edit-modal"><span>Edit Role</span></a>
                      </div>
                      <a href="javascript:void(0);" class="text-muted"><i class="ti ti-copy ti-md"></i></a>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Manager Role Card END-->

              <!-- Users Role Card START-->
              <div class="col-xl-4 col-lg-6 col-md-6">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex justify-content-between">
                      <h6 class="fw-normal mb-2">Total 5 users</h6>
                      <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Andrew Tye" class="avatar avatar-sm pull-up">
                          <img class="rounded-circle" src="{{asset('app-assets/images/avatars/6.png')}}" alt="Avatar">
                        </li>
                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Rishi Swaat" class="avatar avatar-sm pull-up">
                          <img class="rounded-circle" src="{{asset('app-assets/images/avatars/9.png')}}" alt="Avatar">
                        </li>
                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Rossie Kim" class="avatar avatar-sm pull-up">
                          <img class="rounded-circle" src="{{asset('app-assets/images/avatars/12.png')}}" alt="Avatar">
                        </li>
                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Kim Merchent" class="avatar avatar-sm pull-up">
                          <img class="rounded-circle" src="{{asset('app-assets/images/avatars/10.png')}}" alt="Avatar">
                        </li>
                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Sam D'souza" class="avatar avatar-sm pull-up">
                          <img class="rounded-circle" src="{{asset('app-assets/images/avatars/3.png')}}" alt="Avatar">
                        </li>
                      </ul>
                    </div>
                    <div class="d-flex justify-content-between align-items-end mt-1">
                      <div class="role-heading">
                        <h4 class="mb-1">Users</h4>
                        <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#addRoleModal" class="role-edit-modal"><span>Edit Role</span></a>
                      </div>
                      <a href="javascript:void(0);" class="text-muted"><i class="ti ti-copy ti-md"></i></a>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Users Role Card END-->

              <!-- Support Role Card START-->
              <div class="col-xl-4 col-lg-6 col-md-6">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex justify-content-between">
                      <h6 class="fw-normal mb-2">Total 3 users</h6>
                      <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Kim Karlos" class="avatar avatar-sm pull-up">
                          <img class="rounded-circle" src="{{asset('app-assets/images/avatars/3.png')}}" alt="Avatar">
                        </li>
                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Katy Turner" class="avatar avatar-sm pull-up">
                          <img class="rounded-circle" src="{{asset('app-assets/images/avatars/9.png')}}" alt="Avatar">
                        </li>
                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Peter Adward" class="avatar avatar-sm pull-up">
                          <img class="rounded-circle" src="{{asset('app-assets/images/avatars/4.png')}}" alt="Avatar">
                        </li>
                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Kaith D'souza" class="avatar avatar-sm pull-up">
                          <img class="rounded-circle" src="{{asset('app-assets/images/avatars/10.png')}}" alt="Avatar">
                        </li>
                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="John Parker" class="avatar avatar-sm pull-up">
                          <img class="rounded-circle" src="{{asset('app-assets/images/avatars/11.png')}}" alt="Avatar">
                        </li>
                      </ul>
                    </div>
                    <div class="d-flex justify-content-between align-items-end mt-1">
                      <div class="role-heading">
                        <h4 class="mb-1">Support</h4>
                        <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#addRoleModal" class="role-edit-modal"><span>Edit Role</span></a>
                      </div>
                      <a href="javascript:void(0);" class="text-muted"><i class="ti ti-copy ti-md"></i></a>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Support Role Card END-->

              <!-- Restricted User Role Card START-->
              <div class="col-xl-4 col-lg-6 col-md-6">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex justify-content-between">
                      <h6 class="fw-normal mb-2">Total 2 users</h6>
                      <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Kim Merchent" class="avatar avatar-sm pull-up">
                          <img class="rounded-circle" src="{{asset('app-assets/images/avatars/10.png')}}" alt="Avatar">
                        </li>
                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Sam D'souza" class="avatar avatar-sm pull-up">
                          <img class="rounded-circle" src="{{asset('app-assets/images/avatars/3.png')}}" alt="Avatar">
                        </li>
                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Nurvi Karlos" class="avatar avatar-sm pull-up">
                          <img class="rounded-circle" src="{{asset('app-assets/images/avatars/5.png')}}" alt="Avatar">
                        </li>
                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Andrew Tye" class="avatar avatar-sm pull-up">
                          <img class="rounded-circle" src="{{asset('app-assets/images/avatars/8.png')}}" alt="Avatar">
                        </li>
                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="Rossie Kim" class="avatar avatar-sm pull-up">
                          <img class="rounded-circle" src="{{asset('app-assets/images/avatars/9.png')}}" alt="Avatar">
                        </li>
                      </ul>
                    </div>
                    <div class="d-flex justify-content-between align-items-end mt-1">
                      <div class="role-heading">
                        <h4 class="mb-1">Restricted User</h4>
                        <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#addRoleModal" class="role-edit-modal"><span>Edit Role</span></a>
                      </div>
                      <a href="javascript:void(0);" class="text-muted"><i class="ti ti-copy ti-md"></i></a>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Restricted User Role Card END-->

              <!-- Add New Role Card START-->
              <div class="col-xl-4 col-lg-6 col-md-6">
                <div class="card h-100">
                  <div class="row h-100">
                    <div class="col-sm-5">
                      <div class="d-flex align-items-end h-100 justify-content-center mt-sm-0 mt-3">
                        <img src="{{asset('app-assets/images/illustration/faq-illustrations.svg')}}" class="img-fluid mt-sm-4 mt-md-0" alt="add-new-roles" width="150">
                      </div>
                    </div>
                    <div class="col-sm-7">
                      <div class="card-body text-sm-end text-center ps-sm-0">
                        <a href="{{route('admin.roles.create')}}"><button class="btn btn-primary mb-2 text-nowrap add-new-role">Add New Role</button></a>
                        <p class="mb-0 mt-1">Add role, if it does not exist</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Add New Role Card END -->

              <!-- Role Table START -->
              <div class="col-12">
                <div class="card">
                  <div class="card-datatable table-responsive">
                    <table class="datatables-users table border-top">
                      <thead>
                      <tr>
                        <th></th>
                        <th>User</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                      <!-- Row 1 -->
                      <tr>
                        <td>1</td>
                        <td>John Doe</td>
                        <td>Admin</td>
                        <td>Active</td>
                        <td>
                          <div class="dropdown">
                            <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0" data-bs-toggle="dropdown">
                              <i data-feather="more-vertical"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                              <a class="dropdown-item" href="#">
                                <i data-feather="edit-2" class="me-50"></i>
                                <span>Edit</span>
                              </a>
                              <a class="dropdown-item" href="#">
                                <i data-feather="trash" class="me-50"></i>
                                <span>Delete</span>
                              </a>
                            </div>
                          </div>
                        </td>
                      </tr>
                      <!-- Row 2 -->
                      <tr>
                        <td>2</td>
                        <td>Jane Smith</td>
                        <td>Manager</td>
                        <td>Inactive</td>
                        <td>
                          <div class="dropdown">
                            <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0" data-bs-toggle="dropdown">
                              <i data-feather="more-vertical"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                              <a class="dropdown-item" href="#">
                                <i data-feather="edit-2" class="me-50"></i>
                                <span>Edit</span>
                              </a>
                              <a class="dropdown-item" href="#">
                                <i data-feather="trash" class="me-50"></i>
                                <span>Delete</span>
                              </a>
                            </div>
                          </div>
                        </td>
                      </tr>
                      <!-- Row 3 -->
                      <tr>
                        <td>3</td>
                        <td>Michael Johnson</td>
                        <td>Employee</td>
                        <td>Active</td>
                        <td>
                          <div class="dropdown">
                            <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0" data-bs-toggle="dropdown">
                              <i data-feather="more-vertical"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                              <a class="dropdown-item" href="#">
                                <i data-feather="edit-2" class="me-50"></i>
                                <span>Edit</span>
                              </a>
                              <a class="dropdown-item" href="#">
                                <i data-feather="trash" class="me-50"></i>
                                <span>Delete</span>
                              </a>
                            </div>
                          </div>
                        </td>
                      </tr>
                      <!-- Row 4 -->
                      <tr>
                        <td>4</td>
                        <td>Sarah Williams</td>
                        <td>Supervisor</td>
                        <td>Inactive</td>
                        <td>
                          <div class="dropdown">
                            <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0" data-bs-toggle="dropdown">
                              <i data-feather="more-vertical"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                              <a class="dropdown-item" href="#">
                                <i data-feather="edit-2" class="me-50"></i>
                                <span>Edit</span>
                              </a>
                              <a class="dropdown-item" href="#">
                                <i data-feather="trash" class="me-50"></i>
                                <span>Delete</span>
                              </a>
                            </div>
                          </div>
                        </td>
                      </tr>
                      <!-- Row 5 -->
                      <tr>
                        <td>5</td>
                        <td>David Brown</td>
                        <td>Admin</td>
                        <td>Active</td>
                        <td>
                          <div class="dropdown">
                            <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0" data-bs-toggle="dropdown">
                              <i data-feather="more-vertical"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                              <a class="dropdown-item" href="#">
                                <i data-feather="edit-2" class="me-50"></i>
                                <span>Edit</span>
                              </a>
                              <a class="dropdown-item" href="#">
                                <i data-feather="trash" class="me-50"></i>
                                <span>Delete</span>
                              </a>
                            </div>
                          </div>
                        </td>
                      </tr>
                      <!-- Row 6 -->
                      <tr>
                        <td>6</td>
                        <td>Laura Wilson</td>
                        <td>Manager</td>
                        <td>Inactive</td>
                        <td>
                          <div class="dropdown">
                            <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0" data-bs-toggle="dropdown">
                              <i data-feather="more-vertical"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                              <a class="dropdown-item" href="#">
                                <i data-feather="edit-2" class="me-50"></i>
                                <span>Edit</span>
                              </a>
                              <a class="dropdown-item" href="#">
                                <i data-feather="trash" class="me-50"></i>
                                <span>Delete</span>
                              </a>
                            </div>
                          </div>
                        </td>
                      </tr>
                      <!-- Row 7 -->
                      <tr>
                        <td>7</td>
                        <td>Robert Davis</td>
                        <td>Employee</td>
                        <td>Active</td>
                        <td>
                          <div class="dropdown">
                            <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0" data-bs-toggle="dropdown">
                              <i data-feather="more-vertical"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                              <a class="dropdown-item" href="#">
                                <i data-feather="edit-2" class="me-50"></i>
                                <span>Edit</span>
                              </a>
                              <a class="dropdown-item" href="#">
                                <i data-feather="trash" class="me-50"></i>
                                <span>Delete</span>
                              </a>
                            </div>
                          </div>
                        </td>
                      </tr>
                      <!-- Row 8 -->
                      <tr>
                        <td>8</td>
                        <td>Emily Lee</td>
                        <td>Supervisor</td>
                        <td>Inactive</td>
                        <td>
                          <div class="dropdown">
                            <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0" data-bs-toggle="dropdown">
                              <i data-feather="more-vertical"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                              <a class="dropdown-item" href="#">
                                <i data-feather="edit-2" class="me-50"></i>
                                <span>Edit</span>
                              </a>
                              <a class="dropdown-item" href="#">
                                <i data-feather="trash" class="me-50"></i>
                                <span>Delete</span>
                              </a>
                            </div>
                          </div>
                        </td>
                      </tr>
                      <!-- Row 9 -->
                      <tr>
                        <td>9</td>
                        <td>William Clark</td>
                        <td>Admin</td>
                        <td>Active</td>
                        <td>
                          <div class="dropdown">
                            <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0" data-bs-toggle="dropdown">
                              <i data-feather="more-vertical"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                              <a class="dropdown-item" href="#">
                                <i data-feather="edit-2" class="me-50"></i>
                                <span>Edit</span>
                              </a>
                              <a class="dropdown-item" href="#">
                                <i data-feather="trash" class="me-50"></i>
                                <span>Delete</span>
                              </a>
                            </div>
                          </div>
                        </td>
                      </tr>
                      <!-- Row 10 -->
                      <tr>
                        <td>10</td>
                        <td>Maria Rodriguez</td>
                        <td>Manager</td>
                        <td>Inactive</td>
                        <td>
                          <div class="dropdown">
                            <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0" data-bs-toggle="dropdown">
                              <i data-feather="more-vertical"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                              <a class="dropdown-item" href="#">
                                <i data-feather="edit-2" class="me-50"></i>
                                <span>Edit</span>
                              </a>
                              <a class="dropdown-item" href="#">
                                <i data-feather="trash" class="me-50"></i>
                                <span>Delete</span>
                              </a>
                            </div>
                          </div>
                        </td>
                      </tr>
                      <!-- End of 10 rows -->
                    </table>
                  </div>
                </div>
              </div>
              <!--/ Role Table END -->

            </div>
            <!--/ Role cards -->
            
      </div>
      <!-- / Content -->

</div>
</div>
<!-- END: Content-->

<div class="sidenav-overlay"></div>
<div class="drag-target"></div>

@endsection