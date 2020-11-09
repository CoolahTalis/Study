'use strict';

document.addEventListener('DOMContentLoaded', function () {
  console.log('Hello Bulma!');
});

// TOGGLE MODAL CURRENTUSER'S ADS FUNCTION .. thx to a.g ..
$("#openModal").click(function() {
  console.log("ok");
  $(".modal").addClass("is-active");
  });

  $(".close").click(function() {
    $(".modal").removeClass("is-active");
    });