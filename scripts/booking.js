// Get bus ID from URL
const urlParams = new URLSearchParams(window.location.search);
const busId = urlParams.get('busId');

// Mock bus data (replace with real data)
const bus = {
  id: 2,
  name: "Luxury Bus",
  from: "Mumbai",
  to: "Pune",
  departure: "10:00 AM",
  arrival: "02:00 PM",
  price: 1200,
  totalSeats: 40,
  occupiedSeats: [3, 5, 12, 19], // Example occupied seats
};

// Initialize selected seats and total price
let selectedSeats = [];
let totalPrice = 0;

// Load bus details
document.addEventListener('DOMContentLoaded', () => {
  // Update bus details
  document.getElementById('busName').textContent = bus.name;
  document.getElementById('departureTime').textContent = bus.departure;
  document.getElementById('busRoute').textContent = `${bus.from} to ${bus.to}`;

  // Generate seat map
  generateSeatMap();
});

// Generate seat grid
function generateSeatMap() {
  const seatGrid = document.getElementById('seatGrid');
  seatGrid.innerHTML = '';

  for (let i = 1; i <= bus.totalSeats; i++) {
    const seat = document.createElement('div');
    seat.className = 'seat';
    seat.textContent = i;

    if (bus.occupiedSeats.includes(i)) {
      seat.classList.add('occupied');
    } else {
      seat.addEventListener('click', () => toggleSeat(i));
    }

    seatGrid.appendChild(seat);
  }
}

// Toggle seat selection
function toggleSeat(seatNumber) {
  const seat = document.querySelector(`.seat:nth-child(${seatNumber})`);
  seat.classList.toggle('selected');

  if (selectedSeats.includes(seatNumber)) {
    selectedSeats = selectedSeats.filter((seat) => seat !== seatNumber);
  } else {
    selectedSeats.push(seatNumber);
  }

  updatePassengerForm();
  updateBookingSummary();
}

// Update passenger form based on selected seats
function updatePassengerForm() {
  const form = document.getElementById('passengerForm');
  form.innerHTML = '';

  selectedSeats.forEach((seat) => {
    const passengerDiv = document.createElement('div');
    passengerDiv.innerHTML = `
      <h4>Passenger for Seat ${seat}</h4>
      <input type="text" placeholder="Name" required>
      <input type="number" placeholder="Age" min="1" required>
    `;
    form.appendChild(passengerDiv);
  });
}

// Update booking summary
function updateBookingSummary() {
  totalPrice = selectedSeats.length * bus.price;
  document.getElementById('selectedSeats').textContent = selectedSeats.join(', ');
  document.getElementById('totalPrice').textContent = totalPrice;
}

// Confirm booking
function confirmBooking() {
  const inputs = document.querySelectorAll('#passengerForm input');
  const passengers = [];

  // Validate inputs
  for (let i = 0; i < inputs.length; i += 2) {
    const name = inputs[i].value;
    const age = inputs[i + 1].value;

    if (!name || !age) {
      alert('Please fill in all passenger details!');
      return;
    }

    passengers.push({
      seat: selectedSeats[i / 2], // 0, 2, 4... indices for seats
      name: name,
      age: age,
    });
  }

  // Save booking to localStorage (mock database)
  const booking = {
    bus: bus,
    passengers: passengers,
    totalPrice: totalPrice,
    bookingId: Math.floor(Math.random() * 1000000), // Generate random ID
  };

  localStorage.setItem('currentBooking', JSON.stringify(booking));
  window.location.href = 'confirmation.html';
}