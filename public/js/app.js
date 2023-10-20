//Local Scroll Init
// $('body').localScroll();

//Light Case Init
// jQuery(document).ready(function ($) {
//   $("a[data-rel^=lightcase]").lightcase();
// });

// Aos Init
// AOS.init({
//   offset: 300,
//   duration: 600,
//   easing: "ease-out",
// });

//Navbar Function Control
// $(window).on("scroll", function () {
//   if ($(window).scrollTop()) {
//   } else {
//   }
// });

var swiper = new Swiper(".mySwiper", {
  pagination: {
    el: ".swiper-pagination",
  },
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
});
