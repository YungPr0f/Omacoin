@extends('layouts.master')

@section('extra_links')
    <link rel="stylesheet" href="{{ asset('css/material-kit.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animate.min.css') }}">
@endsection

@section('title', 'SmartCoin | ' . (Auth::user()->role == 'admin' ? 'Admin Panel' : 'My Dashboard') )

@section('content')

    <section class="portfolio-area portfolio-three pb-100 pt-50 mt-100" style="height:1000px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="portfolio-menu-3 text-center">
                        <ul class="nav nav-justified">
                            <li data-filter=".profile" class="nav-item">PROFILE</li>
                            <li data-filter=".transactions" class="nav-item">TRANSACTIONS</li>
                            @if(Auth::user()->role == 'admin')
                            <li data-filter=".wallets" class="nav-item">WALLETS</li>
                            <li data-filter=".users" class="nav-item">USERS</li>
                            @endif
                            <li data-filter=".reviews" class="nav-item">REVIEWS</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row grid-3">
                <div class="col-12 profile d-none">
                    @include('partials.dashboard._profile')
                </div>
                <div class="col-12 transactions d-none">
                    @include('partials.dashboard._transactions')
                </div>
                @if(Auth::user()->role == 'admin')
                <div class="col-12 wallets d-none">
                    @include('partials.dashboard._wallets')
                </div>
                <div class="col-12 users d-none">
                    @include('partials.dashboard._users')
                </div>
                @endif
                <div class="col-12 reviews d-none">
                    <div class="single-portfolio border border-primary p-4">
                        REVIEWS
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('extra_scripts')

    <script src="{{asset('js/image/core/bootstrap-material-design.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/image/plugins/jasny-bootstrap.min.js')}}"></script>
    <script src="{{asset('js/image/material-kit.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/wallet-address-validator.min.js')}}" type="text/javascript"></script>

@endsection


@section('custom_script')

    // Display previously active tab or first tab
    function tabHistory() {

        // Save currently active Tab
        $('li[data-filter]').click(function() {
            localStorage.setItem('activeTab', $(this).attr('data-filter'));
        });

        var activeTab = localStorage.getItem('activeTab');

        var firstTab = $('.portfolio-menu-3').find('li').first().attr('data-filter');

        // Display previously active tab if saved
        if($('[data-filter="'+ activeTab +'"]').length && activeTab) {
            var dataFilter = activeTab;

        } else { // Else display first tab
            var dataFilter = firstTab;

        }

        $('.grid-3').isotope({
            filter: dataFilter
        }).children().removeClass('d-none');

        $('.grid-3 [data-toggle="collapse"]').click(function () {
            var id = $(this).attr('href');

            $(id).on('shown.bs.collapse hidden.bs.collapse', function() {
                $('.grid-3').isotope('layout');
                
            });
        });

        $('[data-filter="'+ dataFilter +'"]').addClass('active').siblings().removeClass('active');

    }
    tabHistory();

    // Remove Portfolio Area Fixed Height
    $('.grid-3').isotope('on', 'layoutComplete', function() {
        $('.portfolio-area').removeAttr('style');

    });
    
    // Adjust Accordion to fit Bank Name Dropdown
    $(document).on('click.nice-select', '.nice-select.bank', function() {

        //Adjust Accordion Height
        function adjustHeight() {

            var list = $('.nice-select.bank');
            var container = list.parents('.collapse');
            var card = container.children('.card-body');

            var listBottom = list.offset().top + list.height();
            var containerBottom = container.offset().top + container.height();
            var cardBottom = card.offset().top + card.height();

            if(list.hasClass('open')) {

                var diff = containerBottom - cardBottom;
                
                if(diff > 30) {
                    container.animate({
                        height: container.height() - (diff - 32)

                    }, 100, function() {
                        $('.grid-3').isotope('layout');

                    });
                }

            } else {

                var diff = containerBottom - listBottom;

                if(diff < 240) {
                    container.animate({
                        height: container.height() + (240 - diff)

                    }, 100, function() {
                        $('.grid-3').isotope('layout');

                    });
                    
                }
            } 
        }

        adjustHeight();
        

    });

    // Update Profile Photo
    $('ul.save').click(function() {

        var field = $(this).parents('.form-group');
        var val = field.attr('data-value');

        $(this).find('button').addClass('disabled').attr('type', 'disabled').removeClass('hoverable');

        field.find('ul.cancel').hide();
        field.find('span.change').removeClass('d-flex').hide();

        $(this).after(`
            <ul class="loading">
                <li class="mt-0 light-rounded-buttons ml-2">
                    <span class="regular-icon-light-ten d-flex align-items-center light-rounded-two hoverable">
                        <i class="lni-spinner lni-spin-effect size-xs font-weight-bold mx-auto"></i>
                    </span>
                </li>
            </ul>
        `);

        field.find('form').submit(function(e) {
            e.preventDefault();

            $.ajax({
                url: "{{ route('profile.update') }}",
                method: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success:function(result) { // On Ajax Success

                    if($.isEmptyObject(result.error)) { // If the error container is empty [i.e. success]

                        // Success Alert Message
                        toastr.success(result.success);

                        // Remove loading animation
                        field.find('ul.loading').remove();

                        // Show Edit Button
                        field.find('span.change').addClass('d-flex').show();

                        // Re-enable Save Button
                        field.find('ul.save').find('button').removeClass('disabled').attr('type', 'button').addClass('hoverable');

                        // Update New Value
                        var newVal = result.data;
                        field.find('.thumbnail img').attr('src', newVal);
                        field.attr('data-value', newVal);

                        // Show Cancel Button and New Image
                        field.find('ul.cancel').show();
                        field.find('[data-dismiss="fileinput"]').click();


                    } else { // If error container not empty [i.e error] 
                        
                        // Errors List
                        var errors = result.error;
                        var errorList = [];
                        errors.forEach(function(item) {
                            errorList.push('<li>'+ item + '</li>');
                        });

                        // Error Alert Message
                        toastr.error('<ul>' + errorList.join('') + '</ul>', 'Please check your input');

                        // Remove loading animation
                        field.find('ul.loading').remove();
                        
                        // Show Edit Button
                        field.find('span.change').addClass('d-flex').show();

                        // Re-enable Save Button
                        field.find('ul.save').find('button').removeClass('disabled').attr('type', 'button').addClass('hoverable');

                        // Show Cancel Button and New Image
                        field.find('ul.cancel').show();
                        field.find('[data-dismiss="fileinput"]').click();

                    }
                },
                error: function(xhr, status, error){ // On Ajax Error

                    // Error Alert Message
                    toastr.error(xhr.statusText, 'Error - ' + xhr.status);

                    // Remove loading animation
                    field.find('ul.loading').remove();
                    
                    // Show Edit Button
                    field.find('span.change').addClass('d-flex').show();

                    // Re-enable Save Button
                    field.find('ul.save').find('button').removeClass('disabled').attr('type', 'button').addClass('hoverable');

                    // Show Cancel Button and New Image
                    field.find('ul.cancel').show();
                    field.find('[data-dismiss="fileinput"]').click();
                }

            }).fail(function() { toastr.error('Something went wrong') }); // On Ajax Fail


            $(this).unbind('submit');

        });

    });

    // Update Fields
    $('.edit').on('click', function(e) {
        e.preventDefault();

        // Hide Edit Button ... Show Save and Cancel
        $(this).addClass('hidden').siblings().removeClass('hidden');

        // Target Current Form-Input Field
        var field = $(this).parents('.form-input');

        // Save Initial Value
        var val = field.attr('data-value');

        // Make Field Editable
        field.find('.input-items').find('input, .nice-select, select').addClass('edit').removeClass('disabled').removeAttr('disabled readonly').focus().select();

        // Update Logo for Bank Dropdown
        field.find('.nice-select ul li').click(function() {
            var dataValue = $(this).attr('data-value');
            var splitDataValue = dataValue.split('|');
            var url = splitDataValue[1];
            $(this).parents('.collapse').find('img.bank-logo').attr('src', url);

        });


        // On Click Cancel
        field.find('.cancel').click(function(e) {
            e.preventDefault();

            // Hide Cancel & Save ... Show Edit
            $(this).addClass('hidden');
            $(this).siblings('.save').addClass('hidden');
            $(this).siblings('.edit').removeClass('hidden');

            // Revert to Initial Value
            field.find('.input-items').find('input, select').val(val);
            field.find('.input-items').find('select').niceSelect('update');
            
            // Make Field Uneditable
            field.find('.input-items').find('input, .nice-select').removeClass('edit').addClass('disabled').attr('readonly', true);

            // Revert Logo for Bank Dropdown
            var splitValue = val.split('|');
            var url = splitValue[1];
            field.parents('.collapse').find('img.bank-logo').attr('src', url);

            // Unbind Click Function to Remove Loop
            $(this).unbind('click');

            field.find('form').unbind('submit');
            field.find('.save').unbind('click');

        });




        // On Click Save
        field.find('.save').click(function(e) {
            e.preventDefault();

            // Hide Cancel Button
            $(this).siblings('.cancel').addClass('hidden');
            
            // Submit Update Form
            field.find('form').submit(function(e) {
                e.preventDefault();

                // Make Field Uneditable while Saving
                field.find('.input-items').find('input, .nice-select').removeClass('edit').addClass('disabled').attr('readonly', true);

                // Add Loading Icon
                field.find('.save').prepend('<i class="lni-spinner lni-spin-effect"></i>').attr('disabled',true);

                // Save to Database
                $.ajax({
                    url: "{{ route('profile.update') }}",
                    method: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success:function(result) { // On Ajax Success

                        if($.isEmptyObject(result.error)) { // If the error container is empty [i.e. success]

                            // Success Alert Message
                            toastr.success(result.success);

                            // Remove loading animation
                            field.find('.save').addClass('hidden').removeAttr('disabled').children('i.lni-spinner').remove();
                            
                            // Show Edit Button
                            field.find('.edit').removeClass('hidden'); 

                            // Update New Value
                            var newVal = result.data;

                            // newVal = field.find('select').val();
                            field.attr('data-value', newVal);


                        } else { // If error container not empty [i.e error] 
                            
                            // Errors List
                            var errors = result.error;
                            var errorList = [];
                            errors.forEach(function(item) {
                                errorList.push('<li>'+ item + '</li>');
                            });

                            // Error Alert Message
                            toastr.error('<ul>' + errorList.join('') + '</ul>', 'Please check your input');

                            // Remove loading animation
                            field.find('.save').addClass('hidden').removeAttr('disabled').children('i.lni-spinner').remove();
                            
                            // Show Edit Button
                            field.find('.edit').removeClass('hidden');

                            // Revert to Initial Value
                            field.find('.input-items').find('input, select').val(val);
                            field.find('.input-items').find('select').niceSelect('update');
                            
                            // Revert Logo for Bank Dropdown
                            var splitValue = val.split('|');
                            var url = splitValue[1];
                            field.parents('.collapse').find('img.bank-logo').attr('src', url);

                        }
                    },
                    error: function(xhr, status, error){ // On Ajax Error

                        // Error Alert Message
                        toastr.error(xhr.statusText, 'Error - ' + xhr.status);

                        // Remove loading animation
                        field.find('.save').addClass('hidden').removeAttr('disabled').children('i.lni-spinner').remove();
                        
                        // Show Edit Button
                        field.find('.edit').removeClass('hidden');

                        // Revert to Initial Value
                        field.find('.input-items').find('input, select').val(val);
                        field.find('.input-items').find('select').niceSelect('update');

                        // Make Field Uneditable
                        field.find('.input-items').find('input, .nice-select').removeClass('edit').addClass('disabled').attr('readonly', true);
                        
                        // Revert Logo for Bank Dropdown
                        var splitValue = val.split('|');
                        var url = splitValue[1];
                        field.parents('.collapse').find('img.bank-logo').attr('src', url);
                    }
                }).fail(function() { toastr.error('Something went wrong') }); // On Ajax Fail

                // Unbind Submit Function to Remove Loop
                $(this).unbind('submit');

            }).submit();

            // Unbind Click Function to Remove Loop
            $(this).unbind('click');

        });


    });
    
    // Update Password Modal
    $('#passwordButton').click(function(e) {
        e.preventDefault();

        var field = $(this).parents('.form-input');
        $(this).parent().append(`
            <div class="modal fade" id="passwordModal" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                    <form method="POST" action="{{ route('profile.update') }}">
                        @csrf
                        <input name="fieldname" value="new_password" type="hidden" />

                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="passwordModalLabel">Update Password</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body text-center">
                                <div class="sign-in-form-area wow fadeIn" data-wow-duration="1s" data-wow-delay="0.4s">
                                    <div class="sign-in-form-wrapper form-style-two">

                                        <div class="form-input">
                                            <!-- <label>Password</label> -->
                                            <div class="input-items active">
                                                <input type="password" name="current_password" placeholder="Current Password" required autocomplete="current-password">
                                                <i class="lni-key"></i>
                                            </div>
                                        </div> <!-- form input -->

                                        <div class="form-input mt-25">
                                            <!-- <label>Password</label> -->
                                            <div class="input-items active">
                                                <input type="password" name="new_password" placeholder="New Password" required autocomplete="new-password">
                                                <i class="lni-key"></i>
                                            </div>
                                        </div> <!-- form input -->

                                        <div class="form-input mt-25">
                                            <!-- <label>Password</label> -->
                                            <div class="input-items active">
                                                <input type="password" name="new_password_confirmation" placeholder="Confirm New Password" required>
                                                <i class="lni-key"></i>
                                            </div>
                                        </div> <!-- form input -->

                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger cancel" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-success save">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        `);
        
        field.find('.modal').on('shown.bs.modal', function() {

            $(this).find('form').submit(function(e) {
                e.preventDefault();

                $(this).find('.modal-footer button').attr('disabled', true);
                $(this).find('.save').prepend(`<i class="lni-spinner lni-spin-effect"></i> `);

                // Save to Database
                $.ajax({
                    url: "{{ route('profile.update') }}",
                    method: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success:function(result) { // On Ajax Success

                        if($.isEmptyObject(result.error)) { // If the error container is empty [i.e. success]

                            // Success Alert Message
                            toastr.success(result.success);

                            // Remove modal footer
                            field.find('.modal-footer').remove();

                            // Repace modal body
                            field.find('.modal-body').html('<i class="lni-check-mark-circle text-success font-weight-bolder display-1"></i>');

                        } else { // If error container not empty [i.e error] 
                            
                            // Errors List
                            var errors = result.error;
                            var errorList = [];
                            errors.forEach(function(item) {
                                errorList.push('<li>'+ item + '</li>');
                            });

                            // Error Alert Message
                            toastr.error('<ul>' + errorList.join('') + '</ul>', 'Please check your input');

                            // Remove loading animation
                            field.find('.modal-footer button').removeAttr('disabled');
                            field.find('.save').children('i.lni-spinner').remove();
                            
                        }
                    },
                    error: function(xhr, status, error){ // On Ajax Error

                        // Error Alert Message
                        toastr.error(xhr.statusText, 'Error - ' + xhr.status);

                        // Remove loading animation
                        field.find('.modal-footer button').removeAttr('disabled');
                        field.find('.save').children('i.lni-spinner').remove();

                    }
                }).fail(function() { toastr.error('Something went wrong') }); // On Ajax Fail

                // Unbind Submit Function to Remove Loop
                // $(this).unbind('submit');

            });

        }).on('hidden.bs.modal', function() {
           field.find('.modal').remove();

        }).modal('show');

    });

    



    // Add Wallet
    $('#add-wallet').click(function(e) {
        e.preventDefault();
        
        var addWallet = $(this).parent();
        addWallet.append(`
            <div class="modal fade" id="addWalletModal" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-dialog-centered modal-sm modal-dialog-scrollable" role="document">
                    <form method="POST" action="{{ route('wallet.store') }}">
                        @csrf
                        <!-- <input name="fieldname" value="new_password" type="hidden" /> -->

                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="passwordModalLabel">Add New Wallet</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body text-center" style="max-height:300px;">
                                <div class="sign-in-form-area wow fadeIn text-left" data-wow-duration="1s" data-wow-delay="0.4s">
                                    <div class="sign-in-form-wrapper form-style-two no-icon">

                                        <!-- <div class="form-input">
                                            <label>Platform</label>
                                            <div class="input-items default">
                                                <input type="text" name="platform" placeholder="Platform e.g. Paxful" required>
                                            </div>
                                        </div> -->

                                        <div class="custom-dropdown form-input">
                                            <label>Platform</label>
                                            <div class="input-items default" style="height:44px">
                                                <select name="platform" class="required no-search" required tabindex="-1">
                                                    <option disabled selected data-display="Select ...">Select ...</option>
                                                    @foreach($platforms as $platform)
                                                    <option value="{{ $platform }}">{{ $platform }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="custom-dropdown form-input mt-4">
                                            <label>Currency</label>
                                            <div class="input-items default" style="height:44px">
                                                <select name="currency" class="required no-search" required tabindex="-1">
                                                    <option disabled selected data-display="Select ...">Select ...</option>
                                                    @foreach($currencies as $unit => $currency)
                                                    <option value="{{ $unit }}">{{ $currency['name'] . ' [' . $unit . ']' }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                            

                                        <div class="form-input mt-4">
                                            <label>Wallet Address</label>
                                            <div class="input-items default">
                                                <input type="text" name="address" placeholder="e.g. 3LfV7Zna8gG6..." required>
                                            </div>
                                        </div>

                                        <div class="form-input mt-4">
                                            <label>Exchange Rate ($ => ₦)</label>
                                            <div class="input-items default">
                                                <input type="text" name="rate" placeholder="e.g. 450" required>
                                            </div>
                                        </div>

                                        <div class="form-input mt-4">
                                            <label class="d-flex justify-content-between">
                                                <span class="d-flex align-items-end">QR Code</span>
                                                <div class="light-rounded-buttons" id="generate" data-status="">
                                                    <a href="#" class="main-btn light-rounded-two xs-btn text-none font-weight-normal d-flex align-items-center">
                                                        <i class="lni-frame-expand d-inline-block mr-2"></i>
                                                        <span>Preview</span>
                                                    </a>
                                                </div>
                                            </label>
                                            <div class="input-items default qr-preview hidden" data-value="">
                                                <img src="{{ asset('img/ui/qrcode.png') }}" alt="" class="img-fluid field-border">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger cancel" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-success save">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        `);
        
        addWallet.find('.modal').on('show.bs.modal', function() {

            addWallet.find('select').niceSelect();

            addWallet.find('.nice-select.no-search .nice-select-search-box').remove();
            addWallet.find('.nice-select.no-search ul.list').addClass('pt-0');
            
            var currencyField = addWallet.find('select[name="currency"]');
            var addressField = addWallet.find('input[name="address"]');
            var genBtn = addWallet.find('#generate');
            var qrPreview = addWallet.find('.qr-preview');

            function qrBtn(status) {
                    
                if(status == 'generating') {
                    genBtn.attr('class', 'light-rounded-buttons disabled');
                    genBtn.attr('data-status', 'generating');
                    genBtn.html(`
                        <span class="disabled main-btn light-rounded-two xs-btn text-none font-weight-normal w-100 d-flex align-items-center">
                            <i class="lni-spinner lni-spin-effect my-1"></i>
                        </span>
                    `);

                } else if(status == 'generated') {
                    genBtn.attr('class', 'light-rounded-buttons success-buttons disabled');
                    genBtn.attr('data-status', 'generated');
                    genBtn.html(`
                        <span class="disabled main-btn success-two xs-btn text-none font-weight-normal w-100 d-flex align-items-center">
                            <i class="lni-check-mark-circle my-1"></i>
                        </span>
                    `);

                    qrPreview.removeClass('hidden');

                } else {
                    genBtn.attr('class', 'light-rounded-buttons');
                    genBtn.attr('data-status', '');
                    genBtn.html(`
                        <a href="#" class="main-btn light-rounded-two xs-btn text-none font-weight-normal w-100 d-flex align-items-center">
                            <i class="lni-frame-expand d-inline-block mr-2"></i>
                            <span>Preview</span>
                        </a>
                    `);

                    qrPreview.addClass('hidden');
                }

            }

            genBtn.click(function(e) {
                e.preventDefault();

                var currency = currencyField.val();
                var address = addressField.val();

                if($(this).attr('data-status') == '') {

                    if(currency == null) {
                        toastr.error('Please select a currency');

                    } else if(address == '') {
                        toastr.error('Please enter wallet address');

                    } else {
                        qrBtn('generating');
                        
                        if(WAValidator.validate(address, currency)) { // issue with currency validation
                        // if(true) {

                            // Save address
                            qrPreview.attr('data-value', address);

                            // Generate QR Code
                            $.ajax({
                                url: "{{ route('wallet.qr_gen') }}",
                                method: "POST",
                                data: {
                                    address: address,    
                                },
                                cache: false,
                                success:function(result) { // On Ajax Success

                                    if($.isEmptyObject(result.error)) { // If the error container is empty [i.e. success]

                                        qrPreview.find('img').attr('src', "{{ asset('img/wallets/temp') }}" + '/' + address + '.png');
                                        qrPreview.removeClass('hidden').parents('.modal-body').animate({
                                            scrollTop: genBtn.offset().top + 1000,
                                        });

                                        qrBtn('generated');

                                        setTimeout(function() {
                                            $.ajax({
                                                url: "{{ route('wallet.qr_del') }}",
                                                method: "POST",
                                                data: {
                                                    address: address,
                                                },
                                                cache: false,
                                            });
                                        }, 5000);

                                        

                                    } else { // If error container not empty [i.e error] 
                                        
                                        // Error Alert Message
                                        toastr.error(result.error);
                                        
                                        qrBtn();

                                    }
                                },
                                error: function(xhr, status, error){ // On Ajax Error

                                    // Error Alert Message
                                    toastr.error(xhr.statusText, 'Error - ' + xhr.status);
                                    
                                    qrBtn();

                                }
                            }).fail(function() { toastr.error('Something went wrong') }); // On Ajax Fail

                            

                        } else {
                            
                            qrBtn();
                            toastr.error('The wallet address is invalid');
                        };

                    }
                    
                }

            });

            
            addressField.on('beforeinput', function() {
                $(this).attr('data-value', $(this).val());
            });

            addressField.on('input', function() {
                var oldval = $(this).attr('data-value');
                var newval = $(this).val();

                var genval = qrPreview.attr('data-value');

                if(newval != oldval) {

                    if(newval == genval) {
                        qrBtn('generated'); // Same as last generated QR preview
                    } else {
                        qrBtn(); // Activate generate button
                    }
                    
                }
            });


            $(this).find('form').submit(function(e) {
                e.preventDefault();

                var currency = currencyField.val();
                var address = addressField.val();

                if(WAValidator.validate(address, currency)) { // issue with currency validation
                // if(true) {

                    $(this).find('.modal-footer button').attr('disabled', true);
                    $(this).find('.save').prepend(`<i class="lni-spinner lni-spin-effect"></i> `);

                    // Save to Database
                    $.ajax({
                        url: "{{ route('wallet.store') }}",
                        method: "POST",
                        data: new FormData(this),
                        contentType: false,
                        cache: false,
                        processData: false,
                        success:function(result) { // On Ajax Success

                            if($.isEmptyObject(result.error)) { // If the error container is empty [i.e. success]

                                // Success Alert Message
                                toastr.success(result.success);

                                // Remove modal footer
                                addWallet.find('.modal-footer').remove();

                                // Repace modal body
                                addWallet.find('.modal-body').html('<i class="lni-check-mark-circle text-success font-weight-bolder display-1"></i>');

                                // Prepare clone for insert
                                var wallet = result.data;

                                var walletsContainer = $('.wallets-container');

                                var cloneWallet = walletsContainer.find('.dummy.wallet-card').clone(true)
                                .insertBefore(walletsContainer.find('.wallet-card').first());

                                cloneWallet.removeClass('dummy').attr('cloned', true);
                                cloneWallet.find('img.qrcode').attr('src', "{{ asset('img/wallets/') }}" + '/' + wallet.qrcode);
                                cloneWallet.find('.platform').text(wallet.platform);
                                cloneWallet.find('.currency').text(wallet.currency);
                                cloneWallet.find('.rate').text(wallet.rate);
                                cloneWallet.find('img.icon').attr('src', "{{ asset('img/currencies/') }}" + '/' + wallet.icon);
                                cloneWallet.find('input.address').val(wallet.address);
                                cloneWallet.find('.wallet-edit, .wallet-delete').attr('data-id', wallet.id);
                                cloneWallet.find('.wallet-delete').attr('data-name', wallet.platform + ' ' + wallet.currency);

                                // cloneWallet.insertBefore(walletsContainer.find('.wallet-card').first());

                            } else { // If error container not empty [i.e error] 
                                
                                // Errors List
                                var errors = result.error;
                                var errorList = [];
                                errors.forEach(function(item) {
                                    errorList.push('<li>'+ item + '</li>');
                                });

                                // Error Alert Message
                                toastr.error('<ul class="multiple">' + errorList.join('') + '</ul>', 'Please check your input');

                                // Remove loading animation
                                addWallet.find('.modal-footer button').removeAttr('disabled');
                                addWallet.find('.save').children('i.lni-spinner').remove();
                                
                            }
                        },
                        error: function(xhr, status, error){ // On Ajax Error

                            // Error Alert Message
                            toastr.error(xhr.statusText, 'Error - ' + xhr.status);

                            // Remove loading animation
                            addWallet.find('.modal-footer button').removeAttr('disabled');
                            addWallet.find('.save').children('i.lni-spinner').remove();

                        }
                    }).fail(function() { toastr.error('Something went wrong') }); // On Ajax Fail


                } else {
                    toastr.error('The wallet address is invalid');

                }

                // Unbind Submit Function to Remove Loop
                // $(this).unbind('submit');

            });

        }).on('hidden.bs.modal', function() {
            addWallet.find('.modal').remove();

            // Show cloned wallet
            var clonedWallet = $('.wallet-card[cloned]');
            clonedWallet.removeClass('hidden');
            clonedWallet.addClass('animate__animated animate__bounceIn').removeAttr('cloned')
            
            // On animation complete
            clonedWallet.on('animationend', () => {
                clonedWallet.removeClass('animate__animated animate__bounceIn');
            });

            $('.grid-3').isotope('layout');

        }).modal('show');
    });

    

    // Delete Wallet
    $('.wallet-delete').click(function(e) {
        e.preventDefault();
        
        var deleteWallet = $(this).parents('.wallet-card');
        var id = $(this).attr('data-id');
        var name = $(this).attr('data-name');

        deleteWallet.append(`
            <div class="modal fade" id="deleteWalletModal" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="passwordModalLabel">Delete Wallet</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body text-center">
                            <p class="text-left">Are you sure you want to delete <span class="font-weight-bold"> ` + name + `</span> wallet?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary no" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger yes">Delete</button>
                            <form class="ui form" action="" method="POST">
                                @csrf
                                {!! method_field('DELETE') !!}
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        `).find('.modal').on('show.bs.modal', function() {
            var deleteBtn = deleteWallet.find('.modal-footer .yes');

            deleteWallet.find('form').submit(function(e) {
                e.preventDefault();

                deleteWallet.find('.modal-footer button').attr('disabled', true);
                deleteBtn.prepend(`<i class="lni-spinner lni-spin-effect"></i> `);

                // Delete from Database
                $.ajax({
                    // url: "{{ route('wallet.destroy', " + id + ") }}",
                    url: "/wallet/" + id,
                    method: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success:function(result) { // On Ajax Success

                        if($.isEmptyObject(result.error)) { // If the error container is empty [i.e. success]

                            // Success Alert Message
                            toastr.success(result.success);

                            // Remove modal footer
                            deleteWallet.find('.modal-footer').remove();

                            // Repace modal body
                            deleteWallet.find('.modal-body').html('<i class="lni-check-mark-circle text-success font-weight-bolder display-1"></i>');

                            // 
                            deleteWallet.attr('deleted', true);

                        } else { // If error container not empty [i.e error] 
                            
                            // Error Alert Message
                            toastr.error(result.error);

                            // Remove loading animation
                            deleteWallet.find('.modal-footer button').removeAttr('disabled');
                            deleteWallet.find('.yes').children('i.lni-spinner').remove();
                            
                        }
                    },
                    error: function(xhr, status, error){ // On Ajax Error

                        // Error Alert Message
                        toastr.error(xhr.statusText, 'Error - ' + xhr.status);

                        // Remove loading animation
                        deleteWallet.find('.modal-footer button').removeAttr('disabled');
                        deleteBtn.children('i.lni-spinner').remove();

                    }
                }).fail(function() { toastr.error('Something went wrong') }); // On Ajax Fail
            });

            deleteBtn.click(function() {
                deleteWallet.find('form').submit();
            });

        }).on('hidden.bs.modal', function() {

            deleteWallet.find('.modal').remove();

            var deleted = deleteWallet.attr('deleted');
            if(deleted) {
                deleteWallet.children().addClass('animate__animated animate__flash');
                deleteWallet.addClass('animate__animated animate__bounceOut').fadeOut(1000);

            }

        }).modal('show');


    });

@endsection