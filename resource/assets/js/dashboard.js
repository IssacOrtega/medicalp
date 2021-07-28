// Funcion para rellenar campos de modal editar cotización
$('#editQuoteModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget)
  var id_quote = button.data('id_quote')
  var title = button.data('title')
  // var id_client = button.data('id_client')
  var client = button.data('client') 
  var date = button.data('date')
  var date_expired = button.data('date_expired')

  var modal = $(this)
  modal.find('.modal-title').text('Editar cotización #' + id_quote)
  modal.find('.modal-body #id_quote').val(id_quote)
  modal.find('.modal-body #title').val(title)
  modal.find('.modal-body #client').val(client)
  modal.find('.modal-body #date').val(date)
  modal.find('.modal-body #date_expired').val(date_expired)
  // modal.find('.modal-body #client').prepend("<option value='" + id_client + "' selected>" + client + "</option>")

});

// Funcion para modal de eliminar cotización
$('#deleteQuoteModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget)
  var id_quote = button.data('id_quote')
  var title = button.data('title')

  var modal = $(this)
  modal.find('.modal-title').text('Eliminar cotización #' + id_quote)
  modal.find('.modal-body #id_quote').val(id_quote)
  modal.find('.modal-body #message').html('¿Estas segur@ de eliminar el registro <strong>"' + title + '"</strong>?')

});

// Funcion para rellenar campos de productos de cotización
$('#editProductModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget)
  var id_quote_product = button.data('id_quote_product')
  var amount = button.data('amount')
  var unit_price = button.data('unit_price')

  var modal = $(this)
  modal.find('.modal-title').text('Editar producto a cotizar')
  modal.find('.modal-body #id_quote_product').val(id_quote_product)
  modal.find('.modal-body #product').val(id_quote_product)
  modal.find('.modal-body #amount').val(amount)
  modal.find('.modal-body #unit_price').val(unit_price)

});

// Funcion para modal de productos de cotización
$('#deleteProductModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget)
  var id_quote_product = button.data('id_quote_product')
  var modal = $(this)
  modal.find('.modal-body #id_quote_product').val(id_quote_product)
});

// Funcion para modal de descripción
$('#addDescriptionModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget)
  var id_quote = button.data('id_quote')
  var modal = $(this)
  modal.find('.modal-body #id_quote').val(id_quote)
});

// Funcion para rellenar campos de modal ver direccion del cliente
$('#addressModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget)
  var name = button.data('name')
  var state = button.data('state')
  var municipality = button.data('municipality')
  var address = button.data('address')

  var modal = $(this)
  modal.find('.modal-title').text('Dirección de cliente (' + name + ')')
  modal.find('.modal-body #state').text(state)
  modal.find('.modal-body #municipality').text(municipality)
  modal.find('.modal-body #address').text(address)
});

// Funcion para rellenar campos de modal editar cliente
$('#editClientModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget)
  var id_client = button.data('id_client')
  var name = button.data('name')
  var phone = button.data('phone')
  var business = button.data('business')
  var email = button.data('email')
  var state = button.data('state')
  var municipality = button.data('municipality')
  var address = button.data('address')

  var modal = $(this)
  modal.find('.modal-title').text('Editar cliente (' + name + ')')
  modal.find('.modal-body #id_client').val(id_client)
  modal.find('.modal-body #name').val(name)
  modal.find('.modal-body #phone').val(phone)
  modal.find('.modal-body #business').val(business)
  modal.find('.modal-body #email').val(email)
  modal.find('.modal-body #state').val(state)
  modal.find('.modal-body #municipality').val(municipality)
  modal.find('.modal-body #address').val(address)
});

// Funcion para modal de eliminar cliente
$('#deleteClientModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget)
  var id_client = button.data('id_client')
  var name = button.data('name')

  var modal = $(this)
  modal.find('.modal-title').text('Eliminar cliente ' + name)
  modal.find('.modal-body #id_client').val(id_client)
  modal.find('.modal-body #message').html('¿Estas segur@ de eliminar el registro de <strong>"' + name + '"</strong>?')

});

// Funcion para poner el nombre del input de tipo file
$(".custom-file-input").on("change", function () {
  var fileName = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
})

// Funcion para rellenar campos de modal editar producto
$('#productEditModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget)
  var id_product = button.data('id_product')
  var product = button.data('product')
  var brand = button.data('brand')
  var image = button.data('image')

  var modal = $(this)
  modal.find('.modal-title').text('Editar producto (' + product + ')')
  modal.find('.modal-body #id_product').val(id_product)
  modal.find('.modal-body #product').val(product)
  modal.find('.modal-body #brand').val(brand)
  modal.find('.modal-body #thumb').html(image)
});

// Funcion para eliminar producto
$('#productDeleteModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget)
  var id_product = button.data('id_product')
  var product = button.data('product')

  var modal = $(this)
  modal.find('.modal-title').text('Eliminar producto (' + product + ')')
  modal.find('.modal-body #id_product').val(id_product)
  modal.find('.modal-body #message').html('¿Estas segur@ de eliminar el registro de <strong>"' + product + '"</strong>?')
});

// Funcion para rellenar campos de modal editar usuario
$('#editUserModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget)
  var id_user = button.data('id_user')
  var name = button.data('name')
  var phone = button.data('phone')
  var roll = button.data('roll')
  var email = button.data('email')
  var user = button.data('user')

  var modal = $(this)
  modal.find('.modal-title').text('Editar usuario (' + name + ')')
  modal.find('.modal-body #id_user').val(id_user)
  modal.find('.modal-body #name').val(name)
  modal.find('.modal-body #phone').val(phone)
  modal.find('.modal-body #roll').val(roll)
  modal.find('.modal-body #email').val(email)
  modal.find('.modal-body #user').val(user)
});

// Funcion para eliminar Usuarios
$('#deleteUserModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget)
  var id_user = button.data('id_user')
  var name = button.data('name')

  var modal = $(this)
  modal.find('.modal-title').text('Eliminar usuario (' + name + ')')
  modal.find('.modal-body #id_user').val(id_user)
  modal.find('.modal-body #message').html('¿Estas segur@ de eliminar el registro de <strong>"' + name + '"</strong>?')
});