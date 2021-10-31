// Transaction Actions
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
    var walletNetwork = txnData.attr('data-wallet-network');
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
                                        <strong>$`+ cryptoAmount +`</strong> `+ currencyName +` was sent into `+ walletPlatform + ' ' + walletCurrency + ' ' + walletNetwork +` wallet address: <u>`+ walletAddress +`</u>
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