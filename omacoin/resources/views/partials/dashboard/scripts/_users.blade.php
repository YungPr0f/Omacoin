// Create User
$('#create-user').click(function(e) {
    e.preventDefault();
    
    var createUser = $(this).parent();
    createUser.append(`
        <div class="modal fade" id="createUserModal" tabindex="-1" role="dialog">
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

                                    <!-- <div class="custom-dropdown form-input">
                                        <div class="input-items default" style="height:44px">
                                            <select name="role" class="required no-search" required tabindex="-1">
                                                <option disabled selected data-display="Role">Role</option>
                                                <option value="admin">Admin</option>
                                                <option value="superadmin">Superadmin</option>
                                            </select>
                                        </div>
                                    </div> -->

                                    <!-- <div class="form-input mt-4">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                                            <label class="form-check-label mb-0" for="inlineRadio2">Admin</label>
                                        </div>
                                        <div class="form-check form-check-inline mr-0">
                                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="option3" disabled>
                                            <label class="form-check-label mb-0" for="inlineRadio3">Superadmin</label>
                                        </div>
                                    </div> -->


                                    <div class="single-checkout-pro form-style-two">
                                        <div class="checkout-radio d-flex justify-content-between">
                                            <!-- <div class="pay-top sin-payment d-flex align-items-center">
                                                <input id="member" type="radio" value="member" checked="checked" name="role">
                                                <label for="member"> <span></span>Member</label>
                                            </div> -->
                                            <div class="pay-top sin-payment d-flex align-items-center">
                                                <input id="admin" type="radio" value="admin" name="role" checked="checked">
                                                <label for="admin"> <span></span>Admin</label>
                                            </div> 
                                            <div class="pay-top sin-payment d-flex align-items-center">
                                                <input id="superadmin" type="radio" value="superadmin" name="role">
                                                <label for="superadmin"> <span></span>Superadmin</label>
                                            </div>                                 
                                        </div> <!-- checkout radio -->   
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
    
                                    <!-- <div class="form-input mt-4">
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
                                    </div> -->

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
    
    createUser.find('.modal').on('show.bs.modal', function() {

        addCustomScroll(createUser.find('.modal-body'));

        createUser.find('select').niceSelect();
        createUser.find('.nice-select.no-search .nice-select-search-box').remove();
        createUser.find('.nice-select.no-search ul.list').addClass('pt-0');
        

        $(this).find('form').submit(function(e) {
            e.preventDefault();

            // var role = createUser.find('select[name="role"]').val();
            var role = createUser.find('input[name="role"]:checked').val();

            if(role == null) {
                toastr.error('Please select a role');

            } else {
                var pwd = generatePassword();

                var formData = new FormData(this);

                formData.append('password', pwd);
                formData.append('password_confirmation', pwd);


                $(this).find('.modal-footer button').attr('disabled', true);
                $(this).find('.create').prepend(`<i class="lni-spinner lni-spin-effect"></i> `);

                // Save to Database
                $.ajax({
                    url: "{{ route('register') }}",
                    method: "POST",
                    data: formData,
                    contentType: false,
                    cache: false,
                    processData: false,
                    success:function(result) { // On Ajax Success

                        if($.isEmptyObject(result.error)) { // If the error container is empty [i.e. success]

                            // Success Alert Message
                            toastr.success(result.success);

                            // Remove modal footer
                            createUser.find('.modal-footer').remove();

                            // Repace modal body
                            createUser.find('.modal-body').html('<i class="lni-check-mark-circle text-success font-weight-bolder display-1"></i>');

                            // Prepare clone for insert
                            var user = result.data;

                            var usersTable = $('.users-table');

                            var cloneUser = usersTable.find('.dummy.user-row').clone(true)
                            .insertBefore(usersTable.find('.user-row').first());

                            cloneUser.removeClass('dummy').attr('cloned', true);
                            
                            cloneUser.find('.user-id').text(user.id.toString().padStart(6, '0'));

                            if(user.role == 'admin') {
                                cloneUser.find('.role-icon').addClass('lni-star');

                            } else if(user.role == 'superadmin') {
                                cloneUser.find('.role-icon').addClass('lni-crown');

                            } else {
                                cloneUser.find('.role-icon').addClass('lni-user');

                            }

                            cloneUser.find('.role').text(capitalise(user.role));

                            cloneUser.find('.name').text(user.surname + ' ' + user.firstname);

                            cloneUser.find('.admin-edit').attr({
                                'data-id' : user.id,
                                'data-name' : user.surname + ' ' + user.firstname,
                                'data-role' : user.role,
                            });

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
                            createUser.find('.modal-footer button').removeAttr('disabled');
                            createUser.find('.create').children('i.lni-spinner').remove();
                            
                        }
                    },
                    error: function(xhr, status, error){ // On Ajax Error

                        // Error Alert Message
                        toastr.error(xhr.statusText, 'Error - ' + xhr.status);

                        // Remove loading animation
                        createUser.find('.modal-footer button').removeAttr('disabled');
                        createUser.find('.create').children('i.lni-spinner').remove();

                    }
                }).fail(function() { toastr.error('Something went wrong') }); // On Ajax Fail


                // Unbind Submit Function to Remove Loop
                // $(this).unbind('submit');

            }
            

        });

    }).on('hidden.bs.modal', function() {
        createUser.find('.modal').remove();

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

            // Update Users count
            var role = clonedUser.find('.role').text().toLowerCase();

            var countBox = $('.' + role + '-count');
            var userCount = parseInt(countBox.text());

            countBox.text(userCount + 1).addClass('animate__animated animate__flash');

            // On animation complete
            countBox.on('animationend', () => {
                countBox.removeClass('animate__animated animate__flash');

            });

        });

        $('.grid-3').isotope('layout');

    }).modal('show');
});


// Edit Admin
$('.admin-edit').click(function(e) {
    e.preventDefault();
    
    var editAdmin = $(this).parents('.user-row');

    var id = $(this).attr('data-id');
    var name = $(this).attr('data-name');
    var role = $(this).attr('data-role');

    if(id == '{{ Auth::id() }}') {
        toastr.error('You cannot edit your own role');

    } else {
        editAdmin.append(`
            <div class="modal fade" id="editAdminModal" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-dialog-centered modal-sm modal-dialog-scrollable" role="document">
                    <form method="POST" action="">
                        @csrf
                        {!! method_field('PUT') !!}
                        <input type="hidden" name="type" value="update">
                        
                        <div class="modal-content d-block">
                            <div class="modal-header">
                                <h5 class="modal-title" id="passwordModalLabel">Edit Administrator</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body text-center" style="max-height:332px;">
                                <div class="sign-in-form-area wow fadeIn text-left" data-wow-duration="1s" data-wow-delay="0.4s">
                                    <div class="sign-in-form-wrapper form-style-two no-icon">

                                        <!-- <div class="custom-dropdown form-input">
                                            <label>Role</label>
                                            <div class="input-items default" style="height:44px">
                                                <select name="role" class="required no-search" required tabindex="-1">
                                                    <option value="disable">Disable</option>
                                                    <option `+ (role == 'admin' ? 'selected' : '') +` value="admin">Admin</option>
                                                    <option `+ (role == 'superadmin' ? 'selected' : '') +`  value="superadmin">Superadmin</option>
                                                </select>
                                            </div>
                                        </div> -->

                                        

                                        <div class="single-checkout-pro form-style-two">
                                            <label>Role</label>
                                            <div class="checkout-radio d-flex justify-content-between">
                                                <div class="pay-top sin-payment d-flex align-items-center">
                                                    <input id="admin" type="radio" value="admin" name="role" `+ (role == 'admin' ? ' checked="checked"' : '') +`>
                                                    <label for="admin"> <span></span>Admin</label>
                                                </div> 
                                                <div class="pay-top sin-payment d-flex align-items-center">
                                                    <input id="superadmin" type="radio" value="superadmin" name="role" `+ (role == 'superadmin' ? ' checked="checked"' : '') +`>
                                                    <label for="superadmin"> <span></span>Superadmin</label>
                                                </div>
                                                <div class="pay-top sin-payment d-flex align-items-center">
                                                    <input id="disable" type="radio" value="disable" name="role" `+ (!role ? 'checked="checked"' : '') +`>
                                                    <label for="disable" class="text-danger"> <span></span>Disable</label>
                                                </div>                               
                                            </div> <!-- checkout radio -->   
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer d-flex justify-content-between">
                                <button type="button" class="btn btn-danger cancel" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-success save">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        `);

        editAdmin.find('.modal').on('show.bs.modal', function() {

            $(this).find('form').submit(function(e) {
                e.preventDefault();

                $(this).find('.modal-footer button').attr('disabled', true);
                $(this).find('.save').prepend(`<i class="lni-spinner lni-spin-effect"></i> `);

                // Save to Database
                $.ajax({
                    url: "/role_edit/" + id,
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
                            editAdmin.find('.modal-footer').remove();

                            // Repace modal body
                            editAdmin.find('.modal-body').html('<i class="lni-check-mark-circle text-success font-weight-bolder display-1"></i>');

                            // Admin data
                            var admin = result.data;

                            // Mark admin as edited
                            editAdmin.attr('edited', true);

                            editAdmin.find('.admin-edit').attr({
                                'data-role' : admin.role,
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
                            editAdmin.find('.modal-footer button').removeAttr('disabled');
                            editAdmin.find('.save').children('i.lni-spinner').remove();
                            
                        }
                    },
                    error: function(xhr, status, error){ // On Ajax Error

                        // Error Alert Message
                        toastr.error(xhr.statusText, 'Error - ' + xhr.status);

                        // Remove loading animation
                        editAdmin.find('.modal-footer button').removeAttr('disabled');
                        editAdmin.find('.save').children('i.lni-spinner').remove();

                    }
                }).fail(function() { toastr.error('Something went wrong') }); // On Ajax Fail


            });

        }).on('hidden.bs.modal', function() {

            editAdmin.find('.modal').remove();

            if(editAdmin.attr('edited')) {
                
                // Update Role
                var newRole = editAdmin.find('.admin-edit').attr('data-role');
                if(newRole) {
                    editAdmin.find('.role').removeClass('text-danger').text(capitalise(newRole));
                    if(newRole == 'admin') {
                        editAdmin.find('.role-icon').removeClass('lni-crown lni-close lni-user').addClass('lni-star');

                    } else if(newRole == 'superadmin') {
                        editAdmin.find('.role-icon').removeClass('lni-crown lni-close lni-user').addClass('lni-crown');

                    }

                } else {
                    editAdmin.find('.role').addClass('text-danger').text('Disabled');
                    editAdmin.find('.role-icon').removeClass('lni-crown lni-star lni-user').addClass('lni-close');

                }
                

                // Animate edited user
                editAdmin.find('.role').addClass('animate__animated animate__heartBeat').removeAttr('edited');
                
                // On animation complete
                editAdmin.find('.role').on('animationend', () => {
                    editAdmin.find('.role').removeClass('animate__animated animate__heartBeat');

                });


                // Update Users count
                var countBox = $('.' + role + '-count');
                var userCount = parseInt(countBox.text());
                countBox.text(userCount - 1).addClass('animate__animated animate__flash');

                var countBox = $('.' + newRole + '-count');
                var userCount = parseInt(countBox.text());
                countBox.text(userCount + 1).addClass('animate__animated animate__flash');

                // On animation complete
                countBox.on('animationend', () => {
                    countBox.removeClass('animate__animated animate__flash');

                });

                


            }

            $('.grid-3').isotope('layout');
            

        }).modal('show');

    }

});