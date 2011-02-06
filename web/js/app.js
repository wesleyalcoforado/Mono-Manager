var app = {
  init: function(){
    app.stylishInputs();
  },

  createDatePicker: function(day, month, year){
    var elements = new Object();
    elements[year] = 'Y';
    elements[month] = 'n';
    elements[day] = 'j';

    var opts = {
        formElements: elements
    };

    datePickerController.createDatePicker(opts);
  },

  stylishInputs: function(){
    $("input[type=text], input[type=password], textarea, #projeto_professor_id").addClass("width400");

    $("input[type=text], input[type=password], textarea, select").addClass("idle");
    $("input[type=text], input[type=password], textarea, select").focus(function(){
      $(this).addClass("activeField").removeClass("idle");
    }).blur(function(){
      $(this).removeClass("activeField").addClass("idle");
    });
  }
}

$(document).ready(function(){
  app.init();
});