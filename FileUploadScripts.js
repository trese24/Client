uploadBtn.addEventListener('click', function() {
    const selectedFiles = fileInput.files;
    if (selectedFiles.length === 0) {
        showStatus('Please select at least one file.', 'error');
        return;
    }

    const formData = new FormData();
    formData.append('file', selectedFiles[0]); // you can loop if multiple

    fetch('upload.php', {
        method: 'POST',
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        if (data.status === 'success') {
            showStatus('File uploaded successfully!', 'success');
            fileInput.value = '';
        } else {
            showStatus(data.message || 'Upload failed.', 'error');
        }
    })
    .catch(err => {
        console.error(err);
        showStatus('An error occurred.', 'error');
    });
});
