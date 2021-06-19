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
        <!--  -->

        <div class="col-sm-6 col-lg-4 col-xl-3 mt-4 dummy wallet-card hidden">
            <div class="single-card card-style-one form-style form-style-two">
                <div class="card-image">
                    <img class="p-3 qrcode" src="xxx" alt="Image">
                </div>
                <div class="card-content form-input pt-0">
                    <div class="row mb-2">
                        <div class="col-4">
                            <small class="platform">xxx</small>
                            <h4 class="card-title currency">xxx</h4>
                        </div>
                        <div class="col-4 text-center">
                            <small>$ => ₦</small>
                            <h4 class="card-title rate">xxx</h4>
                        </div>
                        <div class="col-4 text-right pl-0">
                            <img class="icon" src="xxx" alt="" style="max-width:50px;height:auto;">
                        </div>
                    </div>
                    
                    <small>Wallet Address</small>
                    <div class="input-items regular-icon-buttons">
                        <input class="address" readonly type="text" value="xxx">
                        <span>
                            <a href="" class="regular-icon-light-two copy"><i class="lni-files lni-flipped font-weight-bolder"></i></a>
                        </span>
                    </div>
                    <div class="row">
                        <div class="col-6 light-rounded-buttons wallet-edit" data-id="xxx">
                            <a href="#" class="main-btn light-rounded-two xs-btn text-none font-weight-normal w-100">
                                Edit
                            </a>
                        </div>
                        <div class="col-6 light-rounded-buttons danger-buttons wallet-delete" data-id="xxx" data-name="xxx">
                            <a href="#" class="main-btn danger-two xs-btn text-none font-weight-normal w-100">
                                Delete
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--  -->
        @foreach($wallets as $wallet)
        <div class="col-sm-6 col-lg-4 col-xl-3 mt-4 wallet-card">
            <div class="single-card card-style-one wallet form-style form-style-two">
                <div class="card-image">
                    <img class="p-3" src="{{ asset('img/wallets/' . $wallet->qrcode) }}" alt="Image">
                </div>
                <div class="card-content form-input pt-0">
                    <div class="row mb-2">
                        <div class="col-4">
                            <small>{{ $wallet->platform }}</small>
                            <h4 class="card-title">{{ $wallet->currency }}</h4>
                        </div>
                        <div class="col-4 text-center">
                            <small>$ => ₦</small>
                            <h4 class="card-title">{{ $wallet->rate }}</h4>
                        </div>
                        <div class="col-4 text-right pl-0">
                            <img src="{{ asset('img/currencies/' . $currencies[$wallet->currency]['icon']) }}" alt="" style="max-width:50px;height:auto;">
                        </div>
                    </div>
                    
                    <small>Wallet Address</small>
                    <div class="input-items regular-icon-buttons">
                        <input readonly type="text" value="{{ $wallet->address }}">
                        <span>
                            <a href="" class="regular-icon-light-two copy"><i class="lni-files lni-flipped font-weight-bolder"></i></a>
                        </span>
                    </div>
                    <div class="row">
                        <div class="col-6 light-rounded-buttons wallet-edit" data-id="{{ $wallet->id }}">
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
        <!-- <div class="col-sm-6 col-lg-4 col-xl-3 mt-4">
            <div class="single-card card-style-one wallet form-style form-style-two">
                <div class="card-image">
                    <img class="p-3" src="{{ asset('img/ui/qrcode.png') }}" alt="Image">
                </div>
                <div class="card-content form-input pt-0">
                    <div class="row mb-2">
                        <div class="col-4">
                            <small>Binance</small>
                            <h4 class="card-title">USDT</h4>
                        </div>
                        <div class="col-4 text-center">
                            <small>$ => ₦</small>
                            <h4 class="card-title">480</h4>
                        </div>
                        <div class="col-4 text-right pl-0">
                            <img src="{{ asset('img/ui/usdt.png') }}" alt="" style="max-width:50px;height:auto;">
                        </div>
                    </div>
                    <small>Wallet Address</small>
                    <div class="input-items regular-icon-buttons">
                        <input readonly type="text" name="email" placeholder="Email" value="3LfV7Zna8gG6SGUrWLaGkLHjpVcbiX7rnW">
                        <span>
                            <a href="" class="regular-icon-light-two copy"><i class="lni-files lni-flipped font-weight-bolder"></i></a>
                        </span>
                    </div>
                    <div class="row">
                        <div class="col-6 light-rounded-buttons">
                            <a href="#" class="main-btn light-rounded-two xs-btn text-none font-weight-normal w-100">
                                Edit
                            </a>
                        </div>
                        <div class="col-6 light-rounded-buttons danger-buttons">
                            <a href="#" class="main-btn danger-two xs-btn text-none font-weight-normal w-100">
                                Delete
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
    </div>
</div>