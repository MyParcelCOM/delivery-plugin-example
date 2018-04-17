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

      // This is the pickupLocation as it was passed in as part of the array of locations.
      // You could use it here in the JavaScript code or pass it to your backend.
    },
    // The callback we will use when the delivery popup is closed without choosing a location.
    onCancelCallback: function () {
      console.log('Delivery popup closed.')
    },
    // The callback we will use when the delivery popup asks us for
    // pickup locations to show.
    retrievePickupLocationsCallback: function (countryCode, postalCode) {
      // Do a fetch request to our example app backend to request the locations.
      // Give the fetch promise back to the delivery plugin.
      return fetch('/locations/' + countryCode + '/' + postalCode)
        .then(function (responseObject) {
          // Let fetch know the response should be handled as JSON.
          return responseObject.json()
        })
        .then(function (response) {
          // Only return the array of locations in the data property of the JSON response.
          return response.data
        })
    },
    // The callback we will use when the delivery popup asks us for carriers.
    retrieveCarriersCallback: function () {
      // Do a fetch request to our example app backend to request the carriers.
      // Give the fetch promise back to the delivery plugin.
      return fetch('/carriers')
        .then(function (responseObject) {
          // Let fetch know the response should be handled as JSON.
          return responseObject.json()
        })
        .then(function (response) {
          // Only return the array of carriers in the data property of the JSON response.
          return response.data
        })
    }
  }

  // Show the delivery window when the popup button is pressed.
  document.getElementById('popup-btn').addEventListener('click', function () {
    // Add the google_maps_key from localStorage to the settings.
    settings.google_maps_key = window.localStorage.getItem('setting_maps_key')

    // Passing the initial postal code and country code. These could be passed down from the backend
    // as information set on a shipment.
    const initialLocation = {
      countryCode: 'GB',
      postalCode: 'SE1 7GL'
    }

    // Open the delivery popup on the #delivery-window element and pass the settings.
    window.myparcelcom.openDeliveryWindow('#delivery-window', initialLocation, settings)
  })

  // Save settings to localStorage.
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
