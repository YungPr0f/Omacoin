var tagClass = $('.tagsinput').data('color');

  $('.tagsinput').tagsinput({
      tagClass: ' tag-'+ tagClass +' '
  });


$(document).ready(function() {

    $('.datetimepicker').datetimepicker({
        icons: {
            time: "fa fa-clock-o",
            date: "fa fa-calendar",
            up: "fa fa-chevron-up",
            down: "fa fa-chevron-down",
            previous: 'fa fa-chevron-left',
            next: 'fa fa-chevron-right',
            today: 'fa fa-screenshot',
            clear: 'fa fa-trash',
            close: 'fa fa-remove'
        }

    });



    $('.file-click').click(function() {
        var boy = $(this).text();
        alert(boy);
    });


});


