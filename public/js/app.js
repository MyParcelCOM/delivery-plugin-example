// Wrap our code in a self invoking anonymous function.
// This way we won't pollute the global namespace.
(function () {
  // Create the settings object that we will pass when opening the delivery popup.
  var settings = {
    // Define the google_maps_key property, but don't set it.
    // We will set it from localStorage later.
    google_maps_key: null,
    // The callback we will use when a delivery was chosen.
    onSuccessCallback: function (pickupLocation) {
      console.log('Pickup location chosen!', pickupLocation)
    },
    // The callback we will use when the delivery popup is closed
    // without choosing a location.
    onCancelCallback: function () {
      console.log('delivery window closed.')
    },
    // The callback we will use when the delivery popup asks us for
    // pickup locations to show.
    retrievePickupLocationsCallback: function () {
      return getPickupLocations()
    }
  }

  // Show the delivery window when the popup button is pressed.
  document.getElementById('popup-btn').addEventListener('click', function () {
    // Add the google_maps_key from localStorage to the settings.
    settings.google_maps_key = window.localStorage.getItem('setting_maps_key')

    // Open the delivery popup on the #delivery-window div and pass the settings.
    window.myparcelcom.openDeliveryWindow('#delivery-window', settings)
  })

  // Save settings to localstorage.
  document.getElementById('settings-form').addEventListener('submit', function (e) {
    e.preventDefault()

    this.querySelectorAll('input').forEach(function (input) {
      window.localStorage.setItem('setting_' + input.name, input.value)
    })
  })

  // Show saved settings values in settings form.
  document.querySelectorAll('#settings-form input').forEach(function (input) {
    input.value = window.localStorage.getItem('setting_' + input.name)
  })
})()
