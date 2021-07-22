$('#editQuoteModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget)
  var id_quote = button.data('id_quote') 
  var title = button.data('title')
  // var id_client = button.data('id_client')
  // var client = button.data('client') 
  var date = button.data('date')
  var date_expired = button.data('date_expired')

  var modal = $(this)
  modal.find('.modal-title').text('Editar cotización #' + id_quote)
  modal.find('.modal-body #id_quote').val(id_quote)
  modal.find('.modal-body #title').val(title)
  modal.find('.modal-body #date').val(date)
  modal.find('.modal-body #date_expired').val(date_expired)
  // modal.find('.modal-body #client').prepend("<option value='" + id_client + "' selected>" + client + "</option>")

});

$('#deleteQuoteModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget)
  var id_quote = button.data('id_quote') 
  var title = button.data('title')

  var modal = $(this)
  modal.find('.modal-title').text('Eliminar cotización #' + id_quote)
  modal.find('.modal-body #id_quote').val(id_quote)
  modal.find('.modal-body #message').html('¿Estas segur@ de eliminar el registro <strong>"' + title + '"</strong>?')

});