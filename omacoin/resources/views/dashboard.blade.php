@extends('layouts.master')

@section('extra_links')
    <link rel="stylesheet" href="{{ asset('css/material-kit.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animate.min.css') }}">
@endsection

@section('title', 'OmaCoin | ' . (Auth::user()->role == 'admin' ? 'Admin Panel' : 'My Dashboard') )

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
    <script src="{{asset('tinymce/tinymce.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('tinymce/jquery.tinymce.min.js')}}" type="text/javascript"></script>
    

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

    
    // Get currently active tab
    $('.grid-3').on('arrangeComplete', function (event, filteredItems) {
        var filteredItem = $(filteredItems[0]['element']).attr('class').replace('col-12 ', '');

        if(filteredItem == 'wallets') {
            firstShowNote();
        }

        // If responsive table exists in active tab
        if($(filteredItems[0]['element']).find('.table-responsive').length > 0) {
            $('.grid-3').isotope('layout');
        }

    });

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



    /////////////////// PROFILE - START ///////////////////

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
    
    /////////////////// PROFILE - END ///////////////////



    /////////////////// WALLETS ///////////////////

    // Add Wallet
    $('#add-wallet').click(function(e) {
        e.preventDefault();
        
        var addWallet = $(this).parent();
        addWallet.append(`
            <div class="modal fade" id="addWalletModal" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-dialog-centered modal-sm modal-dialog-scrollable" role="document">
                    <form method="POST" action="{{ route('wallet.store') }}">
                        @csrf

                        <div class="modal-content d-block">
                            <div class="modal-header">
                                <h5 class="modal-title" id="passwordModalLabel">Add New Wallet</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body text-center" style="max-height:332px;">
                                <div class="sign-in-form-area wow fadeIn text-left" data-wow-duration="1s" data-wow-delay="0.4s">
                                    <div class="sign-in-form-wrapper form-style-two no-icon">

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

                                        <div class="row mx-0 w-100">
                                            <div class="custom-dropdown form-input mt-4 col-6 pr-2 pl-0">
                                                <label>Currency</label>
                                                <div class="input-items default" style="height:44px">
                                                    <select name="currency" class="required no-search" required tabindex="-1">
                                                        <option disabled selected data-display="Select ...">Select ...</option>
                                                        @foreach($currencies as $unit => $currency)
                                                        {{-- <option value="{{ $unit }}">{{ $currency['name'] . ' [' . $unit . ']' }}</option> --}}
                                                        <option value="{{ $unit }}">{{ $currency['name'] }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="custom-dropdown form-input mt-4 col-6 pl-2 pr-0">
                                                <label>Token</label>
                                                <div class="input-items default" style="height:44px">
                                                    <select name="token" class="required no-search" required tabindex="-1">
                                                        <option disabled selected data-display="Select ...">Select ...</option>
                                                        @foreach($tokens as $token)
                                                        <option value="{{ $token }}">{{ $token }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
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
                                                <span class="d-flex align-items-end">Note</span>
                                                <div class="light-rounded-buttons" id="add-note" data-status="">
                                                    <a href="#" class="main-btn light-rounded-two xs-btn text-none font-weight-normal d-flex align-items-center">
                                                        <i class="lni-pencil-alt d-inline-block mr-2"></i>
                                                        <span>Add Note</span>
                                                    </a>
                                                </div>
                                            </label>
                                            <div class="input-items default">
                                                <textarea name="note" class="hidden" placeholder="e.g. Remember to send only XXX to this address"></textarea>
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
                                <button type="submit" class="btn btn-success create">Create</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        `);
        
        addWallet.find('.modal').on('show.bs.modal', function() {

            addCustomScroll(addWallet.find('.modal-body'));

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
                                        var qrBtnPos = genBtn.position().top;
                                        var qrPreviewPos = qrPreview.find('img').position().top;
                                        qrPreview.removeClass('hidden').parents('.modal-body .os-viewport').animate({
                                            scrollTop: qrBtnPos,
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
                    
                } else {
                    qrBtn('generated');

                }
            });


            $(this).find('form').submit(function(e) {
                e.preventDefault();

                var currency = currencyField.val();
                var address = addressField.val();

                if(currency == null) {
                    toastr.error('Please select a currency');

                } else if (address == '') {
                    toastr.error('Please enter wallet address');

                } else {

                    if(WAValidator.validate(address, currency)) { // issue with currency validation
                    // if(true) {

                        var formData = new FormData(this);

                        for (var pair of formData.entries()) {
                            console.log(pair[0]+ ', ' + pair[1]); 
                        }

                        // Trigger Save on Tinymce
                        tinymce.triggerSave();

                        for (var pair of formData.entries()) {
                            console.log(pair[0]+ ', ' + pair[1]); 
                        }

                        $(this).find('.modal-footer button').attr('disabled', true);
                        $(this).find('.create').prepend(`<i class="lni-spinner lni-spin-effect"></i> `);

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
                                    
                                    if(wallet.note != '') {
                                        cloneWallet.find('.note.form-input').addClass('bg-transparent').find('.input-items').html(`
                                            <div class="display-text bg-transparent text-transparent" style="max-height: 100% !important;">
                                                `+ wallet.note +`
                                            </div>
                                        `).find('*').addClass('text-transparent');
                                    
                                    } else {
                                        cloneWallet.find('.note.form-input').addClass('bg-transparent').find('.input-items').html(`
                                            <div class="display-text bg-transparent text-transparent text-center" style="max-height: 100% !important;">
                                                Nothing Here
                                            </div>
                                        `);

                                    }

                                    cloneWallet.find('.platform').text(wallet.platform);
                                    cloneWallet.find('.currency').text(wallet.currency);
                                    cloneWallet.find('.token').text(wallet.token);
                                    cloneWallet.find('.rate').text(Math.round(wallet.rate));
                                    cloneWallet.find('img.icon').attr('src', "{{ asset('img/currencies/') }}" + '/' + wallet.icon);
                                    cloneWallet.find('input.address').val(wallet.address);
                                    
                                    cloneWallet.find('.copy').attr({
                                        'data-toggle': 'tooltip',
                                        'title': 'Copy'
                                    }).tooltip();

                                    cloneWallet.find('label.switch, .wallet-edit, .wallet-delete').attr('data-id', wallet.id);
                                    cloneWallet.find('label.switch, .wallet-delete').attr('data-name', wallet.platform + ' ' + wallet.currency + ' ' + wallet.token);

                                    cloneWallet.find('.wallet-edit').attr({
                                        'data-platform' : wallet.platform,
                                        'data-currency' : wallet.currency,
                                        'data-token' : wallet.token,
                                        'data-address' : wallet.address,
                                        'data-rate' : Math.round(wallet.rate),
                                        'data-icon' : '{{ asset("img/currencies/") }}' + '/' + wallet.icon,
                                        'data-note' : wallet.note,
                                        'data-qr' : '{{ asset("img/wallets/") }}' + '/' + wallet.qrcode
                                    });

                                    cloneWallet.insertBefore(walletsContainer.find('.wallet-card').first());

                                } else { // If error container not empty [i.e error] 
                                    
                                    if(Array.isArray(result.error)) {
                                        // Errors List
                                        var errors = result.error;
                                        var errorList = [];
                                        errors.forEach(function(item) {
                                            errorList.push('<li>'+ item + '</li>');
                                        });

                                        // Error Alert Message List
                                        toastr.error('<ul class="multiple">' + errorList.join('') + '</ul>', 'Please check your input');

                                    } else {
                                        // Error Alert Message
                                        toastr.error(result.error);

                                    }
                                    

                                    

                                    // Remove loading animation
                                    addWallet.find('.modal-footer button').removeAttr('disabled');
                                    addWallet.find('.create').children('i.lni-spinner').remove();
                                    
                                }
                            },
                            error: function(xhr, status, error){ // On Ajax Error

                                // Error Alert Message
                                toastr.error(xhr.statusText, 'Error - ' + xhr.status);

                                // Remove loading animation
                                addWallet.find('.modal-footer button').removeAttr('disabled');
                                addWallet.find('.create').children('i.lni-spinner').remove();

                            }
                        }).fail(function() { toastr.error('Something went wrong') }); // On Ajax Fail


                    } else {
                        toastr.error('The wallet address is invalid');

                    }

                }

                // Unbind Submit Function to Remove Loop
                // $(this).unbind('submit');

            });

        }).on('shown.bs.modal', function() {

            var addNoteBtn = addWallet.find('#add-note');
            var textArea = addWallet.find('.tox.tox-tinymce');
            
            function noteBtn(status) {
                    
                if(status == 'loading') {
                    addNoteBtn.attr('class', 'light-rounded-buttons disabled');
                    addNoteBtn.attr('data-status', 'loading');
                    addNoteBtn.html(`
                        <span class="disabled main-btn light-rounded-two xs-btn text-none font-weight-normal w-100 d-flex align-items-center">
                            <i class="lni-spinner lni-spin-effect my-1"></i>
                        </span>
                    `);

                } else if(status == 'completed') {
                    addNoteBtn.attr('class', 'light-rounded-buttons success-buttons disabled');
                    addNoteBtn.attr('data-status', 'completed');
                    addNoteBtn.html(`
                        <span class="disabled main-btn success-two xs-btn text-none font-weight-normal w-100 d-flex align-items-center">
                            <i class="lni-check-mark-circle my-1"></i>
                        </span>
                    `);

                } else {
                    // addNoteBtn.attr('class', 'light-rounded-buttons');
                    // addNoteBtn.attr('data-status', '');
                    // addNoteBtn.html(`
                    //     <a href="#" class="main-btn light-rounded-two xs-btn text-none font-weight-normal w-100 d-flex align-items-center">
                    //         <i class="lni-frame-expand d-inline-block mr-2"></i>
                    //         <span>Preview</span>
                    //     </a>
                    // `);

                }

            }


            // Show Note Textarea onclick
            
            addNoteBtn.click(function(e) {
                e.preventDefault();

                if($(this).attr('data-status') == '') {

                    noteBtn('loading');

                    // Initialize TinyMCE on modal shown
                    // tinymce start
                    addWallet.find('textarea').tinymce({
                        menubar: false,
                        statusbar: false,
                        plugins: [
                            'autolink lists link anchor',
                        ],
                        toolbar: 'undo redo | bold italic underline | link bullist',
                        toolbar_mode: 'scrolling',
                        invalid_elements: 'div',
                        content_style: `
                            @import url("https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800");
                            body {
                                font-family: "Poppins", sans-serif !important;
                                font-weight: 400;
                                font-style: normal;
                                font-size: 16px;
                                color: #6c6c6c;
                                background-color: -internal-light-dark(rgb(255, 255, 255), rgb(59, 59, 59));
                                padding: 0 12px;
                            }

                            body::before {
                                padding: 10px 12px;
                            }
                            
                            p:first-of-type {
                                margin-top: 10px;
                            }

                            p:last-of-type {
                                padding-bottom: 10px;
                            },
                        `,
                        init_instance_callback: function(editor) {

                            noteBtn('completed');
                            
                            // Get Body & Container
                            var body = $(editor.getBody());
                            var container = $(editor.getContainer());

                            //container.css({
                            //    "display" : "flex",
                            //});

                            // Add Custom Scrollbar
                            addCustomScroll(body);


                            // Style Container
                            container.css({
                                "border-radius" : "5px",
                                "border" : "2px solid #a4a4a4",
                            }).find('.tox-anchorbar').css({
                                "border" : "1px solid #a4a4a4",
                            });


                            // Style Container Active on Focus
                            editor.on('focus', function() {
                                container.css({
                                    "border-color" : "#0067f4",
                                }).find('.tox-anchorbar').css({
                                    "border-color" : "#0067f4",
                                });

                                body.addClass('undo');
                            });

                            

                            // Activate Paste as Plain Text only
                            
                            editor.on('paste', function(e) {
                                e.preventDefault();
                                var text = (e.orignalEvent || e).clipboardData.getData('text/plain');

                                var currentNode = editor.selection.getNode();

                                // If first node and node is empty
                                if((body.find('.os-content p').index() == 0) && (body.find('.os-content p').text().length == 0)) {
                                    body.find('.os-content p').find('br[data-mce-bogus]').remove();
                                    body.find('.os-content p').append(text)
                                    editor.selection.collapse(false);

                                } else {
                                    editor.insertContent(text);
                                    editor.selection.collapse(false);
                                    
                                }
                            });

                            // Remove Active Style on Blur
                            editor.on('blur', function() {
                                container.css({
                                    "border-color" : "#a4a4a4",
                                }).find('.tox-anchorbar').css({
                                    "border-color" : "#a4a4a4",
                                });
                            });
                            

                            // Initialize Custom Scroll files before Undo
                            editor.on('BeforeAddUndo', function() {
                                // Load CSS
                                //editor.dom.loadCSS('{{ asset("css/OverlayScrollbars.min.css") }}');

                                // Load JS
                                var scriptLoader = new tinymce.dom.ScriptLoader();
                                //scriptLoader.add('{{ asset("js/jquery.min.js") }}');
                                scriptLoader.add('{{ asset("js/jquery.overlayScrollbars.min.js") }}');
                                scriptLoader.loadQueue();
                            });

                            // Set Cursor / Caret to appropriate node after undo / redo
                            function setCaret() {
                                var node = editor.selection.getNode(); // current caret node
                                var nodePos = $(node).position().top;
                                var scrollPos = body.find('.os-viewport').scrollTop();
                                body.find('.os-viewport').scrollTop(nodePos - 38);
                            }

                            // Reset Content after Undo
                            editor.on('Undo', function(e) {

                                // Reinitialize Custom Scroll
                                addCustomScroll(body);
                                
                                setCaret();

                            });

                            editor.on('Redo', function(e) {
                                setCaret();

                            });

                        },
                        setup: function(editor) {

                            editor.on('init', function(e) {

                                editor.pasteAsPlainText = true;

                                var notePos = addWallet.find('#add-note').position().top;
                                var modalScroll = addWallet.find('.modal-body .os-viewport');
                                modalScroll.animate({
                                    scrollTop: notePos
                                });
                                
                                // Load CSS
                                this.dom.loadCSS('{{ asset("css/OverlayScrollbars.min.css") }}');

                                // Load JS
                                //var scriptLoader = new tinymce.dom.ScriptLoader();
                                //scriptLoader.add('{{ asset("js/jquery.min.js") }}');
                                //scriptLoader.add('{{ asset("js/jquery.overlayScrollbars.min.js") }}');
                                //scriptLoader.loadQueue();

                                // Get Body
                                var body = $(this.getBody());

                                editor.on('keydown', function(e) {
                                    
                                    modalScroll.scrollTop(notePos);

                                    var node = editor.selection.getNode(); // current caret node

                                    var nodePos = $(node).position().top;
                                    var scrollPos = body.find('.os-viewport').scrollTop();
                                    if((nodePos - scrollPos) > 108) {
                                        body.find('.os-viewport').scrollTop(scrollPos + 38);
                                    }

                                });

                                editor.on('keyup', function(e) {

                                    var node = editor.selection.getNode(); // current caret node

                                    // If CustomScroll Deleted
                                    if (e.keyCode == 8 || e.keyCode == 46) { // backspace and delete keycodes
                                        
                                        if($(node).index() == 0 && $(node).text().length == 0) {

                                            // Try CustomScroll
                                            var tryScroll = setInterval(function() {
                                                
                                                // Only if CustomScroll doesn't already exist
                                                if(body.find('.os-content').length == 0) {

                                                    // Load CSS
                                                    editor.dom.loadCSS('{{ asset("css/OverlayScrollbars.min.css") }}');

                                                    // Load JS
                                                    var scriptLoader = new tinymce.dom.ScriptLoader();
                                                    //scriptLoader.add('{{ asset("js/jquery.min.js") }}');
                                                    scriptLoader.add('{{ asset("js/jquery.overlayScrollbars.min.js") }}');
                                                    scriptLoader.loadQueue();

                                                    addCustomScroll(body);

                                                    // body.find('.os-viewport').scrollTop(nodePos - 38);

                                                    // Ensure cursor is not moved back to the beginning
                                                    editor.selection.select(editor.getBody(), true);
                                                    editor.selection.collapse(false);

                                                } else {

                                                    // If customScroll exists and setInterval active
                                                    if(tryScroll) {
                                                        clearInterval(tryScroll);
                                                    }

                                                }

                                                
                                            }, 2000);

                                            // If customScroll exists
                                            if(body.find('.os-content').length > 0) {
                                                clearInterval(tryScroll);
                                            }

                                        }

                                    }
                                });

                            });

                            
                        }
                    });
                    // tinymce end

                }
            });


            

            

        }).on('hidden.bs.modal', function() {
            addWallet.find('.modal').remove();

            if(typeof tryScroll !== 'undefined') {
                clearInterval(tryScroll);
            }

            // Show cloned wallet
            var clonedWallet = $('.wallet-card[cloned]');
            clonedWallet.removeClass('hidden');
            clonedWallet.addClass('animate__animated animate__bounceIn').removeAttr('cloned');
            
            // On animation complete
            clonedWallet.on('animationend', () => {
                clonedWallet.removeClass('animate__animated animate__bounceIn');

                // Re-initialize CustomScroll
                addCustomScroll(clonedWallet.find('.display-text'));
                
                // Initialize ShowNote
                clonedWallet.find('.show-note').click();

                setTimeout( function() {
                    clonedWallet.find('.note').click()
                    setTimeout(function() {
                        clonedWallet.find('.note').removeClass('bg-transparent');
                        clonedWallet.find('.note').find('.display-text').removeClass('bg-transparent text-transparent').find('*').removeClass('text-transparent');
                        clonedWallet.off();
                    }, 500)
                }, 500);

            });

            $('.grid-3').isotope('layout');

        }).modal('show');
    });
    
    // Copy Wallet Address
    $('.copy').click(function(e) {
        e.preventDefault();

        var copyIcon = $(this);
        var copyField = copyIcon.parents('.input-items').find('input');

        copyField.select();
        document.execCommand("copy");

        // To remove highlight after copy
        var copyAddress = copyField.val();
        copyField.val('').val(copyAddress);

        copyIcon.removeClass('lni-files lni-flipped').addClass('lni-clipboard');
        copyIcon.attr('data-original-title', 'Copied!').tooltip('show');
        
        copyIcon.on('mouseleave touchend', function() {
            $(this).attr('data-original-title', 'Copy').tooltip('hide');
            $(this).removeClass('lni-clipboard').addClass('lni-files lni-flipped');
        });

        setTimeout(function() {
            copyIcon.attr('data-original-title', 'Copy').tooltip('hide');
            copyIcon.removeClass('lni-clipboard').addClass('lni-files lni-flipped');
        },1000);

        $(document).on('touchmove', function() {
            copyIcon.attr('data-original-title', 'Copy').tooltip('hide');
            copyIcon.removeClass('lni-clipboard').addClass('lni-files lni-flipped');
        });

    });

    // Reveal Wallet Note
    $('.show-note').click(function(e) {
        e.preventDefault();

        var note = $(this).parents('.single-card').find('.note');
        var textBox = $(this).parents('.single-card').find('.display-text');
        
        note.css({
            "width": "100%",
            "right": "0"
        }).click(function() {
            $(this).css({
               "width": "0",
               "right": "100%",
            });
        });

        setTimeout( function() {
            textBox.parent().height(textBox.height() + 20);
        }, 500);
        

    });

    // Show Note on load to trigger center align - Invoked on isotope arrange complete
    var executed = false; // Run firstShowNote only once
    function firstShowNote() {
        if(!executed) { // If not executed
            $('.note').find('.display-text *').addClass('text-transparent');

            $('.show-note').click();

            setTimeout( function() {
                $('.note').click()
                setTimeout(function() {
                    $('.note').removeClass('bg-transparent');
                    $('.note').find('.display-text').removeClass('bg-transparent text-transparent').find('*').removeClass('text-transparent');
                }, 500)
                $('.dummy.wallet-card').addClass('hidden');
                $('.grid-3').isotope('layout');
            }, 500);

            executed = true;
        }

    }

    // Activate Wallet
    $('.switch').click(function(e) {
        e.preventDefault();

        var id = $(this).attr('data-id');
        var name = $(this).attr('data-name');
        var checkBox = $(this).find('input[type="checkbox"]');
        var switchTo = !(checkBox.prop('checked'));
        var switchWallet = $(this).parents('.wallet-switch');

        switchWallet.removeAttr('switched');

        var action = (checkBox.prop('checked')) ? 'deactivate' : 'activate';

        switchWallet.append(`
            <div class="modal fade" id="switchModal" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="switchModalLabel">` + capitalise(action) + ` Wallet</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body text-center">
                            <p class="text-left">Are you sure you want to ` + action + ` <span class="font-weight-bold"> ` + name + `</span> wallet?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary no" data-dismiss="modal">Cancel</button>
                            `
                            + (checkBox.prop('checked') ?
                                `<button type="submit" class="btn btn-danger yes">` + capitalise(action) + `</button>`
                            : 
                                `<button type="submit" class="btn btn-primary yes">` + capitalise(action) + `</button>`
                            ) +
                            `
                            <form class="ui form" action="" method="POST">
                                @csrf
                                {!! method_field('PUT') !!}
                                <input type="hidden" name="type" value="switch">
                                <input type="hidden" name="status" value="` + switchTo + `">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        `).find('.modal').on('show.bs.modal', function() {
            var switchBtn = switchWallet.find('.modal-footer .yes');

            switchWallet.find('form').submit(function(e) {
                e.preventDefault();

                switchWallet.find('.modal-footer button').attr('disabled', true);
                switchBtn.prepend(`<i class="lni-spinner lni-spin-effect"></i> `);

                // Update Wallet Status in Database
                $.ajax({
                    // url: "{{ route('wallet.update', " + id + ") }}",
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
                            switchWallet.find('.modal-footer').remove();

                            // Repace modal body
                            switchWallet.find('.modal-body').html('<i class="lni-check-mark-circle text-success font-weight-bolder display-1"></i>');

                            // 
                            switchWallet.attr('switched', true);

                        } else { // If error container not empty [i.e error] 
                            
                            // Error Alert Message
                            toastr.error(result.error);

                            // Remove loading animation
                            switchWallet.find('.modal-footer button').removeAttr('disabled');
                            switchWallet.find('.yes').children('i.lni-spinner').remove();
                            
                        }
                    },
                    error: function(xhr, status, error){ // On Ajax Error

                        // Error Alert Message
                        toastr.error(xhr.statusText, 'Error - ' + xhr.status);

                        // Remove loading animation
                        switchWallet.find('.modal-footer button').removeAttr('disabled');
                        switchBtn.children('i.lni-spinner').remove();

                    }
                }).fail(function() { toastr.error('Something went wrong') }); // On Ajax Fail
            });

            switchBtn.click(function() {
                switchWallet.find('form').submit();
            });

        }).on('hidden.bs.modal', function() {

            switchWallet.find('.modal').remove();

            var switched = switchWallet.attr('switched');
            if(switched) {
                checkBox.prop("checked", !checkBox.prop("checked"));

            }
            

        }).modal('show');

    });

    // Reveal Wallet QR
    $('.show-qr').click(function(e) {
        e.preventDefault();
        $(this).parents('.single-card').find('.card-image').css({
            "width": "100%",
            "left": "0"
        }).click(function() {
            $(this).css({
                "width": "0",
                "left": "100%"
            });
        });
    });

    
    // Edit Wallet
    $('.wallet-edit').click(function(e) {
        e.preventDefault();
        
        var editWallet = $(this).parents('.wallet-card');

        var id = $(this).attr('data-id');
        // var oldName = $(this).attr('data-name');

        var oldPlatform = $(this).attr('data-platform');
        var oldCurrency = $(this).attr('data-currency');
        var oldToken = $(this).attr('data-token');
        var oldRate = $(this).attr('data-rate');
        var oldIcon = $(this).attr('data-icon');
        var oldAddress = $(this).attr('data-address');
        var oldNote = $(this).attr('data-note');
        var oldQr = $(this).attr('data-qr');

        editWallet.append(`
            <div class="modal fade" id="editWalletModal" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-dialog-centered modal-sm modal-dialog-scrollable" role="document">
                    <form method="POST" action="">
                        @csrf
                        {!! method_field('PUT') !!}
                        <input type="hidden" name="type" value="update">
                        
                        <div class="modal-content d-block">
                            <div class="modal-header">
                                <h5 class="modal-title" id="passwordModalLabel">Edit `+ oldPlatform + ' ' + oldCurrency + ' ' + oldToken +` Wallet</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body text-center" style="max-height:332px;">
                                <div class="sign-in-form-area wow fadeIn text-left" data-wow-duration="1s" data-wow-delay="0.4s">
                                    <div class="sign-in-form-wrapper form-style-two no-icon">

                                        <!-- <div class="form-input">
                                            <label>Platform</label>
                                            <div class="input-items default">
                                                <input type="text" name="platform" placeholder="Platform e.g. Paxful" required value="`+ oldPlatform +`">
                                            </div>
                                        </div> -->

                                        <div class="custom-dropdown form-input hidden">
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

                                        <div class="row mx-0 w-100">
                                            <div class="custom-dropdown form-input mt-4 hidden col-6 pr-2 pl-0">
                                                <label>Currency</label>
                                                <div class="input-items default" style="height:44px">
                                                    <select name="currency" class="required no-search" required tabindex="-1">
                                                        <option disabled selected data-display="Select ...">Select ...</option>
                                                        @foreach($currencies as $unit => $currency)
                                                        {{-- <option value="{{ $unit }}">{{ $currency['name'] . ' [' . $unit . ']' }}</option> --}}
                                                        <option value="{{ $unit }}">{{ $currency['name'] }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="custom-dropdown form-input mt-4 hidden col-6 pl-2 pr-0">
                                                <label>Token</label>
                                                <div class="input-items default" style="height:44px">
                                                    <select name="token" class="required no-search" required tabindex="-1">
                                                        <option disabled selected data-display="Select ...">Select ...</option>
                                                        @foreach($tokens as $token)
                                                        <option value="{{ $token }}">{{ $token }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        
                                            

                                        <div class="form-input">
                                            <label>Wallet Address</label>
                                            <div class="input-items default">
                                                <input type="text" name="address" placeholder="e.g. 3LfV7Zna8gG6..." required value="`+ oldAddress +`">
                                            </div>
                                        </div>


                                        <div class="form-input mt-4">
                                            <label>Exchange Rate ($ => ₦)</label>
                                            <div class="input-items default">
                                                <input type="text" name="rate" placeholder="e.g. 450" required value="`+ oldRate +`">
                                            </div>
                                        </div>


                                        <div class="form-input mt-4">
                                            <label class="d-flex justify-content-between">
                                                <span class="d-flex align-items-end">Note</span>
                                                <div class="light-rounded-buttons" id="add-note" data-status="">
                                                    <a href="#" class="main-btn light-rounded-two xs-btn text-none font-weight-normal d-flex align-items-center">
                                                        <i class="`+ ((oldNote == '') ? 'lni-pencil-alt' : 'lni-pencil') +` d-inline-block mr-2"></i>
                                                        <span>`+ ((oldNote == '') ? 'Add' : 'Edit') +` Note</span>
                                                    </a>
                                                </div>
                                            </label>
                                            <div class="input-items default">
                                                <textarea name="note" class="hidden" placeholder="e.g. Remember to send only XXX to this address">`+ oldNote +`</textarea>
                                            </div>
                                        </div>


                                        <div class="form-input mt-4">
                                            <label class="d-flex justify-content-between">
                                                <span class="d-flex align-items-end">QR Code</span>
                                                <div class="light-rounded-buttons" id="generate" data-status="show">
                                                    <a href="#" class="main-btn light-rounded-two xs-btn text-none font-weight-normal d-flex align-items-center">
                                                        <i class="lni-frame-expand d-inline-block mr-2"></i>
                                                        <span>Show</span>
                                                    </a>
                                                </div>
                                            </label>
                                            <div class="input-items default qr-preview hidden" data-value="`+ oldAddress +`">
                                                <img src="`+ oldQr +`" alt="" class="img-fluid field-border">
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


        editWallet.find('.modal').on('show.bs.modal', function() {

            addCustomScroll(editWallet.find('.modal-body'));

            editWallet.find('select[name="platform"]').val(oldPlatform);
            editWallet.find('select[name="currency"]').val(oldCurrency);
            editWallet.find('select[name="token"]').val(oldToken);
            editWallet.find('select').niceSelect();
            editWallet.find('.nice-select.no-search .nice-select-search-box').remove();
            editWallet.find('.nice-select.no-search ul.list').addClass('pt-0');
            
            var currencyField = editWallet.find('select[name="currency"]');
            var addressField = editWallet.find('input[name="address"]');

            var genBtn = editWallet.find('#generate');
            var qrPreview = editWallet.find('.qr-preview');

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

                } else if(status == 'show') {
                    genBtn.attr('class', 'light-rounded-buttons success-buttons disabled');
                    genBtn.attr('data-status', 'generated');
                    genBtn.html(`
                        <span class="disabled main-btn success-two xs-btn text-none font-weight-normal w-100 d-flex align-items-center">
                            <i class="lni-check-mark-circle my-1"></i>
                        </span>
                    `);

                    var qrBtnPos = genBtn.position().top;
                    qrPreview.removeClass('hidden').parents('.modal-body .os-viewport').animate({
                        scrollTop: qrBtnPos,
                    });

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
                                        var qrBtnPos = genBtn.position().top;
                                        var qrPreviewPos = qrPreview.find('img').position().top;
                                        qrPreview.removeClass('hidden').parents('.modal-body .os-viewport').animate({
                                            scrollTop: qrBtnPos,
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
                    
                } else if($(this).attr('data-status') == 'show') {
                    qrBtn('show');

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
                    
                } else {
                    qrBtn('generated');

                }
            });


            $(this).find('form').submit(function(e) {
                e.preventDefault();

                // Check if any changes were made
                nowPlatform = editWallet.find('select[name="platform"]').val();
                nowCurrency = editWallet.find('select[name="currency"]').val();
                nowToken = editWallet.find('select[name="token"]').val();
                nowRate = editWallet.find('input[name="rate"]').val();
                nowIcon = editWallet.find('img.icon').attr('src');
                nowAddress = editWallet.find('input[name="address"]').val();
                nowNote = editWallet.find('textarea[name="note"]').val();

                if(oldPlatform == nowPlatform && oldCurrency == nowCurrency 
                    && oldToken == nowToken && oldRate == nowRate && oldIcon == nowIcon
                    && oldAddress == nowAddress && oldNote == nowNote) {

                    toastr.error('No changes have been made');

                } else {

                    function validateAddress() {

                        // Validate if Address Different
                        if(oldAddress != nowAddress) {

                            var currency = currencyField.val();
                            var address = addressField.val();

                            if(currency == null) {
                                toastr.error('Please select a currency');

                            } else if (address == '') {
                                toastr.error('Please enter wallet address');

                            } else {
                                return (WAValidator.validate(address, currency));

                            }

                        } else { // If Address the same

                            return true;

                        }

                    }
                    

                    

                    if(validateAddress()) {
                    // if(true) { // if issue with currency validation in the future

                        // Trigger Save on Tinymce
                        tinymce.triggerSave();

                        $(this).find('.modal-footer button').attr('disabled', true);
                        $(this).find('.save').prepend(`<i class="lni-spinner lni-spin-effect"></i> `);

                        // Save to Database
                        $.ajax({
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
                                    editWallet.find('.modal-footer').remove();

                                    // Repace modal body
                                    editWallet.find('.modal-body').html('<i class="lni-check-mark-circle text-success font-weight-bolder display-1"></i>');

                                    // Wallet data
                                    var wallet = result.data;

                                    // Mark wallet as edited
                                    editWallet.attr('edited', true);

                                    if(oldQr != "{{ asset('img/wallets/') }}" + '/' + wallet.qrcode) {
                                        editWallet.find('img.qrcode').attr('src', "{{ asset('img/wallets/') }}" + '/' + wallet.qrcode);
                                    }
                                    

                                    if(oldNote != wallet.note) {
                                        if(wallet.note != '') {
                                            editWallet.find('.note.form-input').addClass('bg-transparent').find('.input-items').removeAttr('style').html(`
                                                <div class="display-text bg-transparent text-transparent" style="height: auto; max-height: 100% !important;">
                                                    `+ wallet.note +`
                                                </div>
                                            `).find('*').addClass('text-transparent');
                                        
                                        } else {
                                            editWallet.find('.note.form-input').addClass('bg-transparent').find('.input-items').removeAttr('style').html(`
                                                <div class="display-text bg-transparent text-transparent text-center" style="max-height: 100% !important;">
                                                    Nothing Here
                                                </div>
                                            `);

                                        }
                                    } else {
                                        editWallet.find('.note.form-input').addClass('bg-transparent').find('.display-text').addClass('bg-transparent text-transparent');

                                    }
                                    

                                    if(oldPlatform != wallet.platform) {
                                        editWallet.find('.platform').text(wallet.platform);
                                    }

                                    if(oldCurrency != wallet.currency) {
                                        editWallet.find('.currency').text(wallet.currency);
                                    }

                                    if(oldToken != wallet.token) {
                                        editWallet.find('.token').text(wallet.token);
                                    }

                                    if(oldRate != Math.round(wallet.rate)) {
                                        editWallet.find('.rate').text(Math.round(wallet.rate));
                                    }

                                    if(oldIcon != "{{ asset('img/currencies/') }}" + '/' + wallet.icon) {
                                        editWallet.find('img.icon').attr('src', "{{ asset('img/currencies/') }}" + '/' + wallet.icon);
                                    }

                                    if(oldAddress != wallet.address) {
                                        editWallet.find('input.address').val(wallet.address);
                                    }
                                    
                                    //editWallet.find('.copy').attr({
                                    //    'data-toggle': 'tooltip',
                                    //    'title': 'Copy'
                                    //}).tooltip();

                                    // editWallet.find('label.switch').attr('data-id', wallet.id);

                                    if((oldPlatform + ' ' + oldCurrency + ' ' + oldToken) != (wallet.platform + ' ' + wallet.currency + ' ' + wallet.token)) {
                                        editWallet.find('label.switch, .wallet-delete').attr('data-name', wallet.platform + ' ' + wallet.currency + ' ' + wallet.token);
                                    }

                                    editWallet.find('.wallet-edit').attr({
                                        'data-platform' : wallet.platform,
                                        'data-currency' : wallet.currency,
                                        'data-token' : wallet.token,
                                        'data-address' : wallet.address,
                                        'data-rate' : Math.round(wallet.rate),
                                        'data-icon' : '{{ asset("img/currencies/") }}' + '/' + wallet.icon,
                                        'data-note' : wallet.note,
                                        'data-qr' : '{{ asset("img/wallets/") }}' + '/' + wallet.qrcode
                                    });

                                } else { // If error container not empty [i.e error] 
                                    
                                    if(Array.isArray(result.error)) {
                                        // Errors List
                                        var errors = result.error;
                                        var errorList = [];
                                        errors.forEach(function(item) {
                                            errorList.push('<li>'+ item + '</li>');
                                        });

                                        // Error Alert Message List
                                        toastr.error('<ul class="multiple">' + errorList.join('') + '</ul>', 'Please check your input');

                                    } else {
                                        // Error Alert Message
                                        toastr.error(result.error);

                                    }
                                    

                                    

                                    // Remove loading animation
                                    editWallet.find('.modal-footer button').removeAttr('disabled');
                                    editWallet.find('.save').children('i.lni-spinner').remove();
                                    
                                }
                            },
                            error: function(xhr, status, error){ // On Ajax Error

                                // Error Alert Message
                                toastr.error(xhr.statusText, 'Error - ' + xhr.status);

                                // Remove loading animation
                                editWallet.find('.modal-footer button').removeAttr('disabled');
                                editWallet.find('.save').children('i.lni-spinner').remove();

                            }
                        }).fail(function() { toastr.error('Something went wrong') }); // On Ajax Fail


                    } else {
                        toastr.error('The wallet address is invalid');

                    }

                }


            });

        }).on('shown.bs.modal', function() {

            var addNoteBtn = editWallet.find('#add-note');
            var textArea = editWallet.find('.tox.tox-tinymce');
            
            function noteBtn(status) {
                    
                if(status == 'loading') {
                    addNoteBtn.attr('class', 'light-rounded-buttons disabled');
                    addNoteBtn.attr('data-status', 'loading');
                    addNoteBtn.html(`
                        <span class="disabled main-btn light-rounded-two xs-btn text-none font-weight-normal w-100 d-flex align-items-center">
                            <i class="lni-spinner lni-spin-effect my-1"></i>
                        </span>
                    `);

                } else if(status == 'completed') {
                    addNoteBtn.attr('class', 'light-rounded-buttons success-buttons disabled');
                    addNoteBtn.attr('data-status', 'completed');
                    addNoteBtn.html(`
                        <span class="disabled main-btn success-two xs-btn text-none font-weight-normal w-100 d-flex align-items-center">
                            <i class="lni-check-mark-circle my-1"></i>
                        </span>
                    `);

                } else {
                    // addNoteBtn.attr('class', 'light-rounded-buttons');
                    // addNoteBtn.attr('data-status', '');
                    // addNoteBtn.html(`
                    //     <a href="#" class="main-btn light-rounded-two xs-btn text-none font-weight-normal w-100 d-flex align-items-center">
                    //         <i class="lni-frame-expand d-inline-block mr-2"></i>
                    //         <span>Preview</span>
                    //     </a>
                    // `);

                }

            }


            // Show Note Textarea onclick
            
            addNoteBtn.click(function(e) {
                e.preventDefault();

                if($(this).attr('data-status') == '') {

                    noteBtn('loading');

                    // Initialize TinyMCE on modal shown
                    // tinymce start
                    editWallet.find('textarea').tinymce({
                        menubar: false,
                        statusbar: false,
                        plugins: [
                            'autolink lists link anchor',
                        ],
                        // paste_as_text: true,
                        toolbar: 'undo redo | bold italic underline | link bullist',
                        toolbar_mode: 'scrolling',
                        invalid_elements: 'div',
                        content_style: `
                            @import url("https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800");
                            body {
                                font-family: "Poppins", sans-serif !important;
                                font-weight: 400;
                                font-style: normal;
                                font-size: 16px;
                                color: #6c6c6c;
                                background-color: -internal-light-dark(rgb(255, 255, 255), rgb(59, 59, 59));
                                padding: 0 12px;
                            }

                            body::before {
                                padding: 10px 12px;
                            }
                            
                            p:first-of-type {
                                margin-top: 10px;
                            }

                            p:last-of-type {
                                padding-bottom: 10px;
                            },
                        `,
                        init_instance_callback: function(editor) {

                            noteBtn('completed');
                            
                            // Get Body & Container
                            var body = $(editor.getBody());
                            var container = $(editor.getContainer());

                            //container.css({
                            //    "display" : "flex",
                            //});
                            
                            // Add Custom Scrollbar
                            addCustomScroll(body);


                            // Style Container
                            container.css({
                                "border-radius" : "5px",
                                "border" : "2px solid #a4a4a4",
                            }).find('.tox-anchorbar').css({
                                "border" : "1px solid #a4a4a4",
                            });


                            // Style Container Active on Focus
                            editor.on('focus', function() {
                                container.css({
                                    "border-color" : "#0067f4",
                                }).find('.tox-anchorbar').css({
                                    "border-color" : "#0067f4",
                                });

                                body.addClass('undo');
                            });


                            // Remove Active Style on Blur
                            editor.on('blur', function() {
                                container.css({
                                    "border-color" : "#a4a4a4",
                                }).find('.tox-anchorbar').css({
                                    "border-color" : "#a4a4a4",
                                });
                            });
                            

                            // Initialize Custom Scroll files before Undo
                            editor.on('BeforeAddUndo', function() {
                                // Load CSS
                                //editor.dom.loadCSS('{{ asset("css/OverlayScrollbars.min.css") }}');

                                // Load JS
                                var scriptLoader = new tinymce.dom.ScriptLoader();
                                //scriptLoader.add('{{ asset("js/jquery.min.js") }}');
                                scriptLoader.add('{{ asset("js/jquery.overlayScrollbars.min.js") }}');
                                scriptLoader.loadQueue();
                            });

                            // Set Cursor / Caret to appropriate node after undo / redo
                            function setCaret() {
                                var node = editor.selection.getNode(); // current caret node
                                var nodePos = $(node).position().top;
                                var scrollPos = body.find('.os-viewport').scrollTop();
                                body.find('.os-viewport').scrollTop(nodePos - 38);
                            }

                            // Reset Content after Undo
                            editor.on('Undo', function(e) {

                                // Reinitialize Custom Scroll
                                addCustomScroll(body);
                                
                                setCaret();

                            });

                            editor.on('Redo', function(e) {
                                setCaret();

                            });

                        },
                        setup: function(editor) {

                            editor.on('init', function(e) {

                                editor.pasteAsPlainText = true;

                                var notePos = editWallet.find('#add-note').position().top;
                                var modalScroll = editWallet.find('.modal-body .os-viewport');
                                modalScroll.animate({
                                    scrollTop: notePos
                                });
                                
                                // Load CSS
                                this.dom.loadCSS('{{ asset("css/OverlayScrollbars.min.css") }}');

                                // Load JS
                                //var scriptLoader = new tinymce.dom.ScriptLoader();
                                //scriptLoader.add('{{ asset("js/jquery.min.js") }}');
                                //scriptLoader.add('{{ asset("js/jquery.overlayScrollbars.min.js") }}');
                                //scriptLoader.loadQueue();

                                // Get Body
                                var body = $(this.getBody());

                                editor.on('keydown', function(e) {
                                    
                                    modalScroll.scrollTop(notePos);

                                    var node = editor.selection.getNode(); // current caret node

                                    var nodePos = $(node).position().top;
                                    var scrollPos = body.find('.os-viewport').scrollTop();
                                    if((nodePos - scrollPos) > 108) {
                                        body.find('.os-viewport').scrollTop(scrollPos + 38);
                                    }

                                });

                                editor.on('keyup', function(e) {

                                    var node = editor.selection.getNode(); // current caret node

                                    // If CustomScroll Deleted
                                    if (e.keyCode == 8 || e.keyCode == 46) { // backspace and delete keycodes
                                        
                                        if($(node).index() == 0 && $(node).text().length == 0) {

                                            // Try CustomScroll
                                            var tryScroll = setInterval(function() {
                                                
                                                // Only if CustomScroll doesn't already exist
                                                if(body.find('.os-content').length == 0) {

                                                    // Load CSS
                                                    editor.dom.loadCSS('{{ asset("css/OverlayScrollbars.min.css") }}');

                                                    // Load JS
                                                    var scriptLoader = new tinymce.dom.ScriptLoader();
                                                    //scriptLoader.add('{{ asset("js/jquery.min.js") }}');
                                                    scriptLoader.add('{{ asset("js/jquery.overlayScrollbars.min.js") }}');
                                                    scriptLoader.loadQueue();

                                                    addCustomScroll(body);

                                                    // body.find('.os-viewport').scrollTop(nodePos - 38);

                                                    // Ensure cursor is not moved back to the beginning
                                                    editor.selection.select(editor.getBody(), true);
                                                    editor.selection.collapse(false);

                                                } else {

                                                    // If customScroll exists and setInterval active
                                                    if(tryScroll) {
                                                        clearInterval(tryScroll);
                                                    }

                                                }

                                                
                                            }, 2000);

                                            // If customScroll exists
                                            if(body.find('.os-content').length > 0) {
                                                clearInterval(tryScroll);
                                            }

                                        }

                                    }
                                });

                            });

                            
                        }
                    });
                    // tinymce end

                }
            });


            

        }).on('hidden.bs.modal', function() {

            editWallet.find('.modal').remove();

            if(typeof tryScroll !== 'undefined') {
                clearInterval(tryScroll);
            }

            if(editWallet.attr('edited')) {
                // Animate edited wallet
                editWallet.addClass('animate__animated animate__heartBeat').removeAttr('edited');
                
                // On animation complete
                editWallet.on('animationend', () => {
                    
                    editWallet.removeClass('animate__animated animate__heartBeat');

                    // Re-initialize CustomScroll
                    addCustomScroll(editWallet.find('.display-text'));
                    
                    // Initialize ShowNote
                    editWallet.find('.show-note').click();

                    setTimeout( function() {
                        editWallet.find('.note').click()
                        setTimeout(function() {
                            editWallet.find('.note').removeClass('bg-transparent');
                            editWallet.find('.note').find('.display-text').removeClass('bg-transparent text-transparent').find('*').removeClass('text-transparent');
                            editWallet.off();
                        }, 500)
                    }, 500);

                });

            }

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
                <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteWalletModalLabel">Delete Wallet</h5>
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


    /////////////////// WALLETS ///////////////////


    /////////////////// TRANSACTION ///////////////////

    $('.txn-btn').click(function(e) {
        e.preventDefault();
        // alert('clicked');

        var id = $(this).attr('data-id');
        var action = $(this).attr('data-action');
        var txnData = $(this).parents('tr');

        var cryptoAmount = txnData.attr('data-crypto-amount');
        var walletPlatform = txnData.attr('data-wallet-platform');
        var walletCurrency = txnData.attr('data-wallet-currency');
        var currencyName = txnData.attr('data-currency-name');
        var walletToken = txnData.attr('data-wallet-token');
        var walletAddress = txnData.attr('data-wallet-address');
        var cryptoReceipt = txnData.attr('data-crypto-receipt');

        var nairaEquivalent = txnData.attr('data-naira-equivalent');
        var bankName = txnData.attr('data-bank-name');
        var accountNumber = txnData.attr('data-account-number');
        var accountName = txnData.attr('data-account-name');

        var nairaAmount = txnData.attr('data-naira-amount');
        var nairaReceipt = txnData.attr('data-naira-receipt');

        var expiry = $(this).attr('data-expiry');

        var txnRef = $(this).attr('data-txn-ref');
        var txnStage = $(this).attr('data-txn-stage');
        var userName = txnData.attr('data-user-name');
        

        if(action == "crypto_wait") {
            txnData.append(`
                <div class="modal fade" id="cryptoWaitModal" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered modal-sm modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Verifying Cryptocurrency</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                We are currently verifying your cryptocurrency receipt. This shouldn't take long ...
                            </div>
                            <div class="modal-footer">
                                <!-- <button type="button" class="btn btn-danger">Cancel Transaction</button> -->
                                <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Okay</button> -->
                                <button type="button" class="btn btn-primary" data-dismiss="modal">Okay</button>
                            </div>
                        </div>
                    </div>
                </div>
            `);

            txnData.find('.modal').on('show.bs.modal', function() {

            }).on('hidden.bs.modal', function() {
                txnData.find('.modal').remove();

            }).modal('show');

            
        } else if(action == "crypto_contact_support") {
            txnData.append(`
                <div class="modal fade" id="cryptoSupportModal" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered modal-sm modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Contact Support</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Verifying your cryptocurrency is taking longer than usual. Kindly reach out to us on <a class="whatsapp-help" href="#" >WhatsApp</a>
                            </div>
                            <div class="modal-footer d-flex justify-content-between">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <a class="whatsapp-help text-success" href="#" ><i class="size-md lni-whatsapp"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            `);

            txnData.find('.modal').on('show.bs.modal', function() {
                
                $(this).find('.whatsapp-help').click(function(e) {
                    e.preventDefault();

                    var countryCode = '234';
                    var phoneNumber = '8081273542';
                    var text = `%2ASmartCoin%2A+Website%0D%0A%0D%0AName%3A+${userName}%0D%0A%0D%0ATxn+Ref%3A+${txnRef}%0D%0A%0D%0AStage%3A+${txnStage}%0D%0A%0D%0AMessage%3A+`;
                    window.open('https://wa.me/' + countryCode + phoneNumber + '?' + 'text=' + text, '_blank');
                });

            }).on('hidden.bs.modal', function() {
                txnData.find('.modal').remove();

            }).modal('show');

        } else if(action == "naira_contact_support") {
            txnData.append(`
                <div class="modal fade" id="nairaSupportModal" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered modal-sm modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Contact Support</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Processing your payment is taking longer than usual. Kindly reach out to us on <a class="whatsapp-help" href="#" >WhatsApp</a>
                            </div>
                            <div class="modal-footer d-flex justify-content-between">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <a class="whatsapp-help text-success" href="#" ><i class="size-md lni-whatsapp"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            `);

            txnData.find('.modal').on('show.bs.modal', function() {
                
                $(this).find('.whatsapp-help').click(function(e) {
                    e.preventDefault();

                    var countryCode = '234';
                    var phoneNumber = '8081273542';
                    var text = `%2ASmartCoin%2A+Website%0D%0A%0D%0AName%3A+${userName}%0D%0A%0D%0ATxn+Ref%3A+${txnRef}%0D%0A%0D%0AStage%3A+${txnStage}%0D%0A%0D%0AMessage%3A+`;
                    window.open('https://wa.me/' + countryCode + phoneNumber + '?' + 'text=' + text, '_blank');
                });

            }).on('hidden.bs.modal', function() {
                txnData.find('.modal').remove();

            }).modal('show');

        } else if(action == "review_crypto_receipt") {
            txnData.append(`
                <div class="modal fade" id="cryptoReceiptModal" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered modal-sm modal-dialog-scrollable">
                        <form method="POST" action="">
                            @csrf
                            {!! method_field('PUT') !!}
                            <input type="hidden" name="action" value="confirm_crypto">

                            <div class="modal-content d-block">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Confirm Cryptocurrency</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body text-center" style="max-height:332px;">
                                    <div class="sign-in-form-area wow fadeIn text-left" data-wow-duration="1s" data-wow-delay="0.4s">
                                        <span class="text-left text-ellipsis">
                                            <strong>$`+ cryptoAmount +`</strong> `+ currencyName +` was sent into `+ walletPlatform + ' ' + walletCurrency + ' ' + walletToken +` wallet address: <u>`+ walletAddress +`</u>
                                        </span>
                                        <div class="sign-in-form-wrapper form-style-two no-icon">
                                            <div class="form-input mt-4">
                                                <label class="d-flex justify-content-between">
                                                    <span class="d-flex align-items-end">Receipt</span>
                                                    <div class="light-rounded-buttons receipt-button" data-status="show">
                                                        <a href="#" class="main-btn light-rounded-two xs-btn text-none font-weight-normal d-flex align-items-center">
                                                            <i class="lni-licencse d-inline-block mr-2"></i>
                                                            <span>Show</span>
                                                        </a>
                                                    </div>
                                                </label>
                                                <div class="input-items default receipt-preview hidden" data-value="">
                                                    <img src="`+ cryptoReceipt +`" alt="" class="img-fluid w-100 field-border">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer d-flex justify-content-between">
                                    <button type="button" class="btn btn-danger">Reject</button>
                                    <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Okay</button> -->
                                    <button type="submit" class="btn btn-primary confirm_crypto">Confirm</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            `);

            txnData.find('.modal').on('show.bs.modal', function() {
                addCustomScroll(txnData.find('.modal-body'));

                var receiptBtn = $(this).find('.receipt-button');

                receiptBtn.click(function() {

                    var status = $(this).attr('data-status');
                    var receiptPreview = $(this).parents('.form-input').find('.receipt-preview');

                    if(status == 'show') {
                        // Loading animation
                        $(this).attr('class', 'light-rounded-buttons disabled');
                        $(this).html(`
                            <span class="disabled main-btn light-rounded-two xs-btn text-none font-weight-normal w-100 d-flex align-items-center">
                                <i class="lni-spinner lni-spin-effect my-1"></i>
                            </span>
                        `);

                        var receiptBtnPos = $(this).position().top;
                        receiptPreview.removeClass('hidden').parents('.modal-body .os-viewport').animate({
                            scrollTop: receiptBtnPos,
                        });

                        $(this).attr('class', 'light-rounded-buttons success-buttons disabled');
                        $(this).attr('data-status', '');
                        $(this).html(`
                            <span class="disabled main-btn success-two xs-btn text-none font-weight-normal w-100 d-flex align-items-center">
                                <i class="lni-check-mark-circle my-1"></i>
                            </span>
                        `);

                    } else {
                        $(this).attr('class', 'light-rounded-buttons');
                        $(this).attr('data-status', 'show');
                        $(this).html(`
                            <a href="#" class="main-btn light-rounded-two xs-btn text-none font-weight-normal w-100 d-flex align-items-center">
                                <i class="lni-licencse d-inline-block mr-2"></i>
                                <span>Show</span>
                            </a>
                        `);

                        receiptPreview.addClass('hidden');
                    }

                });

                $(this).find('form').submit(function(e) {
                    e.preventDefault();

                    $(this).find('.modal-footer button').attr('disabled', true);
                        $(this).find('.confirm_crypto').prepend(`<i class="lni-spinner lni-spin-effect"></i> `);

                        // Save to Database
                        $.ajax({
                            url: "/transaction/" + id,
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
                                    txnData.find('.modal-footer').remove();

                                    // Repace modal body
                                    txnData.find('.modal-body').html('<i class="lni-check-mark-circle text-success font-weight-bolder display-1"></i>');

                                    // Transaction data
                                    // var transaction = result.data;

                                    // Mark transaction as updated
                                    txnData.attr('updated', true);

                                } else { // If error container not empty [i.e error] 
                                    
                                    if(Array.isArray(result.error)) {
                                        // Errors List
                                        var errors = result.error;
                                        var errorList = [];
                                        errors.forEach(function(item) {
                                            errorList.push('<li>'+ item + '</li>');
                                        });

                                        // Error Alert Message List
                                        toastr.error('<ul class="multiple">' + errorList.join('') + '</ul>', 'Please check your input');

                                    } else {
                                        // Error Alert Message
                                        toastr.error(result.error);

                                    }
                                    

                                    // Remove loading animation
                                    txnData.find('.modal-footer button').removeAttr('disabled');
                                    txnData.find('.confirm_crypto').children('i.lni-spinner').remove();
                                    
                                }
                            },
                            error: function(xhr, status, error){ // On Ajax Error

                                // Error Alert Message
                                toastr.error(xhr.statusText, 'Error - ' + xhr.status);

                                // Remove loading animation
                                txnData.find('.modal-footer button').removeAttr('disabled');
                                txnData.find('.confirm_crypto').children('i.lni-spinner').remove();

                            }
                        }).fail(function() { toastr.error('Something went wrong') }); // On Ajax Fail

                });

            }).on('hidden.bs.modal', function() {
                txnData.find('.modal').remove();

                if(txnData.attr('updated')) {

                    // Change Review Receipt Button to Process Payment Button
                    txnData.find('.light-rounded-buttons').removeClass('info-buttons')
                    .find('.txn-btn').removeClass('info-two').addClass('light-rounded-two')
                    .attr('data-action', 'process_payment').html(`
                        <i class="lni-credit-cards d-inline-block mr-2"></i>
                        Process Payment
                    `);

                    txnData.find('td').last().prev().html(`
                        <span>Crypto Confirmed</span>
                    `).prev().html(`
                        <span>Just Now</span>
                    `);

                    // Animate updated transaction
                    txnData.addClass('animate__animated animate__flash').removeAttr('updated');
                    
                    // On animation complete
                    txnData.on('animationend', () => {
                        
                        txnData.removeClass('animate__animated animate__flash');
                        txnData.off();

                    });

                }

            }).modal('show');

        } else if(action == "payment_wait") {
            txnData.append(`
                <div class="modal fade" id="paymentWaitModal" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered modal-sm modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Processing Payment</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-2">We have received <strong>$`+ cryptoAmount +`</strong> `+ currencyName +` and will send <strong>&#8358;`+ nairaEquivalent +`</strong> into your account shortly ...</div>

                                <small>Bank Name</small>
                                <h5 class="mb-2">`+ bankName +`</h5>

                                <small>Account Number</small>
                                <h5 class="mb-2">`+ accountNumber +`</h5>

                                <small>Account Name</small>
                                <h5>`+ accountName +`</h5>
                            </div>
                            <div class="modal-footer">
                                <!-- <button type="button" class="btn btn-danger">Cancel Transaction</button> -->
                                <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Okay</button> -->
                                <button type="button" class="btn btn-primary" data-dismiss="modal">Okay</button>
                            </div>
                        </div>
                    </div>
                </div>
            `);

            txnData.find('.modal').on('show.bs.modal', function() {

            }).on('hidden.bs.modal', function() {
                txnData.find('.modal').remove();

            }).modal('show');

        } else if(action == "process_payment") {
            txnData.append(`
                <div class="modal fade" id="processPaymentModal" tabindex="-1" role="dialog">
                    <div class="modal-dialog modal-dialog-centered modal-sm modal-dialog-scrollable" role="document">
                        <form id="process" method="POST" action="" enctype="multipart/form-data">
                            @csrf
                            {!! method_field('PUT') !!}
                            <input type="hidden" name="action" value="send_naira">

                            <div class="modal-content d-block">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="passwordModalLabel">Process Payment</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body text-center" style="max-height:332px;">
                                    <div class="sign-in-form-area wow fadeIn text-left slick-container" data-wow-duration="1s" data-wow-delay="0.4s">
                                        <div class="sign-in-form-wrapper form-style-two no-icon">
                                            
                                            <small>Bank Name</small>
                                            <h5 class="mb-2">`+ bankName +`</h5>

                                            <small>Account Number</small>
                                            <h5 class="mb-2">`+ accountNumber +`</h5>

                                            <small>Account Name</small>
                                            <h5 class="mb-2">`+ accountName +`</h5>

                                            <div class="checkout-checkbox mt-4 pt-2 pb-0">
                                                <ul class="checkbox_common">
                                                    <li>
                                                        <input type="checkbox" id="checkbox1" name="naira_amount" value="`+ nairaEquivalent.replaceAll(',','') +`">
                                                        <label for="checkbox1"><span></span><strong>&#8358;`+ nairaEquivalent +`</strong> has been sent to the account details above:</label>
                                                    </li>
                                                </ul>
                                            </div>

                                        </div>

                                        <div class="sign-in-form-wrapper form-style-two receipt-container">
                                            <!-- <div class="form-input">
                                                <label>Amount Sent ($)</label>
                                                <div class="input-items default">
                                                    <input type="text" name="amount" placeholder="0.00" required>
                                                </div>
                                            </div> -->

                                            <div class="form-input hidden">
                                                <label>Upload Receipt</label>
                                                <div class="form-group">
                                                    <div class="fileinput fileinput-new w-100 mb-0" data-provides="fileinput">
                                                        <div class="fileinput-new thumbnail w-100 field-border">
                                                            <img src="{{ asset('img/ui/receipt.png') }}" class="img-fluid" alt="...">
                                                        </div>
                                                        <div class="fileinput-preview fileinput-exists thumbnail lh-0 field-border active"></div>
                                                        <div class="d-flex justify-content-between light-rounded-buttons danger-buttons">
                                                            <span class="btn-default btn-file light-rounded-buttons">
                                                                <span class="fileinput-new file-click left floated main-btn light-rounded-two xs-btn text-none font-weight-normal">Select Image</span>
                                                                <span class="fileinput-exists file-click left floated main-btn light-rounded-two hoverable xs-btn text-none font-weight-normal">Change</span>
                                                                <input name="naira_receipt" type="file" accept="image/*" />
                                                            </span>
                                                            <span class="fileinput-exists main-btn danger-two hoverable xs-btn text-none font-weight-normal" data-dismiss="fileinput">Remove</span>
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer d-flex justify-content-between regular-icon-buttons">
                                    <ul><li class="mt-0 slick-left hidden"><a href="#" class="regular-icon-light-ten d-flex align-items-center justify-content-center"><i class="lni-arrow-left font-weight-bolder"></i></a></li></ul>
                                    <button type="submit" class="btn btn-success slick-submit hidden">Submit</button>
                                    <span>---</span>
                                    <ul><li class="mt-0 slick-right hidden"><a href="#" class="regular-icon-light-ten d-flex align-items-center justify-content-center"><i class="lni-arrow-right font-weight-bolder"></i></a></li></ul>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            `);


            txnData.find('.modal').on('show.bs.modal', function() {
                addCustomScroll(txnData.find('.modal-body'));

                txnData.find('input:checkbox').change(function() {
                    if($(this).prop('checked')) {
                        txnData.find('.slick-right').removeClass('hidden');
                        txnData.find('.modal-footer>span').addClass('hidden');
                    } else {
                        txnData.find('.slick-right').addClass('hidden');
                        txnData.find('.modal-footer>span').removeClass('hidden');
                    }

                    // Make receipt container visible
                    txnData.find('.receipt-container').children().removeClass('hidden');
                        
                });


            }).on('shown.bs.modal', function() {

                txnData.find('.slick-container').slick({
                    infinite: false,
                    adaptiveHeight: true,
                    prevArrow: txnData.find('.slick-left'),
                    nextArrow: txnData.find('.slick-right'),
                    draggable: false,
                    swipe: false,
                    touchMove: false,
                });

                // Show Submit Button + Hide Next Button on Last Slide
                $(this).find('.slick-container').on('afterChange', function(event, slick, currentSlide) {
                    if (slick.$slides.length-1 == currentSlide) {
                        $('.slick-submit').removeClass('hidden');
                        $('.slick-right').parent().addClass('hidden');
                    } else {
                        $('.slick-submit').addClass('hidden');
                        $('.slick-right').parent().removeClass('hidden');
                    }
                });

                // Show Left Button from Second Slide
                $(this).find('.slick-container').on('afterChange', function(event, slick, currentSlide) {
                    if (currentSlide > 0) {
                        $('.slick-left').removeClass('hidden');
                    } else {
                        $('.slick-left').addClass('hidden');
                    }

                    // Scroll to the top after every change
                    txnData.find('.modal-body .os-viewport').animate({
                        scrollTop: 0,
                    });

                });
                
                $(this).find('.slick-container').on('beforeChange', function(event, slick, currentSlide, nextSlide) {
                    if(currentSlide == 0 && nextSlide == 1) {

                        // Save Initial Height
                        var initialHeight = $('input:file[name="naira_receipt"]').parents('.slick-slide').height();

                        // Adjust Height on Select / Change Receipt
                        $('input:file[name="naira_receipt"]').change(function() {

                            // The node to be monitored
                            var target = $(this).parents('.fileinput').find('.fileinput-preview')[0];

                            // Create an observer instance
                            var observer = new MutationObserver(function( mutations, observer ) {
                                mutations.forEach(function( mutation ) {
                                    var boxHeight = $('.fileinput-preview').parents('.slick-slide').height();
                                    $(target).parents('.slick-list').attr('style', 'height: '+ boxHeight + 'px');

                                    var btn = $(target).parents('.fileinput').find('[data-dismiss="fileinput"]');
                                    var btnPos = btn.position().top;

                                    $(target).parents('.modal-body .os-viewport').animate({
                                        scrollTop: btnPos,
                                    });

                                    // Later, you can stop observing
                                    observer.disconnect();

                                    btn.click(function() {
                                        $(this).parents('.slick-list').attr('style', 'height: '+ initialHeight + 'px');
                                    });

                                });

                                
                            });

                            // Configuration of the observer:
                            var config = { 
                                childList: true, 
                            };
                            
                            // Pass in the target node, as well as the observer options
                            observer.observe(target, config);

                        });
                    }
                });
                

                // Jasny File Upload
                $('.file-click').click(function() {
                    $(this).siblings('input[type="file"]').click();
                });


                $(this).find('form').submit(function(e) {
                    e.preventDefault();

                    if($(this).find('input:file')[0].files.length == 0) {
                        toastr.error('Please select an image');

                    } else {
                        $(this).find('.slick-left').addClass('hidden');
                        $(this).find('button.slick-submit').attr('disabled', true).prepend(`<i class="lni-spinner lni-spin-effect"></i> `);
                        
                        $.ajax({
                            url: "/transaction/" + id,
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
                                    txnData.find('.modal-footer').remove();

                                    // Repace modal body
                                    txnData.find('.modal-body').html('<i class="lni-check-mark-circle text-success font-weight-bolder display-1"></i>');

                                    // Mark transaction as updated
                                    txnData.attr('updated', true);
                                    
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
                                    txnData.find('button.slick-submit').removeAttr('disabled').children('i.lni-spinner').remove();
                                    txnData.find('.slick-left').removeClass('hidden');
                                }
                            },
                            error: function(xhr, status, error){ // On Ajax Error

                                // Error Alert Message
                                toastr.error(xhr.statusText, 'Error - ' + xhr.status);

                                // Remove loading animation
                                txnData.find('button.slick-submit').removeAttr('disabled').children('i.lni-spinner').remove();
                                txnData.find('.slick-left').removeClass('hidden');
                                
                            }

                        }).fail(function() { toastr.error('Something went wrong') }); // On Ajax Fail


                        // $(this).unbind('submit');

                    }



                });

            }).on('hidden.bs.modal', function() {

                txnData.find('.slick-container').slick('unslick'); // Destroy Slide. Will be initialized on Modal Show
                txnData.find('.slick-left').addClass('disabled'); // Disable Prev Button
                txnData.find('.slick-right').removeClass('disabled'); // Enable Next Button

                txnData.find('.modal').remove();

                if(txnData.attr('updated')) {

                    // Change Process Payment Button to Please wait... Button (6 Hours)
                    txnData.find('.txn-btn').attr('data-action', 'naira_wait').html(`
                        <i class="lni-spinner lni-spin-effect mr-2"></i>
                        Please wait ...&nbsp;<span class="countdown-timer" data-hh="" data-mm="" data-ss="">00:00</span>
                    `);

                    // Trigger countdown
                    countdownTimer(txnData.find('.countdown-timer'), 21600*1000);

                    txnData.find('td').last().prev().html(`
                        <span>Verifying Payment</span>
                    `).prev().html(`
                        <span>Just Now</span>
                    `);

                    // Animate updated transaction
                    txnData.addClass('animate__animated animate__flash').removeAttr('updated');

                    // On animation complete
                    txnData.on('animationend', () => {
                        
                        txnData.removeClass('animate__animated animate__flash');
                        txnData.off();

                    });

                }

                    
            }).modal('show');

        } else if(action == "naira_wait") {
            txnData.append(`
                <div class="modal fade" id="nairaWaitModal" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered modal-sm modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Verifying Payment</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                The customer is currently verifying our payment. This shouldn't take long ...
                            </div>
                            <div class="modal-footer">
                                <!-- <button type="button" class="btn btn-danger">Cancel Transaction</button> -->
                                <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Okay</button> -->
                                <button type="button" class="btn btn-primary" data-dismiss="modal">Okay</button>
                            </div>
                        </div>
                    </div>
                </div>
            `);

            txnData.find('.modal').on('show.bs.modal', function() {

            }).on('hidden.bs.modal', function() {
                txnData.find('.modal').remove();

            }).modal('show');
        } else if(action == "review_naira_receipt") {
            txnData.append(`
                <div class="modal fade" id="nairaReceiptModal" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered modal-sm modal-dialog-scrollable">
                        <form method="POST" action="">
                            @csrf
                            {!! method_field('PUT') !!}
                            <input type="hidden" name="action" value="confirm_naira">

                            <div class="modal-content d-block">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Payment Completed</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body text-center" style="max-height:332px;">
                                    <div class="sign-in-form-area wow fadeIn text-left" data-wow-duration="1s" data-wow-delay="0.4s">
                                        <span class="text-left text-ellipsis">
                                            We have sent <strong>&#8358;`+ nairaAmount +`</strong> into `+ accountName +`'s `+ bankName +` account number: <u>`+ accountNumber +`</u>
                                        </span>
                                        <div class="sign-in-form-wrapper form-style-two no-icon">
                                            <div class="form-input mt-4">
                                                <label class="d-flex justify-content-between">
                                                    <span class="d-flex align-items-end">Receipt</span>
                                                    <div class="light-rounded-buttons receipt-button" data-status="show">
                                                        <a href="#" class="main-btn light-rounded-two xs-btn text-none font-weight-normal d-flex align-items-center">
                                                            <i class="lni-licencse d-inline-block mr-2"></i>
                                                            <span>Show</span>
                                                        </a>
                                                    </div>
                                                </label>
                                                <div class="input-items default receipt-preview hidden" data-value="">
                                                    <img src="`+ nairaReceipt +`" alt="" class="img-fluid w-100 field-border">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer d-flex justify-content-between">
                                    `+
                                    ((expiry > 0) ?
                                    '<button type="button" class="btn btn-secondary" data-dismiss="modal">Wait</button>'
                                    :
                                    '<button type="button" class="btn btn-warning text-white">Contact Support</button>')
                                    +`
                                    <button type="submit" class="btn btn-success confirm_naira">Confirm</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            `);

            txnData.find('.modal').on('show.bs.modal', function() {
                addCustomScroll(txnData.find('.modal-body'));

                var receiptBtn = $(this).find('.receipt-button');

                receiptBtn.click(function() {

                    var status = $(this).attr('data-status');
                    var receiptPreview = $(this).parents('.form-input').find('.receipt-preview');

                    if(status == 'show') {
                        // Loading animation
                        $(this).attr('class', 'light-rounded-buttons disabled');
                        $(this).html(`
                            <span class="disabled main-btn light-rounded-two xs-btn text-none font-weight-normal w-100 d-flex align-items-center">
                                <i class="lni-spinner lni-spin-effect my-1"></i>
                            </span>
                        `);

                        var receiptBtnPos = $(this).position().top;
                        receiptPreview.removeClass('hidden').parents('.modal-body .os-viewport').animate({
                            scrollTop: receiptBtnPos,
                        });

                        $(this).attr('class', 'light-rounded-buttons success-buttons disabled');
                        $(this).attr('data-status', '');
                        $(this).html(`
                            <span class="disabled main-btn success-two xs-btn text-none font-weight-normal w-100 d-flex align-items-center">
                                <i class="lni-check-mark-circle my-1"></i>
                            </span>
                        `);

                    } else {
                        $(this).attr('class', 'light-rounded-buttons');
                        $(this).attr('data-status', 'show');
                        $(this).html(`
                            <a href="#" class="main-btn light-rounded-two xs-btn text-none font-weight-normal w-100 d-flex align-items-center">
                                <i class="lni-licencse d-inline-block mr-2"></i>
                                <span>Show</span>
                            </a>
                        `);

                        receiptPreview.addClass('hidden');
                    }

                });

                $(this).find('form').submit(function(e) {
                    e.preventDefault();

                    $(this).find('.modal-footer button').attr('disabled', true);
                        $(this).find('.confirm_naira').prepend(`<i class="lni-spinner lni-spin-effect"></i> `);

                        // Save to Database
                        $.ajax({
                            url: "/transaction/" + id,
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
                                    txnData.find('.modal-footer').remove();

                                    // Repace modal body
                                    txnData.find('.modal-body').html('<i class="lni-check-mark-circle text-success font-weight-bolder display-1"></i>');

                                    // Transaction data
                                    // var transaction = result.data;

                                    // Mark transaction as updated
                                    txnData.attr('updated', true);

                                } else { // If error container not empty [i.e error] 
                                    
                                    if(Array.isArray(result.error)) {
                                        // Errors List
                                        var errors = result.error;
                                        var errorList = [];
                                        errors.forEach(function(item) {
                                            errorList.push('<li>'+ item + '</li>');
                                        });

                                        // Error Alert Message List
                                        toastr.error('<ul class="multiple">' + errorList.join('') + '</ul>', 'Please check your input');

                                    } else {
                                        // Error Alert Message
                                        toastr.error(result.error);

                                    }
                                    

                                    // Remove loading animation
                                    txnData.find('.modal-footer button').removeAttr('disabled');
                                    txnData.find('.confirm_naira').children('i.lni-spinner').remove();
                                    
                                }
                            },
                            error: function(xhr, status, error){ // On Ajax Error

                                // Error Alert Message
                                toastr.error(xhr.statusText, 'Error - ' + xhr.status);

                                // Remove loading animation
                                txnData.find('.modal-footer button').removeAttr('disabled');
                                txnData.find('.confirm_crypto').children('i.lni-spinner').remove();

                            }
                        }).fail(function() { toastr.error('Something went wrong') }); // On Ajax Fail

                });

            }).on('hidden.bs.modal', function() {
                txnData.find('.modal').remove();

                if(txnData.attr('updated')) {

                    // Change Review Naira Receipt Button to No Action Required (Exchange Complete)
                    txnData.find('.light-rounded-buttons').parents('td').html(`
                        <span>---</span>
                    `).addClass('text-center');

                    txnData.find('td').last().prev().html(`
                        <span>Exchange Complete</span>
                    `).prev().html(`
                        <span>Just Now</span>
                    `);

                    // Animate updated transaction
                    txnData.addClass('animate__animated animate__flash').removeAttr('updated');
                    
                    // On animation complete
                    txnData.on('animationend', () => {
                        
                        txnData.removeClass('animate__animated animate__flash');
                        txnData.off();

                    });

                }

            }).modal('show');
        }
    });




    // Verifying Receipt
    // Show Receipt [Crypto / Naira]
    // $('.receiptModal, .nairaReceivedModal').on('show.bs.modal', function() {

    //     addCustomScroll($(this).find('.modal-body'));

    //     $(this).find('.receipt-button').click(function() {

    //         var status = $(this).attr('data-status');
    //         var receiptPreview = $(this).parents('.form-input').find('.receipt-preview');

    //         if(status == 'show') {
    //             $(this).attr('class', 'light-rounded-buttons success-buttons disabled');
    //             $(this).attr('data-status', '');
    //             $(this).html(`
    //                 <span class="disabled main-btn success-two xs-btn text-none font-weight-normal w-100 d-flex align-items-center">
    //                     <i class="lni-check-mark-circle my-1"></i>
    //                 </span>
    //             `);

    //             var receiptBtnPos = $(this).position().top;
    //             receiptPreview.removeClass('hidden').parents('.modal-body .os-viewport').animate({
    //                 scrollTop: receiptBtnPos,
    //             });

    //         } else {
    //             $(this).attr('class', 'light-rounded-buttons');
    //             $(this).attr('data-status', 'show');
    //             $(this).html(`
    //                 <a href="#" class="main-btn light-rounded-two xs-btn text-none font-weight-normal w-100 d-flex align-items-center">
    //                     <i class="lni-licencse d-inline-block mr-2"></i>
    //                     <span>Show</span>
    //                 </a>
    //             `);

    //             receiptPreview.addClass('hidden');
    //         }

    //     });

    // });


    // // Confirm Crypto
    // $('.txn_update').click(function() {

    // });


    

    

@endsection