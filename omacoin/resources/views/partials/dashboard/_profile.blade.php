@if(Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
<div class="single-portfolio border border-primary p-4">
    <div class="row">
        <div class="col-lg-3 col-md-4 col-8 mb-2 mb-lg-0">
            <div class="single-accordion">
                <div class="accordion-style-four">
                    <div class="accordion" id="accordionPhoto">
                        <div class="card mt-0">
                            <div class="card-header" id="headingPhoto">
                                <a class="collapsed" href="#collapsePhoto" data-toggle="collapse" role="button" aria-expanded="false">Photograph</a>
                            </div>

                            <div id="collapsePhoto" class="collapse" data-parent="#accordionPhoto">
                                <div class="card-body">
                                    <div class="form-group" data-value="{{ asset('img/users/' . Auth::user()->photo) }}">
                                        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <input name="fieldname" value="photo" type="hidden" />
                                            
                                            <div class="fileinput fileinput-new w-100 mb-0" data-provides="fileinput">
                                                <div class="fileinput-new thumbnail w-100 field-border">
                                                    <img src="{{ asset('img/users/' . Auth::user()->photo) }}" class="img-fluid" alt="...">
                                                </div>
                                                <div class="fileinput-preview fileinput-exists thumbnail lh-0 field-border active"></div>
                                                <div class="d-flex justify-content-between">
                                                    <span class="btn-default btn-file light-rounded-buttons">
                                                        <span class="fileinput-new file-click main-btn light-rounded-two sm-btn d-flex align-items-center px-0 select">
                                                            <i class="lni-pencil-alt size-xs font-weight-bold mx-auto"></i>
                                                        </span>
                                                        <span class="fileinput-exists file-click main-btn light-rounded-two hoverable sm-btn d-flex align-items-center px-0 change">
                                                            <i class="lni-pencil size-xs font-weight-bold mx-auto"></i>
                                                        </span>
                                                        <!-- <span class="fileinput-new file-click left floated main-btn light-rounded-two sm-btn">Select Image</span> -->
                                                        <!-- <span class="fileinput-exists file-click left floated main-btn light-rounded-two sm-btn">Change</span> -->
                                                        <input name="photo" type="file" accept="image/*" />
                                                    </span>
                                                    <span class="regular-icon-buttons d-flex">
                                                        <ul class="save">
                                                            <li class="mt-0 success-buttons">
                                                                <button type="button" class="fileinput-exists regular-icon-light-ten d-flex align-items-center success-two hoverable">
                                                                    <i class="lni-upload size-xs font-weight-bold mx-auto"></i>
                                                                </button>
                                                            </li>
                                                        </ul>
                                                        <ul class="cancel">
                                                            <li class="mt-0 danger-buttons ml-2">
                                                                <a href="#pablo" class="fileinput-exists regular-icon-light-ten d-flex align-items-center danger-two hoverable" data-dismiss="fileinput">
                                                                    <i class="lni-close size-xs font-weight-bold mx-auto"></i>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </span>
                                                    
                                                </div>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-5 col-md-8 mb-2 mb-lg-0">
            <div class="single-accordion">
                <div class="accordion-style-four">
                    <div class="accordion" id="accordionAccount">
                        <div class="card mt-0">
                            <div class="card-header" id="headingSixteen">
                                <a class="collapsed" href="#collapseSixteen" data-toggle="collapse" role="button" aria-expanded="false">Account Information</a>
                            </div>

                            <div id="collapseSixteen" class="collapse" data-parent="#accordionAccount">
                                <div class="card-body">
                                    <div class="form-style form-style-two">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-input" data-value="{{ Auth::user()->email }}">
                                                    <form action="{{ route('profile.update') }}" method="POST">
                                                        @csrf
                                                        <input name="fieldname" value="email" type="hidden" />

                                                        <label>Email Address</label>
                                                        <div class="input-items active regular-icon-buttons">
                                                            <input readonly type="text" name="email" placeholder="Email" value="{{ Auth::user()->email }}">
                                                            <span>
                                                                <a href="" class="regular-icon-light-two edit"><i class="lni-pencil-alt font-weight-bolder"></i></a>
                                                                <a href="" class="regular-icon-light-two cancel hidden"><i class="lni-cross-circle font-weight-bolder text-danger"></i></a>
                                                                <button class="regular-icon-light-two save hidden border-0"><i class="lni-check-mark-circle font-weight-bolder text-success mr-4"></i></button>
                                                            </span>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-input light-rounded-buttons">
                                                    <label>Password</label>
                                                    <div>
                                                        <a id="passwordButton" href="" class="main-btn light-rounded-five sm-btn"> <span><i class="lni-key font-weight-bolder"></i></span> CHANGE PASSWORD</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-12">
            <div class="single-accordion">
                <div class="accordion-style-four">
                    <div class="accordion" id="accordionPersonal">
                        <div class="card mt-0">
                            <div class="card-header" id="headingSaventeen">
                                <a class="collapsed" href="#collapseSaventeen" data-toggle="collapse" role="button" aria-expanded="false" >Personal Information</a>
                            </div>
                            <div id="collapseSaventeen" class="collapse" data-parent="#accordionPersonal">
                                <div class="card-body">
                                    <div class="form-style form-style-two">
                                        <div class="row">
                                            <div class="col-lg-12 col-md-4">
                                                <div class="form-input" data-value="{{ Auth::user()->surname }}">
                                                    <form action="{{ route('profile.update') }}" method="POST">
                                                        @csrf
                                                        <input name="fieldname" value="surname" type="hidden" />

                                                        <label>Surname</label>
                                                        <div class="input-items active regular-icon-buttons">
                                                            <input readonly type="text" name="surname" placeholder="Surname" value="{{ Auth::user()->surname }}">
                                                            <span>
                                                                <a href="" class="regular-icon-light-two edit"><i class="lni-pencil-alt font-weight-bolder"></i></a>
                                                                <a href="" class="regular-icon-light-two cancel hidden"><i class="lni-cross-circle font-weight-bolder text-danger"></i></a>
                                                                <button class="regular-icon-light-two save hidden border-0"><i class="lni-check-mark-circle font-weight-bolder text-success mr-4"></i></button>
                                                            </span>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>

                                            <div class="col-lg-12 col-md-4">
                                                <div class="form-input" data-value="{{ Auth::user()->firstname }}">
                                                    <form action="{{ route('profile.update') }}" method="POST">
                                                        @csrf
                                                        <input name="fieldname" value="firstname" type="hidden" />

                                                        <label>Firstname</label>
                                                        <div class="input-items active regular-icon-buttons">
                                                            <input readonly type="text" name="firstname" placeholder="Firstname" value="{{ Auth::user()->firstname }}">
                                                            <span>
                                                                <a href="" class="regular-icon-light-two edit"><i class="lni-pencil-alt font-weight-bolder"></i></a>
                                                                <a href="" class="regular-icon-light-two cancel hidden"><i class="lni-cross-circle font-weight-bolder text-danger"></i></a>
                                                                <button class="regular-icon-light-two save hidden border-0"><i class="lni-check-mark-circle font-weight-bolder text-success mr-4"></i></button>
                                                            </span>
                                                        </div>
                                                    </form>
                                                </div> <!-- form input -->
                                            </div>
                                            
                                            <div class="col-lg-12 col-md-4">
                                                <div class="form-input" data-value="{{ Auth::user()->phone_number }}">
                                                    <form action="{{ route('profile.update') }}" method="POST">
                                                        @csrf
                                                        <input name="fieldname" value="phone_number" type="hidden" />

                                                        <label>Phone Number</label>
                                                        <div class="input-items active regular-icon-buttons">
                                                            <input readonly type="text" name="phone_number" placeholder="Phone Number" value="{{ Auth::user()->phone_number }}">
                                                            <span>
                                                                <a href="" class="regular-icon-light-two edit"><i class="lni-pencil-alt font-weight-bolder"></i></a>
                                                                <a href="" class="regular-icon-light-two cancel hidden"><i class="lni-cross-circle font-weight-bolder text-danger"></i></a>
                                                                <button class="regular-icon-light-two save hidden border-0"><i class="lni-check-mark-circle font-weight-bolder text-success mr-4"></i></button>
                                                            </span>
                                                        </div>
                                                    </form>
                                                </div> <!-- form input -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

@if(Auth::user()->role == 'member')
<div class="single-portfolio border border-primary p-4">
    <div class="row">
        <div class="col-sm-5 col-lg-3 mb-2 mb-md-0">
            <div class="single-accordion">
                <div class="accordion-style-four">
                    <div class="accordion" id="accordionPhoto">
                        <div class="card mt-0">
                            <div class="card-header" id="headingPhoto">
                                <a href="#collapsePhoto" data-toggle="collapse" role="button" aria-expanded="true">Photograph</a>
                            </div>

                            <div id="collapsePhoto" class="collapse show" data-parent="#accordionPhoto">
                                <div class="card-body">
                                    <div class="form-group" data-value="{{ asset('img/users/' . Auth::user()->photo) }}">
                                        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <input name="fieldname" value="photo" type="hidden" />
                                            
                                            <div class="fileinput fileinput-new w-100 mb-0" data-provides="fileinput">
                                                <div class="fileinput-new thumbnail w-100 field-border">
                                                    <img src="{{ asset('img/users/' . Auth::user()->photo) }}" class="img-fluid" alt="...">
                                                </div>
                                                <div class="fileinput-preview fileinput-exists thumbnail lh-0 field-border active"></div>
                                                <div class="d-flex justify-content-between">
                                                    <span class="btn-default btn-file light-rounded-buttons">
                                                        <span class="fileinput-new file-click main-btn light-rounded-two sm-btn d-flex align-items-center px-0 select">
                                                            <i class="lni-pencil-alt size-xs font-weight-bold mx-auto"></i>
                                                        </span>
                                                        <span class="fileinput-exists file-click main-btn light-rounded-two hoverable sm-btn d-flex align-items-center px-0 change">
                                                            <i class="lni-pencil size-xs font-weight-bold mx-auto"></i>
                                                        </span>
                                                        <input name="photo" type="file" accept="image/*" />
                                                    </span>
                                                    <span class="regular-icon-buttons d-flex">
                                                        <ul class="save">
                                                            <li class="mt-0 success-buttons">
                                                                <button type="button" class="fileinput-exists regular-icon-light-ten d-flex align-items-center success-two hoverable">
                                                                    <i class="lni-upload size-xs font-weight-bold mx-auto"></i>
                                                                </button>
                                                            </li>
                                                        </ul>
                                                        <ul class="cancel">
                                                            <li class="mt-0 danger-buttons ml-2">
                                                                <a href="#pablo" class="fileinput-exists regular-icon-light-ten d-flex align-items-center danger-two hoverable" data-dismiss="fileinput">
                                                                    <i class="lni-close size-xs font-weight-bold mx-auto"></i>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </span>
                                                    
                                                </div>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-7 col-lg-9">
            <div class="single-accordion">
                <div class="accordion-style-four">
                    <div class="accordion" id="accordionProfile">
                        <div class="card mt-0">
                            <div class="card-header" id="headingSixteen">
                                <a href="#collapseSixteen" data-toggle="collapse" role="button" aria-expanded="false">Account Information</a>
                            </div>

                            <div id="collapseSixteen" class="collapse show" data-parent="#accordionProfile">
                                <div class="card-body">
                                    <div class="form-style form-style-two">
                                        <div class="row">
                                            <div class="col-lg-7 col-xl-8">
                                                <div class="form-input" data-value="{{ Auth::user()->email }}">
                                                    <form action="{{ route('profile.update') }}" method="POST">
                                                        @csrf
                                                        <input name="fieldname" value="email" type="hidden" />

                                                        <label>Email Address</label>
                                                        <div class="input-items active regular-icon-buttons">
                                                            <input readonly type="text" name="email" placeholder="Email" value="{{ Auth::user()->email }}">
                                                            <span>
                                                                <a href="" class="regular-icon-light-two edit"><i class="lni-pencil-alt font-weight-bolder"></i></a>
                                                                <a href="" class="regular-icon-light-two cancel hidden"><i class="lni-cross-circle font-weight-bolder text-danger"></i></a>
                                                                <button class="regular-icon-light-two save hidden border-0"><i class="lni-check-mark-circle font-weight-bolder text-success mr-4"></i></button>
                                                            </span>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <div class="col-lg-5 col-xl-4">
                                                <div class="form-input light-rounded-buttons">
                                                    <label>Password</label>
                                                    <div>
                                                        <a id="passwordButton" href="" class="main-btn light-rounded-five sm-btn"> <span><i class="lni-key font-weight-bolder"></i></span> CHANGE PASSWORD</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> 
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header" id="headingSaventeen">
                                <a class="collapsed" href="#collapseSaventeen" data-toggle="collapse" role="button" aria-expanded="false" >Personal Information</a>
                            </div>
                            <div id="collapseSaventeen" class="collapse" data-parent="#accordionProfile">
                                <div class="card-body">
                                    <div class="form-style form-style-two">
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="form-input" data-value="{{ Auth::user()->surname }}">
                                                    <form action="{{ route('profile.update') }}" method="POST">
                                                        @csrf
                                                        <input name="fieldname" value="surname" type="hidden" />

                                                        <label>Surname</label>
                                                        <div class="input-items active regular-icon-buttons">
                                                            <input readonly type="text" name="surname" placeholder="Surname" value="{{ Auth::user()->surname }}">
                                                            <span>
                                                                <a href="" class="regular-icon-light-two edit"><i class="lni-pencil-alt font-weight-bolder"></i></a>
                                                                <a href="" class="regular-icon-light-two cancel hidden"><i class="lni-cross-circle font-weight-bolder text-danger"></i></a>
                                                                <button class="regular-icon-light-two save hidden border-0"><i class="lni-check-mark-circle font-weight-bolder text-success mr-4"></i></button>
                                                            </span>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>

                                            <div class="col-lg-4">
                                                <div class="form-input" data-value="{{ Auth::user()->firstname }}">
                                                    <form action="{{ route('profile.update') }}" method="POST">
                                                        @csrf
                                                        <input name="fieldname" value="firstname" type="hidden" />

                                                        <label>Firstname</label>
                                                        <div class="input-items active regular-icon-buttons">
                                                            <input readonly type="text" name="firstname" placeholder="Firstname" value="{{ Auth::user()->firstname }}">
                                                            <span>
                                                                <a href="" class="regular-icon-light-two edit"><i class="lni-pencil-alt font-weight-bolder"></i></a>
                                                                <a href="" class="regular-icon-light-two cancel hidden"><i class="lni-cross-circle font-weight-bolder text-danger"></i></a>
                                                                <button class="regular-icon-light-two save hidden border-0"><i class="lni-check-mark-circle font-weight-bolder text-success mr-4"></i></button>
                                                            </span>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            
                                            <div class="col-lg-4">
                                                <div class="form-input" data-value="{{ Auth::user()->phone_number }}">
                                                    <form action="{{ route('profile.update') }}" method="POST">
                                                        @csrf
                                                        <input name="fieldname" value="phone_number" type="hidden" />

                                                        <label>Phone Number</label>
                                                        <div class="input-items active regular-icon-buttons">
                                                            <input readonly type="text" name="phone_number" placeholder="Phone Number" value="{{ Auth::user()->phone_number }}">
                                                            <span>
                                                                <a href="" class="regular-icon-light-two edit"><i class="lni-pencil-alt font-weight-bolder"></i></a>
                                                                <a href="" class="regular-icon-light-two cancel hidden"><i class="lni-cross-circle font-weight-bolder text-danger"></i></a>
                                                                <button class="regular-icon-light-two save hidden border-0"><i class="lni-check-mark-circle font-weight-bolder text-success mr-4"></i></button>
                                                            </span>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header" id="headingEightteen">
                                <a class="collapsed" href="#collapseEightteen" data-toggle="collapse" role="button"  aria-expanded="false">Bank Information</a>
                            </div>
                            <div id="collapseEightteen" class="collapse" data-parent="#accordionProfile">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-4 col-sm-6 mb-4 col-md-3 col-lg-2">
                                            <div class="form-input">
                                                <label>Bank Icon</label>
                                                <div class="input-items">
                                                    <img src="{{ asset('img/banks/' . $userbank->icon) }}" class="w-100 img-fluid rounded bank-logo border p-1" alt="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-9 col-lg-10">
                                            <div class="form-style form-style-two">
                                                <div class="row">

                                                    <div class="col-12 col-lg-6 pb-4">
                                                        <div class="custom-dropdown form-input" data-value="{{ $userbank->id . '|' . asset('img/banks/' . $userbank->icon) }}">
                                                            <form action="{{ route('profile.update') }}" method="POST">
                                                                @csrf
                                                                <input name="fieldname" value="bank_id" type="hidden" />
                                                                
                                                                <label>Bank Name</label>
                                                                <div class="input-items active regular-icon-buttons" style="height:24px">
                                                                    <select disabled name="bank_id" class="bank">
                                                                        
                                                                        @foreach($banks as $bank)
                                                                            @if($bank->id == 1)
                                                                                <option selected value="{{ $bank->id . '|' . asset('img/banks/' . $bank->icon) }}">{{ $bank->name }}</option>
                                                                            @else
                                                                                @if($bank->id == $userbank->id)
                                                                                <option selected value="{{ $bank->id . '|' . asset('img/banks/' . $bank->icon) }}">{{ $bank->name }}</option>
                                                                                @else
                                                                                <option value="{{ $bank->id . '|' . asset('img/banks/' . $bank->icon) }}">{{ $bank->name }}</option>
                                                                                @endif
                                                                            @endif
                                                                        @endforeach
                                                                    </select>
                                                                    <span>
                                                                        <a href="" class="regular-icon-light-two edit"><i class="lni-pencil-alt font-weight-bolder"></i></a>
                                                                        <a href="" class="regular-icon-light-two cancel hidden"><i class="lni-cross-circle font-weight-bolder text-danger"></i></a>
                                                                        <button class="regular-icon-light-two save hidden border-0"><i class="lni-check-mark-circle font-weight-bolder text-success mr-4"></i></button>
                                                                    </span>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-12 col-lg-6">
                                                        <div class="form-input" data-value="{{ Auth::user()->account_number }}">
                                                            <form action="{{ route('profile.update') }}" method="POST">
                                                                @csrf
                                                                <input name="fieldname" value="account_number" type="hidden" />

                                                                <label>Account Number</label>
                                                                <div class="input-items active regular-icon-buttons">
                                                                    <input readonly type="text" name="account_number" placeholder="Account Number" value="{{ Auth::user()->account_number }}">
                                                                    <span>
                                                                        <a href="" class="regular-icon-light-two edit"><i class="lni-pencil-alt font-weight-bolder"></i></a>
                                                                        <a href="" class="regular-icon-light-two cancel hidden"><i class="lni-cross-circle font-weight-bolder text-danger"></i></a>
                                                                        <button class="regular-icon-light-two save hidden border-0"><i class="lni-check-mark-circle font-weight-bolder text-success mr-4"></i></button>
                                                                    </span>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>

                                                    <div class="col-12">
                                                        <div class="form-input" data-value="{{ Auth::user()->account_number }}">
                                                            <form action="{{ route('profile.update') }}" method="POST">
                                                                @csrf
                                                                <input name="fieldname" value="account_name" type="hidden" />

                                                                <label>Account Name</label>
                                                                <div class="input-items active regular-icon-buttons">
                                                                    <input readonly type="text" name="account_name" placeholder="Account Name" value="{{ Auth::user()->account_name }}">
                                                                    <span>
                                                                        <a href="" class="regular-icon-light-two edit"><i class="lni-pencil-alt font-weight-bolder"></i></a>
                                                                        <a href="" class="regular-icon-light-two cancel hidden"><i class="lni-cross-circle font-weight-bolder text-danger"></i></a>
                                                                        <button class="regular-icon-light-two save hidden border-0"><i class="lni-check-mark-circle font-weight-bolder text-success mr-4"></i></button>
                                                                    </span>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        
                                    </div> <!-- row -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif