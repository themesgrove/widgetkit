jQuery(document).ready(function($){


/* ========================================================================= */
/*  Portfolio filter js
/* ========================================================================= */

      if($('.border').length){
        //portfolio filter
        jQuery(window).load(function(){
             $portfolio_selectors = $('.border>li>a');
             $portfolio_selectors.on('click', function(){
                 var selector = $(this).attr('data-filter');
                 return false;
             });
        });
      };

      if($('.slash').length){
        //portfolio filter
        jQuery(window).load(function(){
             $portfolio_selectors = $('.slash>li>a');
             $portfolio_selectors.on('click', function(){
                 var selector = $(this).attr('data-filter');
                 return false;
             });
        });
      };

      if($('.round').length){
        //portfolio filter
        jQuery(window).load(function(){
             $portfolio_selectors = $('.round>li>a');
             $portfolio_selectors.on('click', function(){
                 var selector = $(this).attr('data-filter');
                 return false;
             });
        });
      };



      [1,2,3,4].forEach(function(i) {
        if($('.hover-' + i).length){
          $('.hover-'+ i).mixItUp({
          });
        }
      });

      
/* ========================================================================= */
/*  Portfilo hoverdir js and light case
/* ========================================================================= */

    jQuery(document).ready(function(){
   //      $("a[data-rel^='lightcase']").lightcase();
      $('#hover-1 .item').each( function() { $(this).hoverdir(); } );
    });


/* ========================================================================= */
/*  SLider height browser js
/* ========================================================================= */

    // Hero area auto height adjustment
    $('#tgx-hero-unit .carousel-inner .item') .css({'height': (($(window).height()))+'px'});
    $(window).resize(function(){
        $('#tgx-hero-unit .carousel-inner .item') .css({'height': (($(window).height()))+'px'});
    });


//       $('.slider-1').clone().removeAttr('id').attr('id', 'slider-2').appendTo('body');

// $('#slider-1').slick({
//     arrows: false,
//     speed: 750,
//     asNavFor: '#slider-2',
//     dots: false
// }).on('mousedown touchstart', function () {
//     $('body').addClass('down');
// }).on('mouseleave mouseup touchend', function () {
//     $('body').removeClass('down');
// });

// $(window).on('keydown', function () {
//     $('body').addClass('down');
// }).on('keyup', function () {
//     $('body').removeClass('down');
// });

// $('#slider-2').slick({
//     fade: true,
//     arrows: false,
//     speed: 300,
//     asNavFor:
//     '#slider-1',
//     dots: false
// });

// setTimeout(function(){
//   $(window).trigger('keydown');
//   setTimeout(function(){
//     $('#slider-1').slick('slickNext');
//     setTimeout(function(){
//       $(window).trigger('keyup');
//     }, 500);
//   }, 600);
// }, 1500);

// $('#slider-1 image').removeAttr('mask');

// $(window).on('resize', function () {
//     $('#donutmask circle').attr({
//         cx: $(window).width() / 2,
//         cy: $(window).height() / 2
//     });
//     $('#donutmask #outer').attr({
//         r: $(window).height() / 2.6
//     });
//     $('#donutmask #inner').attr({
//         r: $(window).height() / 4.5
//     });
// }).resize();

// $(window).on('mousemove', function(e){
//   $('.cursor').css({
//     top: e.pageY + 'px',
//     left: e.pageX + 'px',
//   })
// });






jQuery(".tgx-project").addClass("owl-carousel").owlCarousel({
      pagination: true,
      center: true,
      margin:100,
      dots:false,
      loop:true,
      items:2,
      nav: true,
      navClass: ['owl-carousel-left','owl-carousel-right'],
      navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
      autoHeight : true,
      autoplay:false,
      responsive:{
          0:{
              items:1
          },
          600:{
              items:1
          },
          1000:{
              items:2
          }
      }
   });


/* ========================================================================= */
/*  format-gallery .gallery
/* ========================================================================= */
// jQuery(".format-gallery .gallery").addClass("owl-carousel").owlCarousel({
//       pagination: true,
//       dots:false,
//       loop:true,
//       items:1,
//       nav: true,
//       navClass: ['owl-carousel-left','owl-carousel-right'],
//       navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
//       autoHeight : true,
//       autoplay:false,
//       responsive:{
//           0:{
//               items:1
//           },
//           600:{
//               items:1
//           },
//           1000:{
//               items:1
//           }
//       }
//    });


/* ========================================================================= */
/*  Testimonial slider js
/* ========================================================================= */
// jQuery(".testimonial-slider").addClass("owl-carousel").owlCarousel({
//       pagination: true,
//       dots:true,
//       loop:true,
//       items:1,
//       nav: false,
//       autoHeight : false,
//       autoplay:true,
//       responsive:{
//           0:{
//               items:1
//           },
//           600:{
//               items:1
//           },
//           1000:{
//               items:1
//           }
//       }
//    });

});


