function profilToggle() {
  const profileMenu = document.getElementById('appbar-profile-menu')
  const burgerMenu = document.getElementById('appbar-burger-menu')

  const isOpen = profileMenu.classList.contains('hidden')
  if (isOpen) {
    burgerMenu.classList.add('hidden')
    profileMenu.classList.remove('hidden')
  } else profileMenu.classList.add('hidden')
}

function burgerMenuToggle() {
  const profileMenu = document.getElementById('appbar-profile-menu')
  const burgerMenu = document.getElementById('appbar-burger-menu')

  const isOpen = burgerMenu.classList.contains('hidden')
  if (isOpen) {
    profileMenu.classList.add('hidden')
    burgerMenu.classList.remove('hidden')
  } else burgerMenu.classList.add('hidden')
}

document.onkeydown = function (event) {
  if (event.key === 'Escape') {
    const profileMenu = document.getElementById('appbar-profile-menu')
    const burgerMenu = document.getElementById('appbar-burger-menu')
    profileMenu.classList.add('hidden')
    burgerMenu.classList.add('hidden')
  }
}
