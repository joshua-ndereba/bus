// Mock data for demonstration (replace with real data later)
const buses = [
    {
      id: 1,
      name: "Express Travels",
      from: "Mumbai",
      to: "Pune",
      departure: "08:00 AM",
      arrival: "12:00 PM",
      price: 800,
      seats: 20,
    },
    {
      id: 2,
      name: "Luxury Bus",
      from: "Mumbai",
      to: "Pune",
      departure: "10:00 AM",
      arrival: "02:00 PM",
      price: 1200,
      seats: 15,
    },
    {
      id: 3,
      name: "Night Rider",
      from: "Mumbai",
      to: "Pune",
      departure: "11:00 PM",
      arrival: "03:00 AM",
      price: 600,
      seats: 25,
    },
  ];
  
  // Get URL parameters (from homepage search)
  const urlParams = new URLSearchParams(window.location.search);
  const from = urlParams.get('from');
  const to = urlParams.get('to');
  const date = urlParams.get('date');
  
  // Display search criteria
  document.addEventListener('DOMContentLoaded', () => {
    // Filter buses (mock logic)
    const filteredBuses = buses.filter(
      (bus) => bus.from === from && bus.to === to
    );
    renderBuses(filteredBuses);
  });
  
  // Render buses to the DOM
  function renderBuses(buses) {
    const busList = document.getElementById('busList');
    busList.innerHTML = '';
  
    buses.forEach((bus) => {
      const busCard = document.createElement('div');
      busCard.className = 'bus-card';
      busCard.innerHTML = `
        <div class="bus-info">
          <h3>${bus.name}</h3>
          <p><i class="fas fa-clock"></i> Departure: ${bus.departure}</p>
          <p><i class="fas fa-map-marker-alt"></i> ${bus.from} to ${bus.to}</p>
          <p><i class="fas fa-chair"></i> Seats Available: ${bus.seats}</p>
        </div>
        <div class="bus-price">
          <div class="price">₹${bus.price}</div>
          <button onclick="bookBus(${bus.id})">Book Now</button>
        </div>
      `;
      busList.appendChild(busCard);
    });
  }
  
  // Filter buses based on user selection
  document.getElementById('priceFilter').addEventListener('change', (e) => {
    // Add price filtering logic here
  });
  
  document.getElementById('timeFilter').addEventListener('change', (e) => {
    // Add time filtering logic here
  });
  
  // Book a bus (redirect to booking page)
  function bookBus(busId) {
    window.location.href = `booking.html?busId=${busId}`;
  }
//functions for loading spinnner
  function showLoading() {
    document.getElementById('loadingSpinner').style.display = 'flex';
  }
  
  function hideLoading() {
    document.getElementById('loadingSpinner').style.display = 'none';
  }
  
  // Example usage
  showLoading();
  setTimeout(hideLoading, 2000); // Simulate a 2-second delay