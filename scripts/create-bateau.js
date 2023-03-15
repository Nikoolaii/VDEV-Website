function onTypeChange() {
  const type = document.getElementById('type').value

  if (type === 'Voyageur') {
    document.getElementById('longueur').parentElement.classList.remove('hidden')
    document.getElementById('largeur').parentElement.classList.remove('hidden')
    document.getElementById('vitesse').parentElement.classList.remove('hidden')

    document.getElementById('longueur').parentElement.classList.add('flex')
    document.getElementById('largeur').parentElement.classList.add('flex')
    document.getElementById('vitesse').parentElement.classList.add('flex')

    document.getElementById('poids_max').parentElement.classList.remove('flex')
    document.getElementById('poids_max').parentElement.classList.add('hidden')
  } else if (type === 'Fret') {
    document.getElementById('longueur').parentElement.classList.remove('flex')
    document.getElementById('largeur').parentElement.classList.remove('flex')
    document.getElementById('vitesse').parentElement.classList.remove('flex')

    document.getElementById('longueur').parentElement.classList.add('hidden')
    document.getElementById('largeur').parentElement.classList.add('hidden')
    document.getElementById('vitesse').parentElement.classList.add('hidden')

    document
      .getElementById('poids_max')
      .parentElement.classList.remove('hidden')
    document.getElementById('poids_max').parentElement.classList.add('flex')
  }
}
