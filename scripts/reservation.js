function dispo() {
  const reservation = document.getElementById('trajetdispo')
  const traversee = document.getElementById('traversees')
  const value = traversee.value
  reservation.classList.remove('hidden')

  const Datas = new FormData()
  Datas.append('id', value)

  // eslint-disable-next-line no-undef
  const request = $.ajax({
    type: 'POST',
    url: '../database/ajax/collectTraversee.php',
    data: Datas,
    dataType: 'json',
    timeout: 120000, // 2 Minutes
    cache: false,
    contentType: false,
    processData: false
  })
  request.done(function (output) {
    alert(output)
  })
  request.fail(function (textStatus) {
    alert('c kc ' + textStatus)
  })
}

function howManyPets(ev) {
  const pets = document.getElementById('howmanypets')
  if (ev.id === 'pets-yes') pets.classList.remove('hidden')
  else pets.classList.add('hidden')
}

function howManyCar(ev) {
  const car = document.getElementById('howmanycar')
  if (ev.id === 'car-yes') car.classList.remove('hidden')
  else car.classList.add('hidden')
}
