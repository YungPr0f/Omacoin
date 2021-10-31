@if(Auth::user()->role == 'superadmin')
<div class="single-portfolio border border-primary p-4">
    <div class="row mb-4">
        <div class="col-sm-6 col-lg-4 col-xl-3">
            <div class="single-card card-style-one form-style form-style-two">
                <div class="card-image text-center p-4">
                    <i class="lni-star display-1"></i>
                </div>
                <div class="card-content pt-0">
                    <div class="row justify-content-center">
                        <div class="col light-rounded-buttons buttons">
                            <a href="#" id="create-admin" class="main-btn light-rounded-two text-none font-weight-normal w-100">
                                <i class="lni-plus font-weight-bold mr-1"></i>
                                Create Admin
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-4 col-xl-3">
            <div class="single-card card-style-one form-style form-style-two">
                <div class="card-image text-center px-4 pt-3 pb-0">
                    <span class="text-success d-block">Members</span>
                    <hr class="m-0 border-white">
                    <i class="lni-users display-1"></i>
                    <hr class="m-0 border-white">
                </div>
                <div class="card-content pt-0">
                    <div class="row justify-content-center">
                        <span class="h1 text-success">{{ count($users->where('role', 'member')) }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-4 col-xl-3">
            <div class="single-card card-style-one form-style form-style-two">
                <div class="card-image text-center px-4 pt-3 pb-0">
                    <span class="text-info d-block">Administrators</span>
                    <hr class="m-0 border-white">
                    <i class="lni-star display-1"></i>
                    <hr class="m-0 border-white">
                </div>
                <div class="card-content pt-0">
                    <div class="row justify-content-center">
                        <span class="h1 text-info">{{ count($users->where('role', 'admin')) }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-4 col-xl-3">
            <div class="single-card card-style-one form-style form-style-two">
                <div class="card-image text-center px-4 pt-3 pb-0">
                    <span class="text-danger d-block">Super Administrators</span>
                    <hr class="m-0 border-white">
                    <i class="lni-crown display-1"></i>
                    <hr class="m-0 border-white">
                </div>
                <div class="card-content pt-0">
                    <div class="row justify-content-center">
                        <span class="h1 text-danger">{{ count($users->where('role', 'superadmin')) }}</span>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-12">
            <div class="table-box">
                <div class="table-style table-responsive style-two txn_details">
                    <table class="table table striped mb-0 users-table">
                        <thead class="table-thead container">
                            <tr>
                                <th class="w-1">User ID</th>
                                <th class="w-1">Role</th>
                                <th>Full Name</th>
                                <th class="w-1">Registered</th>
                                <th class="w-1">Action</th>
                            </tr>
                        </thead>
                        <tbody class="table-tbody">
                            <!-- Dummy User - Start -->
                            <tr class="dummy user-row hidden">
                                <td class="nowrap text-right text-mono d-flex align-items-center">
                                    <span class="user-id"></span>
                                    <i class="role-icon font-weight-bold ml-1"></i>
                                </td>
                                <td>
                                    <span class="role"></span>
                                </td>
                                <td class="nowrap">
                                    <span>Surname Firstname</span>
                                </td>
                                <td class="nowrap">
                                    <span class="name">Just Now</span>
                                </td>
                                <td>
                                    <div class="light-rounded-buttons light-rounded-buttons">
                                        <a href="#" class="main-btn light-rounded-two xs-btn text-none font-weight-normal w-100">
                                            More Details  
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <!-- Dummy User - End -->

                            @foreach($users as $user)
                            <tr class="user-row">
                                <td class="nowrap text-right text-mono d-flex align-items-center">
                                    <span>{{ sprintf("%06d", $user->id) }}</span>
                                    @if($user->role == 'superadmin')
                                    <i class="lni-crown font-weight-bold ml-1"></i>
                                    @elseif($user->role == 'admin')
                                    <i class="lni-star font-weight-bold ml-1"></i>
                                    @else
                                    <i class="lni-user font-weight-bold ml-1"></i>
                                    @endif
                                </td>
                                <td>
                                    <span>{{ ucfirst($user->role) }}</span>
                                </td>
                                <td class="nowrap">
                                    <span>{{ $user->surname . ' ' . $user->firstname }}</span>
                                </td>
                                <td class="nowrap">
                                    <span>{{ timeago($user->created_at) }}</span>
                                </td>
                                <td>
                                    <div class="light-rounded-buttons light-rounded-buttons">
                                        <a href="#" class="main-btn light-rounded-two xs-btn text-none font-weight-normal w-100">
                                            More Details  
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endif