    <script type="text/javascript" src="data_assets/js/jquery.min.js"></script>

    <!-- MAIN EFFECT -->
    <script type="text/javascript" src="data_assets/js/bootstrap.js"></script>
    <script type="text/javascript" src="data_assets/js/timepicker/bootstrap-timepicker.js"></script>
    <script type="text/javascript" src="data_assets/js/app.js"></script>
    <script type="text/javascript" src="data_assets/js/load.js"></script>
    <script type="text/javascript" src="data_assets/js/main.js"></script>
    <script type="text/javascript" src="data_assets/js/select/select2.full.js"></script>

    <script>
    
    $(function() {
      $('.steps').on('click', '.step--active', function() {
        var a = $(this);
        if (a.hasClass('step--complete') || $.stillOnProcess == true)return;
        
        $.stillOnProcess = true;
        
        a.removeClass('step--incomplete').addClass('step--complete');
        a.removeClass('step--active').addClass('step--inactive');
        a.next().removeClass('step--inactive').addClass('step--active');

        var action = a.attr('id');
        var site_url = $('#base_url').val();

        $.ajax({
           url: site_url+'time/'+action,
           type: "post",
           dataType: "json",
           data: {'is_ajax':true},
        }).done(function(data) {
            alert(data.msg);
            $.stillOnProcess = false;
            if (data.msg == 'eod') {
              window.location.href = "<?php echo site_url(); ?>"+"end_of_day";
              return;
            }

            if (data.result == 1) {
              if (data.msg.indexOf("Login")) {
                var now = new Date();
                var delay = 60 * 60 * 1000; // 1 hour in msec
                var start = delay - (now.getMinutes() * 60 + now.getSeconds()) * 1000 + now.getMilliseconds();

                setTimeout(function doSomething($start) {
                  if (!Notification) {
                    alert('Desktop notifications not available in your browser. Try Chromium.');
                    Notification.requestPermission(); 
                    return;
                  }

                  if (Notification.permission !== "granted")
                    Notification.requestPermission();
                  else {
                    var notification = new Notification('Notification', {
                      icon: '<?php echo base_url()."data_assets/ico/OS-logo.ico"; ?>',
                      body: "It's time for you to take a break.. :)",
                    });

                    notification.onclick = function () {
                      window.open("<?php echo site_url(); ?>");      
                    };
                    
                  }

                  setTimeout(doSomething, delay);
                }, start);
              }
              $('li.step.step--complete:last > span.time_log').text(data.time);
            } else {
              var a = $('li.step.step--complete:last');
              a.removeClass('step--complete').addClass('step--incomplete');
              a.removeClass('step--inactive').addClass('step--active');
              a.next().removeClass('step--active').addClass('step--inactive');
            }

        }).error(function() {
          var a = $('li.step.step--complete:last');
          a.removeClass('step--complete').addClass('step--incomplete');
          a.removeClass('step--inactive').addClass('step--active');
          a.next().removeClass('step--active').addClass('step--inactive');
        })
      });

      $(window).on('load', function () {
        var list = $('li.step.step--incomplete > span.time_log');

        $.each( list, function( key, value ) {
          var span = $(value);
          if (span.text() != '') {
            var a = span.parent();

            a.removeClass('step--incomplete').addClass('step--complete');
            a.removeClass('step--active').addClass('step--inactive');
            a.next().removeClass('step--inactive').addClass('step--active');
          }
        });
      })
  });
    function onProgClick (event) {
  const $el = $(event.currentTarget)
  $el.parent().attr('data-progress', $el.index())
}
$(window).load(function() { // makes sure the whole site is loaded
  $('#status').fadeOut(); // will first fade out the loading animation
  $('#preloader').fadeOut(); // will fade out the white DIV that covers the website.
  $('body').delay(350).css({
      'overflow': 'visible'
  });
});
$('#timepick_start, #timepick_end').timepicker({defaultTime:''});
function initProgress () {
  $('.duty-logs')
    .attr('data-progress', 2)
    .on('click', 'li', onProgClick);
    $(".select2_single").select2({
      placeholder: "Type of Problem",
      allowClear: true
    });
    $(".select_assisted").select2({
      placeholder: "What account?",
      allowClear: true
    });
    $(".select2_group").select2({
      placeholder: "Whats the Problem?",
      allowClear: true
    });
}

$(() => setTimeout(initProgress, 1000))

// request permission on page load
document.addEventListener('DOMContentLoaded', function () {
  if (Notification.permission !== "granted")
    Notification.requestPermission();
});

    </script>
</body>

</html>
