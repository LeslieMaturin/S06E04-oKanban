var app = {
  init: function() {
    console.log('init');

    app.addListAddingButton();

    var $addListModalElement = $('#addListModal');

    // Version jquery
    $addListModalElement.find('.close').on('click', function() {
      $addListModalElement.removeClass('is-active');
    });

    $('h2').on('dblclick', app.handleDblClickOnListTitle);
  },
  displayAddListModal: function() {

    $('#addListModal').addClass('is-active');
  },
  handleDblClickOnListTitle: function(evt) {
    console.log('dbl click sur le title de la liste');

    console.log(evt.target); 
    console.log(evt.currentTarget); 

    // Je jQuerise l'élément h2
    var $h2Element = $(evt.currentTarget);

    $h2Element.addClass('is-hidden'); // fonctionne
    // evt.currentTarget.addClass('is-hidden'); // ne fonctionne pas
    $(evt.currentTarget).addClass('is-hidden'); // fonctionne
    evt.currentTarget.classList.add('is-hidden'); // fonctionne, car Vanilla

    var $formElement = $h2Element.next();

    $formElement.removeClass('is-hidden');
  },
  addListAddingButton: function() {
    console.log('addListAddingButton');

    var $rootElement = $('<div>').addClass('column');

    var $btnElement = $('<button>').addClass('button is-success').attr('id', 'addListButton');

    $btnElement.html('&nbsp; Ajouter une liste');

    var $spanElement = $('<span>').addClass('icon is-small');

    var $iElement = $('<i>').addClass('fas fa-plus');


    $iElement.appendTo($spanElement);
    $spanElement.prependTo($btnElement); 
    $btnElement.appendTo($rootElement);


    $btnElement.on('click', app.displayAddListModal);

    $('#lists').append($rootElement);
  }
};

$(app.init);