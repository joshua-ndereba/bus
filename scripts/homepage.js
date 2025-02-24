// Handle form submission
document.getElementById('searchForm').addEventListener('submit', function (e) {
    e.preventDefault();
    const from = document.querySelector('#searchForm input[placeholder="From"]').value;
    const to = document.querySelector('#searchForm input[placeholder="To"]').value;
    const date = document.querySelector('#searchForm input[type="date"]').value;
  
    // Redirect to search page with query parameters
    window.location.href = `pages/search.html?from=${from}&to=${to}&date=${date}`;
  });