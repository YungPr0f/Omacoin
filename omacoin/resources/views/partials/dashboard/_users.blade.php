@if(Auth::user()->role == 'admin')
<div class="single-portfolio border border-primary p-4">
    <div class="row">
        <div class="col-12">
            <div class="table-box">
                <div class="table-style table-responsive style-two txn_details">
                    <table class="table table striped">
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
                            @foreach($users as $user)
                            <tr>
                                <td class="nowrap text-right">
                                    <span>{{ sprintf("%06d", $user->id) }}</span>
                                    @if($user->role == 'admin')
                                    <i class="lni-crown font-weight-bold ml-1"></i>
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