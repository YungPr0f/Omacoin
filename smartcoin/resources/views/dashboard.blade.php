@extends('layouts.master')

@section('extra_links')
    <link rel="stylesheet" href="{{ asset('css/material-kit.css') }}">
@endsection

@section('title', 'SmartCoin | ' . (Auth::user()->role == 'admin' ? 'Admin Panel' : 'My Dashboard') )

@section('content')

    <section class="portfolio-area portfolio-three pb-100 pt-50 mt-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="portfolio-menu-3 text-center">
                        <ul class="nav nav-justified">
                            <li data-filter=".profile" class="nav-item active">PROFILE</li>
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
                <div class="col-12 profile">
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

@endsection


@section('custom_script')

    // Show only first filter on load NOT All
    var firstLi = $('.portfolio-menu-3').find('li').first();
    var dataFilter = firstLi.attr('data-filter');

    $('.grid-3').isotope({
        filter: dataFilter
    }).children().removeClass('d-none');

    $('.grid-3 [data-toggle="collapse"]').click(function () {
        var id = $(this).attr('href');

        $(id).on('shown.bs.collapse hidden.bs.collapse', function() {
            $('.grid-3').isotope('layout');
            
        });
    });

    // Adjust Accordion to fit Bank Name Dropdown
    $(document).on('click.nice-select', '.nice-select', function() {

        //Adjust Accordion Height
        function adjustHeight() {

            var list = $('.nice-select');
            var container = list.parents('.collapse');
            var card = container.children('.card-body');

            var listBottom = list.offset().top + list.height();
            var containerBottom = container.offset().top + container.height();
            var cardBottom = card.offset().top + card.height();

            if($('.nice-select').hasClass('open')) {

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

            }).fail(function() { toastr.error('Something Went Wrong') }); // On Ajax Fail


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
                }).fail(function() { toastr.error('Something Went Wrong') }); // On Ajax Fail

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
                }).fail(function() { toastr.error('Something Went Wrong') }); // On Ajax Fail

                // Unbind Submit Function to Remove Loop
                // $(this).unbind('submit');

            });

        }).on('hidden.bs.modal', function() {
           field.find('.modal').remove();

        }).modal('show');

    });

@endsection