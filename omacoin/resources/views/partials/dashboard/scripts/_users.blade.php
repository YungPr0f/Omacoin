// Create Admin
$('#create-admin').click(function(e) {
    e.preventDefault();
    
    var createAdmin = $(this).parent();
    createAdmin.append(`
        <div class="modal fade" id="createAdminModal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-sm modal-dialog-scrollable" role="document">
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="modal-content d-block">
                        <div class="modal-header">
                            <h5 class="modal-title" id="passwordModalLabel">Create Administrator</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body text-center" style="max-height:332px;">
                            <div class="sign-in-form-area wow fadeIn text-left" data-wow-duration="1s" data-wow-delay="0.4s">
                                <div class="sign-in-form-wrapper form-style-two no-icon">

                                    <div class="custom-dropdown form-input">
                                        <div class="input-items default" style="height:44px">
                                            <select name="role" class="required no-search" required tabindex="-1">
                                                <option disabled selected data-display="Role ...">Role ...</option>
                                                <option value="admin">Admin</option>
                                                <option value="superadmin">Superadmin</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-input mt-4">
                                        <div class="input-items default">
                                            <input type="text" id="surname" name="surname" placeholder="Surname" value="{{ old('surname') }}" required autofocus>
                                            <i class="lni-user"></i>
                                        </div>
                                    </div>

                                    <div class="form-input mt-4">
                                        <div class="input-items default">
                                            <input type="text" id="firstname" name="firstname" placeholder="First Name" value="{{ old('firstname') }}" required autofocus>
                                            <i class="lni-user"></i>
                                        </div>
                                    </div>

                                    <div class="form-input mt-4">
                                        <div class="input-items default">
                                            <input id="email" type="email" placeholder="Email" name="email" value="{{ old('email') }}" required>
                                            <i class="lni-envelope"></i>
                                        </div>
                                    </div>

                                    <div class="form-input mt-4">
                                        <div class="input-items default">
                                            <input id="phone_number" type="text" placeholder="Phone Number" name="phone_number" value="{{ old('phone_number') }}">
                                            <i class="lni-phone-handset"></i>
                                        </div>
                                    </div>
    
                                    <div class="form-input mt-4">
                                        <div class="input-items default">
                                            <input id="password" type="password" placeholder="Password" name="password" required autocomplete="new-password">
                                            <i class="lni-key"></i>
                                        </div>
                                    </div>

                                    <div class="form-input mt-4">
                                        <div class="input-items default">
                                            <input id="password_confirmation" type="password" placeholder="Confirm Password" name="password_confirmation" required>
                                            <i class="lni-key"></i>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="modal-footer d-flex justify-content-between">
                            <button type="button" class="btn btn-danger cancel" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-success create">Create</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    `);
    
    createAdmin.find('.modal').on('show.bs.modal', function() {

        addCustomScroll(createAdmin.find('.modal-body'));

        createAdmin.find('select').niceSelect();
        createAdmin.find('.nice-select.no-search .nice-select-search-box').remove();
        createAdmin.find('.nice-select.no-search ul.list').addClass('pt-0');
        

        $(this).find('form').submit(function(e) {
            e.preventDefault();

            $(this).find('.modal-footer button').attr('disabled', true);
            $(this).find('.create').prepend(`<i class="lni-spinner lni-spin-effect"></i> `);

            // Save to Database
            $.ajax({
                url: "{{ route('register') }}",
                method: "POST",
                headers: {          
                    Accept: "application/json", 
                },
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success:function(result) { // On Ajax Success

                    if($.isEmptyObject(result.error)) { // If the error container is empty [i.e. success]

                        // Success Alert Message
                        toastr.success(result.success);

                        // Remove modal footer
                        createAdmin.find('.modal-footer').remove();

                        // Repace modal body
                        createAdmin.find('.modal-body').html('<i class="lni-check-mark-circle text-success font-weight-bolder display-1"></i>');

                        // Prepare clone for insert
                        var user = result.data;

                        var usersTable = $('.users-table');

                        var cloneUser = usersTable.find('.dummy.user-row').clone(true)
                        .insertBefore(usersTable.find('.user-row').first());

                        cloneUser.removeClass('dummy').attr('cloned', true);
                        
                        cloneUser.find('.user-id').text(user.id);

                        if(user.role == 'admin') {
                            cloneUser.find('.role-icon').addClass('lni-star');

                        } else if(user.role == 'superadmin') {
                            cloneUser.find('.role-icon').addClass('lni-crown');

                        } else {
                            cloneUser.find('.role-icon').addClass('lni-user');

                        }

                        cloneUser.find('.role').text(user.role);

                        cloneUser.find('.name').text(user.surname + ' ' + user.firstname)

                        cloneUser.insertBefore(usersTable.find('.user-row').first());

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
                        createAdmin.find('.modal-footer button').removeAttr('disabled');
                        createAdmin.find('.create').children('i.lni-spinner').remove();
                        
                    }
                },
                error: function(xhr, status, error){ // On Ajax Error

                    // Error Alert Message
                    toastr.error(xhr.statusText, 'Error - ' + xhr.status);

                    // Remove loading animation
                    createAdmin.find('.modal-footer button').removeAttr('disabled');
                    createAdmin.find('.create').children('i.lni-spinner').remove();

                }
            }).fail(function() { toastr.error('Something went wrong') }); // On Ajax Fail


            // Unbind Submit Function to Remove Loop
            // $(this).unbind('submit');

        });

    }).on('hidden.bs.modal', function() {
        createAdmin.find('.modal').remove();

        if(typeof tryScroll !== 'undefined') {
            clearInterval(tryScroll);
        }

        // Show cloned wallet
        var clonedUser = $('.user-row[cloned]');
        clonedUser.removeClass('hidden');
        clonedUser.addClass('animate__animated animate__bounceIn').removeAttr('cloned');
        
        // On animation complete
        clonedUser.on('animationend', () => {
            clonedUser.removeClass('animate__animated animate__bounceIn');

        });

        $('.grid-3').isotope('layout');

    }).modal('show');
});