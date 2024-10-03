  
          $(document).ready(function() {
    $('#menuBtn').click(function() {
        var sideMenu = $('#sideMenu');
        if (sideMenu.css('left') === '0px') {
            sideMenu.css('left', '-250px');
        } else {
            sideMenu.css('left', '0px');
        }
    });
  
    $('.side-menu > ul > li > a').click(function(event) {
        event.preventDefault(); 
  
        var $this = $(this);
        var $subMenu = $this.siblings('.sub_menu');
  
        if ($subMenu.is(':visible')) {
            $subMenu.slideUp(); 
            $this.find('i').removeClass('fa-angle-up').addClass('fa-angle-down'); 
        } else {
            $('.sub_menu').slideUp(); 
            $('.fa-angle-up').removeClass('fa-angle-up').addClass('fa-angle-down'); 
            $subMenu.slideDown();
            $this.find('i').removeClass('fa-angle-down').addClass('fa-angle-up');
        }
    });
  });
  
  
  $(document).ready(function() {
    // Headers script 
  
    $('[class^="nav-item_"]').hover(
      function() {
        var itemNumber = $(this).attr('class').match(/nav-item_(\d+)/)[1];
        $('.custom_menu_' + itemNumber).stop(true, true).fadeIn(700);  // Adjust the speed as needed
      },
      function() {
        var itemNumber = $(this).attr('class').match(/nav-item_(\d+)/)[1];
        setTimeout(function() {
          if (!$('.custom_menu_' + itemNumber).is(':hover')) {
            $('.custom_menu_' + itemNumber).stop(true, true).fadeOut(600);  // Adjust the speed as needed
          }
        }, 200);
      }
    );
  
    $('[class^="custom_menu_"]').hover(
      function() {
        $(this).stop(true, true).fadeIn(500);  // Adjust the speed as needed
      },
      function() {
        $(this).stop(true, true).fadeOut(400);  // Adjust the speed as needed
      }
    );
  
    $('#arrowIcon').hover(
      function() {
        // Show the header section when the arrow icon is hovered
        $('#headerSection').stop(true, true).slideDown(300);  // Adjust the speed as needed
      },
      function() {
        // Hide the header section when the arrow icon is not hovered
        $('#headerSection').stop(true, true).slideUp(300);  // Adjust the speed as needed
      }
    );
  });
  
  