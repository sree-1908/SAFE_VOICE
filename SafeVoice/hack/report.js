function submitReport() {
    const location = document.getElementById('location').value;
    const criticality = document.getElementById('criticality').value;
    const description = document.getElementById('description').value;

    // Log the data being sent
    console.log('Submitting report with data:', { location, criticality, description });

    const data = {
        location: location,
        criticality: criticality,
        description: description
    };

    fetch('submit_report.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })
    .then(response => {
        return response.json(); // Parse JSON response
    })
    .then(data => {
        console.log('Response from server:', data); // Log server response
        if (data.status === 'success') {
            window.location.href = 'assistance.html';
        } else {
            alert('Error: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error submitting report. Please check your internet connection.');
    });
}
