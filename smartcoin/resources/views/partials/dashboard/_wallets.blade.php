<div class="single-portfolio border border-primary pt-0 px-4 pb-4">
    <div class="row wallets-container">
        <div class="col-sm-6 col-lg-4 col-xl-3 mt-4">
            <div class="single-card card-style-one wallet form-style form-style-two">
                <div class="card-image text-center p-4">
                    <i class="lni-wallet display-1"></i>
                </div>
                <div class="card-content pt-0">
                    <div class="row justify-content-center">
                        <div class="col light-rounded-buttons buttons">
                            <a href="#" id="add-wallet" class="main-btn light-rounded-two text-none font-weight-normal w-100">
                                <i class="lni-plus font-weight-bold mr-1"></i>
                                Add Wallet
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        

        @foreach($wallets as $wallet)
        <div class="col-sm-6 col-lg-4 col-xl-3 mt-4 wallet-card">
            <div class="single-card card-style-one wallet form-style form-style-two has-overlay">
                <div class="card-image d-flex align-items-center qr">
                    <img class="p-3 img-fluid qrcode" src="{{ asset('img/wallets/' . $wallet->qrcode) }}" alt="Image">
                </div>
                <div class="form-input note d-flex align-items-center bg-transparent">
                    <div class="input-items active p-3">
                        @if(!empty($wallet->note))
                        <div class="display-text bg-transparent text-transparent" style="max-height: 100% !important;">
                            {!! $wallet->note !!}
                        </div>
                        @else
                        <div class="display-text bg-transparent text-transparent text-center" style="max-height: 100% !important;">
                            Nothing Here
                        </div>
                        @endif
                    </div>
                </div>
                <div class="card-content form-input">
                    <div class="row mb-2">
                        <div class="col-3 pr-0">
                            <small class="platform">{{ $wallet->platform }}</small>
                            <h4 class="card-title currency">{{ $wallet->currency }}</h4>
                        </div>
                        <div class="col-6 text-center">
                            <small>₦ / $</small>
                            <h4 class="card-title rate">{{ round($wallet->rate, 0) }}</h4>
                        </div>
                        <div class="col-3 text-right pl-0">
                            <img class="icon" src="{{ asset('img/currencies/' . $currencies[$wallet->currency]['icon']) }}" alt="" style="max-width:50px;height:auto;">
                        </div>
                    </div>
                    
                    <small>Wallet Address</small>
                    <div class="readonly input-items regular-icon-buttons mb-3">
                        <input class="address" readonly type="text" value="{{ $wallet->address }}">
                        <a href="" class="regular-icon-light-two">
                            <i class="lni-files lni-flipped font-weight-bolder copy" data-toggle="tooltip" title="Copy"></i>
                        </a>
                    </div>

                    <div class="row">
                        <div class="col-3">
                            <small>Note</small>
                            <a href="" class="show-note regular-icon-light-two d-block pt-05">
                                <i class="lni-write font-weight-bolder size-sm"></i>
                            </a>
                        </div>
                        <div class="col-6 text-center wallet-switch">
                            <small>Status</small>
                            <label class="switch mb-0 d-block mx-auto" data-id="{{ $wallet->id }}" data-name="{{ $wallet->platform . ' ' . $wallet->currency }}">
                                <input class="status" type="checkbox" {{ $wallet->status ? 'checked' : '' }}>
                                <span class="slider round"></span>
                            </label>
                        </div>
                        <div class="col-3 text-right">
                            <small>QR</small>
                            <a href="" class="show-qr regular-icon-light-two d-block pt-05">
                                <i class="lni-frame-expand font-weight-bolder size-sm"></i>
                            </a>
                        </div>
                    </div>
                        
                        
                    <div class="row"><div class="col-12 px-0"><hr></div></div>
                    
                    <div class="row">
                        <div class="col-6 light-rounded-buttons wallet-edit" 
                            data-id="{{ $wallet->id }}"
                            data-platform="{{ $wallet->platform }}"
                            data-currency="{{ $wallet->currency }}"
                            data-address="{{ $wallet->address }}"
                            data-rate="{{ $wallet->rate }}"
                            data-icon="{{ asset('img/currencies/' . $currencies[$wallet->currency]['icon']) }}"
                            data-note="{{ $wallet->note }}"
                            data-qr="{{ asset('img/wallets/' . $wallet->qrcode) }}">
                            <a href="#" class="main-btn light-rounded-two xs-btn text-none font-weight-normal w-100">
                                Edit
                            </a>
                        </div>
                        <div class="col-6 light-rounded-buttons danger-buttons wallet-delete" data-id="{{ $wallet->id }}" data-name="{{ $wallet->platform . ' ' . $wallet->currency }}">
                            <a href="#" class="main-btn danger-two xs-btn text-none font-weight-normal w-100">
                                Delete
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach


        <!-- Dummy Card Start -->
        <div class="col-sm-6 col-lg-4 col-xl-3 mt-4 dummy wallet-card">
            <div class="single-card card-style-one wallet form-style form-style-two has-overlay">
                <div class="card-image d-flex align-items-center qr">
                    <img class="p-3 img-fluid qrcode" src="" alt="Image">
                </div>
                <div class="form-input note d-flex align-items-center bg-transparent">
                    <div class="input-items active p-3">
                        <div class="display-text os-host-flexbox bg-transparent text-transparent text-center" style="max-height: 100% !important;">
                            Lorem ipsum dolor sit amet consectetur 
                            adipisicing elit. Enim quasi corrupti, 
                            aut voluptatem quae eligendi, laborum 
                            dicta, iure perspiciatis corporis vitae 
                            quaerat veniam incidunt fugit! Ipsam culpa 
                            facere libero iure molestiae, velit explicabo, 
                            ratione nobis, non qui ullam eaque. Minus qui 
                            veniam quis quisquam tempore distinctio 
                            explicabo. Ex, porro at?
                        </div>
                    </div>
                </div>
                <div class="card-content form-input">
                    <div class="row mb-2">
                        <div class="col-4">
                            <small class="platform"></small>
                            <h4 class="card-title currency"></h4>
                        </div>
                        <div class="col-4 text-center">
                            <small>₦ / $</small>
                            <h4 class="card-title rate"></h4>
                        </div>
                        <div class="col-4 text-right pl-0">
                            <img class="icon" src="" alt="" style="max-width:50px;height:auto;">
                        </div>
                    </div>
                    
                    <small>Wallet Address</small>
                    <div class="readonly input-items regular-icon-buttons mb-3">
                        <input class="address" readonly type="text" value="">
                        <a href="" class="regular-icon-light-two">
                            <i class="lni-files lni-flipped font-weight-bolder copy"></i>
                        </a>
                    </div>

                    <div class="row">
                        <div class="col-3">
                            <small>Note</small>
                            <a href="" class="show-note regular-icon-light-two d-block pt-05">
                                <i class="lni-write font-weight-bolder size-sm"></i>
                            </a>
                        </div>
                        <div class="col-6 text-center wallet-switch">
                            <small>Status</small>
                            <label class="switch mb-0 d-block mx-auto" data-id="" data-name="">
                                <input class="status" type="checkbox">
                                <span class="slider round"></span>
                            </label>
                        </div>
                        <div class="col-3 text-right">
                            <small>QR</small>
                            <a href="" class="show-qr regular-icon-light-two d-block pt-05">
                                <i class="lni-frame-expand font-weight-bolder size-sm"></i>
                            </a>
                        </div>
                    </div>
                        
                    <div class="row"><div class="col-12 px-0"><hr></div></div>
                    
                    <div class="row">
                        <div class="col-6 light-rounded-buttons wallet-edit" data-id="">
                            <a href="#" class="main-btn light-rounded-two xs-btn text-none font-weight-normal w-100">
                                Edit
                            </a>
                        </div>
                        <div class="col-6 light-rounded-buttons danger-buttons wallet-delete" data-id="" data-name="">
                            <a href="#" class="main-btn danger-two xs-btn text-none font-weight-normal w-100">
                                Delete
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Dummy Card End -->

    </div>
</div>