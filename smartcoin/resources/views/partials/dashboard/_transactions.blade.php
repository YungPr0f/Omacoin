@if(Auth::user()->role == 'admin')
<div class="single-portfolio border border-primary p-4">
    <div class="row">
        <div class="col-12">
            <div class="table-box">
                <div class="table-style table-responsive style-two txn_details">
                    <table class="table table striped">
                        <thead class="table-thead container">
                            <tr>
                                <!-- <th class="w-1">Txn ID</th> -->
                                <th>Transaction Details</th>
                                <th>Date Created</th>
                                <th>Last Updated</th>
                                <th class="w-1">Status</th>
                                <th class="w-1">Action</th>
                            </tr>
                        </thead>
                        <tbody class="table-tbody">
                            @php $i = 0; @endphp
                            @foreach($transactions as $transaction)
                            @php $i++; @endphp
                            <tr data-crypto-amount="{{ $transaction->crypto_amount }}" 
                                data-crypto-receipt="{{ asset('img/receipts/' . $transaction->crypto_receipt) }}" 
                                data-wallet-platform = "{{ $transaction->wallet_platform }}" 
                                data-wallet-currency = "{{ $transaction->wallet_currency }}"
                                data-currency-name="{{ $currencies[$transaction->wallet_currency]['name'] }}"
                                data-wallet-address="{{ $transaction->wallet_address }}"
                                
                                data-naira-equivalent="{{ amount($transaction->crypto_amount * $transaction->wallet_rate) }}"
                                data-bank-name="{{ $banks->find($transaction->bank_id)->name }}" 
                                data-account-number=""
                                >
                                <!-- <td class="text-mono">{{ $transaction->ref }}</td> -->
                                <td class="nowrap">
                                    <div class="txn_details accordion-style-one">
                                        <div class="accordion" id="accordion">
                                            <div class="card mt-0 bg-transparent">
                                                <div class="card-header" id="headingOne">
                                                    <a class="collapsed p-0 font-weight-normal nowrap" href="#collapse{{ $i }}" data-toggle="collapse" role="button" aria-expanded="true">
                                                        ${{ $transaction->crypto_amount }} - &#8358;{{ amount($transaction->crypto_amount * $transaction->wallet_rate) }}
                                                        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                                    </a>
                                                </div>

                                                <div id="collapse{{ $i }}" class="collapse" data-parent="#accordion">
                                                    <div class="card-body p-0">
                                                        <dl class="dl-horizontal mb-0 mt-2">
                                                            <dt>Txn ID</dt>
                                                            <i class="lni-arrow-right"></i>
                                                            <dd class="text-mono">#{{ $transaction->ref }}</dd>

                                                            <dd class="line-break"></dd>
                                                            <dt>Currency</dt>
                                                            <i class="lni-arrow-right"></i>
                                                            <dd>{{ $transaction->wallet_currency }}</dd>

                                                            <dd class="line-break"></dd>

                                                            <dt>Crypto Amount</dt>
                                                            <i class="lni-arrow-right"></i>
                                                            <dd>${{ $transaction->crypto_amount }}</dd>

                                                            <dd class="line-break"></dd>

                                                            <dt>Naira Equivalent</dt>
                                                            <i class="lni-arrow-right"></i>
                                                            <dd>&#8358;{{ amount($transaction->crypto_amount * $transaction->wallet_rate) }}</dd>
                                                        </dl>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="nowrap">
                                    <span>{{ date('M d, Y g:iA', strtotime($transaction->created_at)) }}</span>
                                </td>
                                <td class="nowrap">
                                    @if($transaction->created_at == $transaction->updated_at)
                                    <span>---</span>
                                    @else
                                    <span>{{ timeago($transaction->updated_at) }}</span>
                                    @endif
                                </td>
                                @if($transaction->stage == 'crypto_sent')
                                <td class="nowrap">
                                    <span>Receipt Uploaded</span>
                                </td>
                                <td>
                                    <div class="light-rounded-buttons info-buttons">
                                        <a href="#" data-id="{{ $transaction->id }}" data-action="review_receipt" class="txn-btn main-btn info-two xs-btn text-none font-weight-normal w-100 d-flex align-items-center justify-content-center">
                                            <i class="lni-search mr-2"></i>    
                                            Review Receipt
                                        </a>
                                    </div>
                                </td>
                                @elseif($transaction->stage == 'crypto_received')
                                <td class="nowrap">
                                    <span>Crypto Confirmed</span>
                                </td>
                                <td>
                                    <div class="light-rounded-buttons">
                                        <a href="#" data-id="{{ $transaction->id }}" data-action="process_payment" class="txn-btn main-btn light-rounded-two xs-btn text-none font-weight-normal w-100 d-flex align-items-center justify-content-center">
                                            <i class="lni-credit-cards d-inline-block mr-2"></i>
                                            Process Payment
                                        </a>
                                    </div>
                                </td>
                                @elseif($transaction->stage == 'naira_sent')
                                <td class="nowrap">
                                    <span>Verifying Payment</span>
                                </td>
                                <td>
                                    <div class="light-rounded-buttons light-rounded-buttons">
                                        <a href="#" data-toggle="modal" data-target="#cryptoWaitModal" class="main-btn light-rounded-two xs-btn text-none font-weight-normal w-100 d-flex align-items-center justify-content-center">
                                            <i class="lni-spinner lni-spin-effect mr-2"></i>
                                            @php
                                                $updated = strtotime($transaction->updated_at);
                                                $expired = strtotime('+6 hours', $updated);
                                                $time_left = $expired - time();
                                            @endphp
                                            Please wait ...&nbsp;<span class="countdown-timer" data-hh="" data-mm="" data-ss="{{ $time_left }}">00:00</span>
                                        </a>
                                    </div>

                                    <div class="light-rounded-buttons warning-buttons hidden">
                                        <a href="#" data-toggle="modal" data-target="#contactSupportModal" class="main-btn warning-two xs-btn text-none font-weight-normal w-100 d-flex align-items-center justify-content-center">
                                            <i class="lni-envelope d-inline-block mr-2"></i>
                                            Send Reminder
                                        </a>
                                    </div>
                                </td>
                                @elseif($transaction->stage == 'naira_received')
                                <td class="nowrap">
                                    <span>Exchange Complete</span>
                                </td>
                                <td class="text-center">
                                    <span>---</span>
                                </td>
                                @endif
                            </tr>
                            @endforeach
                            <tr></tr>

                            <!-- <tr>
                                <td>AE04BC01</td>
                                <td class="nowrap">
                                    <div class="txn_details accordion-style-one">
                                        <div class="accordion" id="accordion">
                                            <div class="card mt-0 bg-transparent">
                                                <div class="card-header" id="headingOne">
                                                    <a class="collapsed p-0 font-weight-normal nowrap" href="#collapseOne" data-toggle="collapse" role="button" aria-expanded="true">
                                                        $ 40.00 - &#8358; 16,000.00
                                                        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                                    </a>
                                                </div>

                                                <div id="collapseOne" class="collapse" data-parent="#accordion">
                                                    <div class="card-body p-0">
                                                        <dl class="dl-horizontal mb-0 mt-2">
                                                            <dt>Wallet</dt>
                                                            <i class="lni-arrow-right"></i>
                                                            <dd>BTC</dd>

                                                            <dd class="line-break"></dd>

                                                            <dt>Cryptocurrency</dt>
                                                            <i class="lni-arrow-right"></i>
                                                            <dd>$ 10.00</dd>

                                                            <dd class="line-break"></dd>

                                                            <dt>Naira Equivalent</dt>
                                                            <i class="lni-arrow-right"></i>
                                                            <dd>N 4,000</dd>
                                                        </dl>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="nowrap">
                                    <span>May 05, 2021 06:15PM</span>
                                </td>
                                <td class="nowrap">
                                    <span>Awaiting Receipt</span>
                                </td>
                                <td>
                                    <div class="light-rounded-buttons light-rounded-buttons">
                                        <a href="#" class="main-btn light-rounded-two xs-btn text-none font-weight-normal w-100 d-flex align-items-center justify-content-center">
                                            <i class="lni-spinner lni-spin-effect mr-2"></i>    
                                            Please wait ... <span class="countdown-timer" data-mm="" data-ss="10">00:00</span>
                                        </a>
                                    </div>

                                    <div class="light-rounded-buttons danger-buttons hidden">
                                        <a href="#" class="main-btn danger-two xs-btn text-none font-weight-normal w-100 d-flex align-items-center justify-content-center">
                                            <i class="lni-cross-circle d-inline-block mr-2"></i>
                                            Cancel Request
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>AE04BC02</td>
                                <td class="nowrap">
                                    <div class="txn_details accordion-style-one">
                                        <div class="accordion" id="accordion">
                                            <div class="card mt-0 bg-transparent">
                                                <div class="card-header" id="headingOne">
                                                    <a class="collapsed p-0 font-weight-normal nowrap" href="#collapseTwo" data-toggle="collapse" role="button" aria-expanded="true">
                                                        $ 40.00 - &#8358; 16,000.00
                                                        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                                    </a>
                                                </div>

                                                <div id="collapseTwo" class="collapse" data-parent="#accordion">
                                                    <div class="card-body p-0">
                                                        <dl class="dl-horizontal mb-0 mt-2">
                                                            <dt>Wallet</dt>
                                                            <i class="lni-arrow-right"></i>
                                                            <dd>BTC</dd>

                                                            <dd class="line-break"></dd>

                                                            <dt>Cryptocurrency</dt>
                                                            <i class="lni-arrow-right"></i>
                                                            <dd>$ 10.00</dd>

                                                            <dd class="line-break"></dd>

                                                            <dt>Naira Equivalent</dt>
                                                            <i class="lni-arrow-right"></i>
                                                            <dd>N 4,000</dd>
                                                        </dl>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span>May 05, 2021 06:15PM</span>
                                </td>
                                <td class="nowrap">
                                    <span>Receipt Uploaded</span>
                                </td>
                                <td>
                                    <div class="light-rounded-buttons info-buttons">
                                        <a href="#" class="main-btn info-two xs-btn text-none font-weight-normal w-100 d-flex align-items-center justify-content-center">
                                            <i class="lni-search mr-2"></i>    
                                            Review Receipt
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>AE04BC03</td>
                                <td class="nowrap">
                                    <div class="txn_details accordion-style-one">
                                        <div class="accordion" id="accordion">
                                            <div class="card mt-0 bg-transparent">
                                                <div class="card-header" id="headingOne">
                                                    <a class="collapsed p-0 font-weight-normal nowrap" href="#collapseTwo" data-toggle="collapse" role="button" aria-expanded="true">
                                                        $ 40.00 - &#8358; 16,000.00
                                                        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                                    </a>
                                                </div>
                                                <div id="collapseTwo" class="collapse" data-parent="#accordion">
                                                    <div class="card-body p-0">
                                                        <dl class="dl-horizontal mb-0 mt-2">
                                                            <dt>Wallet</dt>
                                                            <i class="lni-arrow-right"></i>
                                                            <dd>BTC</dd>

                                                            <dd class="line-break"></dd>

                                                            <dt>Cryptocurrency</dt>
                                                            <i class="lni-arrow-right"></i>
                                                            <dd>$ 10.00</dd>

                                                            <dd class="line-break"></dd>

                                                            <dt>Naira Equivalent</dt>
                                                            <i class="lni-arrow-right"></i>
                                                            <dd>N 4,000</dd>
                                                        </dl>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span>May 05, 2021 06:15PM</span>
                                </td>
                                <td class="nowrap">
                                    <span>Processing Payment</span>
                                </td>
                                <td>
                                    <div class="light-rounded-buttons">
                                        <a href="#" class="main-btn light-rounded-two xs-btn text-none font-weight-normal w-100 d-flex align-items-center justify-content-center">
                                            <i class="lni-credit-cards d-inline-block mr-2"></i>
                                            Process Payment
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>AE04BC04</td>
                                <td class="nowrap">
                                    <div class="txn_details accordion-style-one">
                                        <div class="accordion" id="accordion">
                                            <div class="card mt-0 bg-transparent">
                                                <div class="card-header" id="headingOne">
                                                    <a class="collapsed p-0 font-weight-normal nowrap" href="#collapseTwo" data-toggle="collapse" role="button" aria-expanded="true">
                                                        $ 40.00 - &#8358; 16,000.00
                                                        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                                    </a>
                                                </div>

                                                <div id="collapseTwo" class="collapse" data-parent="#accordion">
                                                    <div class="card-body p-0">
                                                        <dl class="dl-horizontal mb-0 mt-2">
                                                            <dt>Wallet</dt>
                                                            <i class="lni-arrow-right"></i>
                                                            <dd>BTC</dd>

                                                            <dd class="line-break"></dd>

                                                            <dt>Cryptocurrency</dt>
                                                            <i class="lni-arrow-right"></i>
                                                            <dd>$ 10.00</dd>

                                                            <dd class="line-break"></dd>

                                                            <dt>Naira Equivalent</dt>
                                                            <i class="lni-arrow-right"></i>
                                                            <dd>N 4,000</dd>
                                                        </dl>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span>May 05, 2021 06:15PM</span>
                                </td>
                                <td class="nowrap">
                                    <span>Awaiting Payment</span>
                                </td>
                                <td>
                                    <div class="light-rounded-buttons success-buttons">
                                        <a href="#" class="main-btn success-two xs-btn text-none font-weight-normal w-100 d-flex align-items-center justify-content-center">
                                            <i class="lni-check-mark-circle mr-2"></i>
                                            Confirm Payment
                                        </a>
                                    </div>
                                </td>
                            </tr> -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

@if(Auth::user()->role == 'member')
<div class="single-portfolio border border-primary p-4">
    <div class="row">
        <div class="col-12">
            <div class="table-box">
                <div class="table-style table-responsive style-two txn_details">
                    <table class="table table striped">
                        <thead class="table-thead container">
                            <tr>
                                <!-- <th class="w-1">Txn ID</th> -->
                                <th>Transaction Details</th>
                                <th>Date Created</th>
                                <th>Last Updated</th>
                                <th class="w-1">Status</th>
                                <th class="w-1">Action</th>
                            </tr>
                        </thead>
                        <tbody class="table-tbody">
                            @php $i = 0; @endphp
                            @foreach($usertransactions as $usertransaction)
                            @php $i++; @endphp
                            <tr>
                                <!-- <td class="text-mono">{{ $usertransaction->ref }}</td> -->
                                <td class="nowrap">
                                    <div class="txn_details accordion-style-one">
                                        <div class="accordion" id="accordion">
                                            <div class="card mt-0 bg-transparent">
                                                <div class="card-header" id="headingOne">
                                                    <a class="collapsed p-0 font-weight-normal nowrap" href="#collapse{{ $i }}" data-toggle="collapse" role="button" aria-expanded="true">
                                                        ${{ $usertransaction->crypto_amount }} - &#8358;{{ amount($usertransaction->crypto_amount * $usertransaction->wallet_rate) }}
                                                        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                                    </a>
                                                </div>

                                                <div id="collapse{{ $i }}" class="collapse" data-parent="#accordion">
                                                    <div class="card-body p-0">
                                                        <dl class="dl-horizontal mb-0 mt-2">
                                                            <dt>Txn ID</dt>
                                                            <i class="lni-arrow-right"></i>
                                                            <dd class="text-mono">#{{ $usertransaction->ref }}</dd>

                                                            <dd class="line-break"></dd>

                                                            <dt>Currency</dt>
                                                            <i class="lni-arrow-right"></i>
                                                            <dd>{{ $usertransaction->wallet_currency }}</dd>

                                                            <dd class="line-break"></dd>

                                                            <dt>Amount Sent</dt>
                                                            <i class="lni-arrow-right"></i>
                                                            <dd>${{ $usertransaction->crypto_amount }}</dd>

                                                            <dd class="line-break"></dd>

                                                            <dt>Naira Equivalent</dt>
                                                            <i class="lni-arrow-right"></i>
                                                            <dd>&#8358;{{ amount($usertransaction->crypto_amount * $usertransaction->wallet_rate) }}</dd>
                                                        </dl>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="nowrap">
                                    <span>{{ date('M d, Y g:iA', strtotime($usertransaction->created_at)) }}</span>
                                </td>
                                <td class="nowrap">
                                    @if($usertransaction->created_at == $usertransaction->updated_at)
                                    <span>---</span>
                                    @else
                                    <span>{{ timeago($usertransaction->updated_at) }}</span>
                                    @endif
                                </td>
                                @if($usertransaction->stage == 'crypto_sent')
                                <td class="nowrap">
                                    <span>Verifying Cryptoccy.</span>
                                </td>
                                <td>
                                    <div class="light-rounded-buttons light-rounded-buttons">
                                        <a href="#" data-toggle="modal" data-target="#cryptoWaitModal" class="main-btn light-rounded-two xs-btn text-none font-weight-normal w-100 d-flex align-items-center justify-content-center">
                                            <i class="lni-spinner lni-spin-effect mr-2"></i>
                                            @php
                                                $created = strtotime($usertransaction->created_at);
                                                $expired = strtotime('+12 hours', $created);
                                                $time_left = $expired - time();
                                            @endphp
                                            Please wait ...&nbsp;<span class="countdown-timer" data-hh="" data-mm="" data-ss="{{ $time_left }}">00:00</span>
                                        </a>
                                    </div>

                                    <div class="light-rounded-buttons warning-buttons hidden">
                                        <a href="#" data-toggle="modal" data-target="#contactSupportModal" class="main-btn warning-two xs-btn text-none font-weight-normal w-100 d-flex align-items-center justify-content-center">
                                            <i class="lni-support d-inline-block mr-2"></i>
                                            Contact Support
                                        </a>
                                    </div>
                                </td>
                                @elseif($usertransaction->stage == 'crypto_received')
                                <td class="nowrap">
                                    <span>Processing Payment</span>
                                </td>
                                <td>
                                    <div class="light-rounded-buttons light-rounded-buttons">
                                        <a href="#" data-toggle="modal" data-target="#nairaWaitModal{{ $usertransaction->id }}" class="main-btn light-rounded-two xs-btn text-none font-weight-normal w-100 d-flex align-items-center justify-content-center">
                                            <i class="lni-spinner lni-spin-effect mr-2"></i>
                                            @php
                                                $updated = strtotime($usertransaction->updated_at);
                                                $expired = strtotime('+1 hour', $updated);
                                                $time_left = $expired - time();
                                            @endphp
                                            Please wait ...&nbsp;<span class="countdown-timer" data-hh="" data-mm="" data-ss="{{ $time_left }}">00:00</span>
                                        </a>
                                    </div>

                                    <!-- Please Wait Modal - Processing Payment -->
                                    <div class="modal fade" id="nairaWaitModal{{ $usertransaction->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Processing Payment</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    We have received <strong>${{ $usertransaction->crypto_amount }} {{ $usertransaction->wallet_currency }}</strong> and will send the naira equivalent into your account shortly ...
                                                </div>
                                                <div class="modal-footer">
                                                    <!-- <button type="button" class="btn btn-danger">Cancel Transaction</button> -->
                                                    <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Okay</button> -->
                                                    <button type="button" class="btn btn-primary" data-dismiss="modal">Okay</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="light-rounded-buttons warning-buttons hidden">
                                        <a href="#" data-toggle="modal" data-target="#contactSupportModal" class="main-btn warning-two xs-btn text-none font-weight-normal w-100 d-flex align-items-center justify-content-center">
                                            <i class="lni-support d-inline-block mr-2"></i>
                                            Contact Support
                                        </a>
                                    </div>
                                </td>
                                @elseif($usertransaction->stage == 'naira_sent')
                                <td class="nowrap">
                                    <span>Payment Completed</span>
                                </td>
                                <td>
                                    <div class="light-rounded-buttons success-buttons">
                                        <a href="#" data-toggle="modal" data-target="#nairaReceivedModal{{ $usertransaction->id }}" class="main-btn success-two xs-btn text-none font-weight-normal w-100 d-flex align-items-center justify-content-center">
                                            <i class="lni-check-mark-circle mr-2"></i>
                                            Confirm Received
                                        </a>
                                    </div>

                                    <!-- Naira Received Modal - Payment Completed -->
                                    <div class="modal fade nairaReceivedModal" id="nairaReceivedModal{{ $usertransaction->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Payment Completed</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    We have sent <strong>&#8358; {{ amount($usertransaction->crypto_amount * $usertransaction->wallet_rate) }}</strong> into your account. Please confirm you have received it below
                                                    <div class="sign-in-form-area wow fadeIn text-left" data-wow-duration="1s" data-wow-delay="0.4s">
                                                        <div class="sign-in-form-wrapper form-style-two no-icon">
                                                            <div class="form-input mt-4">
                                                                <label class="d-flex justify-content-between">
                                                                    <span class="d-flex align-items-end">Receipt</span>
                                                                    <div class="light-rounded-buttons receipt-button" data-status="show">
                                                                        <a href="#" class="main-btn light-rounded-two xs-btn text-none font-weight-normal d-flex align-items-center">
                                                                            <i class="lni-frame-expand d-inline-block mr-2"></i>
                                                                            <span>Show</span>
                                                                        </a>
                                                                    </div>
                                                                </label>
                                                                <div class="input-items default receipt-preview hidden" data-value="">
                                                                    <img src="{{ asset('img/receipts/' . $usertransaction->naira_receipt) }}" alt="" class="img-fluid w-100 field-border">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer d-flex justify-content-between">
                                                    <!-- <button type="button" class="btn btn-danger">Cancel Transaction</button> -->
                                                    @if((strtotime('+6 hours', strtotime($usertransaction->updated_at)) - time()) < 0)
                                                    <button type="button" class="btn btn-warning text-white" data-dismiss="modal">Contact Support</button>
                                                    @else
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No, I haven't</button>
                                                    @endif
                                                    <button type="button" class="btn btn-primary" data-dismiss="modal">Yes, Received</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                @elseif($usertransaction->stage == 'naira_received')
                                <td class="nowrap">
                                    <span>Exchange Complete</span>
                                </td>
                                <td class="text-center">
                                    <span>---</span>
                                </td>
                                @endif
                            </tr>
                            @endforeach
                            <!-- <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>AE04BC01</td>
                                <td class="nowrap">
                                    <div class="txn_details accordion-style-one">
                                        <div class="accordion" id="accordion">
                                            <div class="card mt-0 bg-transparent">
                                                <div class="card-header" id="headingOne">
                                                    <a class="collapsed p-0 font-weight-normal nowrap" href="#collapseOne" data-toggle="collapse" role="button" aria-expanded="true">
                                                        $ 40.00 - &#8358; 16,000.00
                                                        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                                    </a>
                                                </div>

                                                <div id="collapseOne" class="collapse" data-parent="#accordion">
                                                    <div class="card-body p-0">
                                                        <dl class="dl-horizontal mb-0 mt-2">
                                                            <dt>Wallet</dt>
                                                            <i class="lni-arrow-right"></i>
                                                            <dd>BTC</dd>

                                                            <dd class="line-break"></dd>

                                                            <dt>Cryptocurrency</dt>
                                                            <i class="lni-arrow-right"></i>
                                                            <dd>$ 10.00</dd>

                                                            <dd class="line-break"></dd>

                                                            <dt>Naira Equivalent</dt>
                                                            <i class="lni-arrow-right"></i>
                                                            <dd>N 4,000</dd>
                                                        </dl>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="nowrap">
                                    <span>May 05, 2021 06:15PM</span>
                                </td>
                                <td class="nowrap">
                                    <span>6 Years Ago</span>
                                </td>
                                <td class="nowrap">
                                    <span>Awaiting Receipt</span>
                                </td>
                                <td>
                                    <div class="light-rounded-buttons info-buttons">
                                        <a href="#" class="main-btn info-two xs-btn text-none font-weight-normal w-100 d-flex align-items-center justify-content-center">
                                            <i class="lni-upload d-inline-block mr-2"></i>
                                            Upload Receipt
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>AE04BC02</td>
                                <td class="nowrap">
                                    <div class="txn_details accordion-style-one">
                                        <div class="accordion" id="accordion">
                                            <div class="card mt-0 bg-transparent">
                                                <div class="card-header" id="headingOne">
                                                    <a class="collapsed p-0 font-weight-normal nowrap" href="#collapseTwo" data-toggle="collapse" role="button" aria-expanded="true">
                                                        $ 40.00 - &#8358; 16,000.00
                                                        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                                    </a>
                                                </div>

                                                <div id="collapseTwo" class="collapse" data-parent="#accordion">
                                                    <div class="card-body p-0">
                                                        <dl class="dl-horizontal mb-0 mt-2">
                                                            <dt>Wallet</dt>
                                                            <i class="lni-arrow-right"></i>
                                                            <dd>BTC</dd>

                                                            <dd class="line-break"></dd>

                                                            <dt>Cryptocurrency</dt>
                                                            <i class="lni-arrow-right"></i>
                                                            <dd>$ 10.00</dd>

                                                            <dd class="line-break"></dd>

                                                            <dt>Naira Equivalent</dt>
                                                            <i class="lni-arrow-right"></i>
                                                            <dd>N 4,000</dd>
                                                        </dl>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span>May 05, 2021 06:15PM</span>
                                </td>
                                <td class="nowrap">
                                    <span>6 Years Ago</span>
                                </td>
                                <td class="nowrap">
                                    <span>Verifying Receipt</span>
                                </td>
                                <td>
                                    <div class="light-rounded-buttons light-rounded-buttons">
                                        <a href="#" class="main-btn light-rounded-two xs-btn text-none font-weight-normal w-100 d-flex align-items-center justify-content-center">
                                            <i class="lni-check-box mr-2" Preferred Bank></i>    
                                            Select Bank Info
                                        </a>
                                    </div>
                                </td>
                            </tr> -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modals -->

<!-- Please Wait Modal - Verifying Crypto -->
<div class="modal fade" id="cryptoWaitModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Verifying Crypto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                We are currently verifying your crypto receipt. This shouldn't take long ...
            </div>
            <div class="modal-footer">
                <!-- <button type="button" class="btn btn-danger">Cancel Transaction</button> -->
                <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Okay</button> -->
                <button type="button" class="btn btn-primary" data-dismiss="modal">Okay</button>
            </div>
        </div>
    </div>
</div>


<!-- Contact Support Modal -->
<div class="modal fade" id="contactSupportModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Contact Support</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Reach out to us on <a class="whatsapp-chat" href="whatsapp" >WhatsApp</a>
            </div>
            <div class="modal-footer d-flex justify-content-between">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <a class="whatsapp-chat text-success" href="whatsapp" ><i class="size-md lni-whatsapp"></i></a>
            </div>
        </div>
    </div>
</div>



@endif


