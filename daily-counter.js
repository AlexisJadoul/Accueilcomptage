// Function to update the daily counters for each service
function updateDailyCounters() {
    fetch('compteur-service.php')
        .then(response => response.json())
        .then(data => {
            // Update counters for each service
            Object.entries(data).forEach(([service, count]) => {
                // Check if this is a telephone counter (ends with 'T')
                if (service.endsWith('T')) {
                    const telephoneCounter = document.getElementById(`count_${service}`);
                    if (telephoneCounter) {
                        telephoneCounter.textContent = count;
                    }
                } else {
                    // This is a physical counter
                    const physicalCounter = document.getElementById(`count_${service}`);
                    if (physicalCounter) {
                        physicalCounter.textContent = count;
                    }
                }
            });
        })
        .catch(error => console.error('Error updating daily counters:', error));
}

// Update counters when the page loads
document.addEventListener('DOMContentLoaded', () => {
    updateDailyCounters();
    // Update counters every 30 seconds
    setInterval(updateDailyCounters, 30000);
});