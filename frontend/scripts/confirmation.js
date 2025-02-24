// Load booking details from localStorage
document.addEventListener('DOMContentLoaded', () => {
    const booking = JSON.parse(localStorage.getItem('currentBooking'));
  
    if (!booking) {
      alert('No booking found!');
      window.location.href = '../index.html';
      return;
    }
  
    // Display booking details
    document.getElementById('bookingId').textContent = booking.bookingId;
    document.getElementById('busName').textContent = booking.bus.name;
    document.getElementById('busRoute').textContent = `${booking.bus.from} to ${booking.bus.to}`;
    document.getElementById('departureTime').textContent = booking.bus.departure;
    document.getElementById('totalPrice').textContent = booking.totalPrice;
  
    // Display passenger details
    const passengerList = document.getElementById('passengerList');
    booking.passengers.forEach((passenger) => {
      const li = document.createElement('li');
      li.textContent = `Seat ${passenger.seat}: ${passenger.name} (Age: ${passenger.age})`;
      passengerList.appendChild(li);
    });
  
    // Add event listener for download button
    document.getElementById('downloadTicket').addEventListener('click', () => {
      downloadTicket(booking);
    });
  });
  
  // Download ticket as PDF
  function downloadTicket(booking) {
    const ticketContent = `
      <h2>Bus Ticket</h2>
      <p><strong>Booking ID:</strong> ${booking.bookingId}</p>
      <p><strong>Bus Name:</strong> ${booking.bus.name}</p>
      <p><strong>Route:</strong> ${booking.bus.from} to ${booking.bus.to}</p>
      <p><strong>Departure:</strong> ${booking.bus.departure}</p>
      <p><strong>Passengers:</strong></p>
      <ul>
        ${booking.passengers.map(
          (passenger) =>
            `<li>Seat ${passenger.seat}: ${passenger.name} (Age: ${passenger.age})</li>`
        ).join('')}
      </ul>
      <p><strong>Total Price:</strong> ₹${booking.totalPrice}</p>
    `;
  
    const element = document.createElement('div');
    element.innerHTML = ticketContent;
  
    // Use a library like jsPDF to generate a PDF
    const pdf = new jsPDF();
    pdf.fromHTML(element, 15, 15, { width: 180 });
    pdf.save(`ticket_${booking.bookingId}.pdf`);
  }