function dispo() {
  const reservation = document.getElementById('liaisondispo')
  const region = document.getElementById('region')
  const liaison = document.getElementById('liaison')
  const value = region.value
  reservation.classList.remove('hidden')

  const Datas = new FormData()
  Datas.append('id', value)
  liaison.options.length = 1
  liaison.options = -1

  // eslint-disable-next-line no-undef
  const request = $.ajax({
    type: 'POST',
    url: '../database/ajax/collectLiaison.php',
    data: Datas,
    dataType: 'json',
    timeout: 120000, // 2 Minutes
    cache: false,
    contentType: false,
    processData: false
  })
  request.done(function (output) {
    liaison.value = 'none'
    output.forEach((element) => {
      const opt = document.createElement('option')
      opt.value = element.id
      opt.text =
        element.depart +
        ' - ' +
        element.arrivee +
        ' (' +
        element.distance +
        'Km)'
      liaison.add(opt, null)
    })
  })
  request.fail(function (textStatus) {
    alert('c kc ' + textStatus)
  })
}

function traverseedispo() {
  const reservation = document.getElementById('traverseedispo')
  const liaison = document.getElementById('liaison')
  const traversee = document.getElementById('traversee')
  reservation.classList.remove('hidden')
  const value = liaison.value

  const Datas = new FormData()
  Datas.append('id', value)
  traversee.options.length = 1
  traversee.options = -1

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
    output.forEach((element) => {
      const opt = document.createElement('option')
      opt.value = element.id
      opt.text = element.date + ' - ' + element.heure
      traversee.add(opt, null)
    })
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
