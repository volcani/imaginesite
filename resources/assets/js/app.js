
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));

const app = new Vue({
    el: '#app'
});

$($(document).ready(function() {
  $(".editTr").children().hide();
  $(".editBtn").click(function(event) {
      event.stopPropagation();
      var $target = $(event.target);
      $target.closest("tr").next().children().slideToggle(200, "linear");
  });


  $(".updateBtn").click(function(event) {
    var $target = $(event.target);
    var $userID = $target.closest('form').attr('id');
    var $serialForm = $target.closest("form").serializeArray();
    $serialForm.push({name: "username", value: $userID});
    //console.log(JSON.stringify($serialForm));
    $.ajax({
      url: 'update',
      type: 'POST',
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      dataType: 'JSON',
      data: JSON.stringify($serialForm),
    })
    .done(function() {
      console.log("success");
    })
    .fail(function() {
      console.log("error");
    })
    .always(function() {
      console.log("complete");
    });
  });

  $(".deleteBtn").click(function(event) {
    var $target = $(event.target);
    var $userID = $target.closest('form').attr('id');
    alert("Would you like to delete this account? This cannot be undone.");

    $.ajax({
      url: 'delete/' + $userID,
      type: 'POST',
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
    })
    .done(function() {
      console.log("success");
    })
    .fail(function() {
      console.log("error");
    })
    .always(function() {
      console.log("complete");
    });

    $target.closest('tr').prev('tr').remove();
    $target.closest('tr').remove();
  });
}));
