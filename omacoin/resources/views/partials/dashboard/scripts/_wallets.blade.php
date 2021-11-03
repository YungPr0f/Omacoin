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
                                        <div class="custom-dropdown form-input mt-4 col-7 pr-2 pl-0">
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

                                        <div class="custom-dropdown form-input mt-4 col-5 pl-2 pr-0">
                                            <label>Network</label>
                                            <div class="input-items default" style="height:44px">
                                                <select name="network" class="no-search" tabindex="-1">
                                                    <option disabled selected data-display="Select ...">Select ...</option>
                                                    @foreach($networks as $network)
                                                    <option value="{{ $network }}">{{ $network }}</option>
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
                        <div class="modal-footer d-flex justify-content-between">
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
                    
                    // if(WAValidator.validate(address, currency)) { // issue with currency validation
                    if(true) {

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

                // if(WAValidator.validate(address, currency)) { // issue with currency validation
                if(true) {

                    var formData = new FormData(this);

                    // for (var pair of formData.entries()) {
                    //     console.log(pair[0]+ ', ' + pair[1]); 
                    // }

                    // Trigger Save on Tinymce
                    tinymce.triggerSave();

                    // for (var pair of formData.entries()) {
                    //     console.log(pair[0]+ ', ' + pair[1]); 
                    // }

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

                                if(wallet.network) {
                                    cloneWallet.find('.network').text(wallet.network);

                                } else {
                                    cloneWallet.find('.network').text('N/A').addClass('bg-0 text-transparent');

                                }
                                
                                cloneWallet.find('.rate').text(Math.round(wallet.rate));
                                cloneWallet.find('img.icon').attr('src', "{{ asset('img/currencies/') }}" + '/' + wallet.icon);
                                cloneWallet.find('input.address').val(wallet.address);
                                
                                cloneWallet.find('.copy').attr({
                                    'data-toggle': 'tooltip',
                                    'title': 'Copy'
                                }).tooltip();

                                cloneWallet.find('label.switch, .wallet-edit, .wallet-delete').attr('data-id', wallet.id);
                                cloneWallet.find('label.switch, .wallet-delete').attr('data-name', wallet.platform + ' ' + wallet.currency + ' ' + (wallet.network ?? ''));

                                cloneWallet.find('.wallet-edit').attr({
                                    'data-platform' : wallet.platform,
                                    'data-currency' : wallet.currency,
                                    'data-network' : (wallet.network ?? ''),
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

            $('.wallets-container').find('.preloader').delay(1000).fadeOut(500);
        }, 500);

        executed = true;
    }

}

// Activate or Deactivate Wallet
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
            <div class="modal-dialog modal-dialog-centered modal-sm d-flex justify-content-center" role="document">
                <div class="modal-content w-auto">
                    <div class="modal-header">
                        <h5 class="modal-title" id="switchModalLabel">` + capitalise(action) + ` Wallet</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-center">
                        <p class="text-left">Are you sure you want to ` + action + ` <span class="font-weight-bold"> ` + name + `</span> wallet?</p>
                    </div>
                    <div class="modal-footer d-flex justify-content-between">
                        <button type="button" class="btn btn-secondary no" data-dismiss="modal">Cancel</button>
                        `
                        + (checkBox.prop('checked') ?
                            `<button type="submit" class="btn btn-danger yes">` + capitalise(action) + `</button>`
                        : 
                            `<button type="submit" class="btn btn-primary yes">` + capitalise(action) + `</button>`
                        ) +
                        `
                        <form class="ui form hidden" action="" method="POST">
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

            if(action == "activate") {
                var icon = switchWallet.parents('.wallet').find('.icon');
                var iconSrc = icon.attr('src');
                var iconName = switchWallet.parents('.wallet').find('.currency').text().toLowerCase();

                icon.attr('src', iconSrc.replace(iconName, 'x-' + iconName));

            } else {
                var icon = switchWallet.parents('.wallet').find('.icon');
                var iconSrc = icon.attr('src');
                var iconName = switchWallet.parents('.wallet').find('.currency').text().toLowerCase();
                
                icon.attr('src', iconSrc.replace('x-', ''));

            }
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
    var oldNetwork = $(this).attr('data-network');
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
                            <h5 class="modal-title" id="passwordModalLabel">Edit `+ oldPlatform + ' ' + oldCurrency + ' ' + (oldNetwork ?? '') +` Wallet</h5>
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
                                        <div class="custom-dropdown form-input mt-4 hidden col-7 pr-2 pl-0">
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

                                        <div class="custom-dropdown form-input mt-4 hidden col-5 pl-2 pr-0">
                                            <label>Network</label>
                                            <div class="input-items default" style="height:44px">
                                                <select name="network" class="no-search" tabindex="-1">
                                                    <option disabled selected data-display="Select ...">Select ...</option>
                                                    @foreach($networks as $network)
                                                    <option value="{{ $network }}">{{ $network }}</option>
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
                        <div class="modal-footer d-flex justify-content-between">
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
        editWallet.find('select[name="network"]').val(oldNetwork);
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
                    
                    // if(WAValidator.validate(address, currency)) { // issue with currency validation
                    if(true) {

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
            nowNetwork = editWallet.find('select[name="network"]').val();
            nowRate = editWallet.find('input[name="rate"]').val();
            nowIcon = editWallet.find('img.icon').attr('src');
            nowAddress = editWallet.find('input[name="address"]').val();
            nowNote = editWallet.find('textarea[name="note"]').val();

            if(oldPlatform == nowPlatform && oldCurrency == nowCurrency 
                && oldNetwork == nowNetwork && oldRate == nowRate && oldIcon == nowIcon
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
                

                

                // if(validateAddress()) {
                if(true) { // if issue with currency validation in the future

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

                                if(oldNetwork != wallet.network) {
                                    editWallet.find('.network').text(wallet.network);
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

                                if((oldPlatform + ' ' + oldCurrency + ' ' + oldNetwork) != (wallet.platform + ' ' + wallet.currency + ' ' + wallet.network)) {
                                    editWallet.find('label.switch, .wallet-delete').attr('data-name', wallet.platform + ' ' + wallet.currency + ' ' + wallet.network);
                                }

                                editWallet.find('.wallet-edit').attr({
                                    'data-platform' : wallet.platform,
                                    'data-currency' : wallet.currency,
                                    'data-network' : wallet.network,
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
            <div class="modal-dialog modal-dialog-centered modal-sm d-flex justify-content-center" role="document">
                <div class="modal-content w-auto">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteWalletModalLabel">Delete Wallet</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-center">
                        <p class="text-left">Are you sure you want to delete <span class="font-weight-bold"> ` + name + `</span> wallet?</p>
                    </div>
                    <div class="modal-footer d-flex justify-content-between">
                        <button type="button" class="btn btn-secondary no" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger yes">Delete</button>
                        <form class="ui form hidden" action="" method="POST">
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