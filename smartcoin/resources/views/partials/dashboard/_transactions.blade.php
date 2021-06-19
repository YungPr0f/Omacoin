@if(Auth::user()->role == 'admin')
<div class="single-portfolio border border-primary p-4">
    <div class="row">
        <div class="col-12">
            <div class="table-box">
                <div class="table-style table-responsive style-two txn_details">
                    <table class="table table striped">
                        <thead class="table-thead container">
                            <tr>
                                <th>Txn ID</th>
                                <th class="w-1">Transaction Details</th>
                                <th>Date</th>
                                <th class="w-1">Status</th>
                                <th class="w-1">Action</th>
                            </tr>
                        </thead>
                        <tbody class="table-tbody">
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
                            </tr>
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
                                <th>Txn ID</th>
                                <th class="w-1">Transaction Details</th>
                                <th>Date</th>
                                <th class="w-1">Status</th>
                                <th class="w-1">Action</th>
                            </tr>
                        </thead>
                        <tbody class="table-tbody">
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
                                    <div class="light-rounded-buttons light-rounded-buttons">
                                        <a href="#" class="main-btn light-rounded-two xs-btn text-none font-weight-normal w-100 d-flex align-items-center justify-content-center">
                                            <i class="lni-spinner lni-spin-effect mr-2"></i>    
                                            Please wait ... <span class="countdown-timer" data-mm="" data-ss="10">00:00</span>
                                        </a>
                                    </div>

                                    <div class="light-rounded-buttons warning-buttons hidden">
                                        <a href="#" class="main-btn warning-two xs-btn text-none font-weight-normal w-100 d-flex align-items-center justify-content-center">
                                            <i class="lni-support d-inline-block mr-2"></i>
                                            Contact Support
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
                                    <span>Payment Completed</span>
                                </td>
                                <td>
                                    <div class="light-rounded-buttons success-buttons">
                                        <a href="#" class="main-btn success-two xs-btn text-none font-weight-normal w-100 d-flex align-items-center justify-content-center">
                                            <i class="lni-check-mark-circle mr-2"></i>
                                            Confirm Received
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endif