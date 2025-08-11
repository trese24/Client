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


function getFileType(mimeType) {
    if (!mimeType) return 'Other';
    
    const type = mimeType.split('/')[0];
    switch(type) {
        case 'image': 
            // Check for PSD specifically
            if (mimeType === 'image/vnd.adobe.photoshop' || mimeType === 'application/photoshop') {
                return 'PSD';
            }
            return 'Image';
        case 'audio': return 'Audio';
        case 'video': return 'Video';
        case 'application':
            if (mimeType.includes('pdf')) return 'PDF';
            if (mimeType.includes('zip') || mimeType.includes('compressed')) return 'Archive';
            if (mimeType.includes('msword') || mimeType.includes('wordprocessingml')) return 'Document';
            // Another check for PSD in case it's detected as application
            if (mimeType === 'application/photoshop' || mimeType === 'image/vnd.adobe.photoshop') {
                return 'PSD';
            }
            return 'Application';
        default: return 'Other';
    }
}

function getFileIcon(fileType) {
    fileType = fileType.toLowerCase();
    let iconClass = 'fa-file';
    let typeClass = 'other';
    
    if (fileType.includes('image')) {
        iconClass = 'fa-file-image';
        typeClass = 'image';
    } else if (fileType.includes('pdf')) {
        iconClass = 'fa-file-pdf';
        typeClass = 'pdf';
    } else if (fileType.includes('audio')) {
        iconClass = 'fa-file-audio';
        typeClass = 'audio';
    } else if (fileType.includes('video')) {
        iconClass = 'fa-file-video';
        typeClass = 'video';
    } else if (fileType.includes('zip') || fileType.includes('compressed')) {
        iconClass = 'fa-file-archive';
        typeClass = 'zip';
    } else if (fileType.includes('document') || fileType.includes('word') || fileType.includes('text')) {
        iconClass = 'fa-file-word';
        typeClass = 'doc';
    } else if (fileType.includes('psd')) {
        iconClass = 'fa-file-image'; // or create a custom PSD icon
        typeClass = 'psd';
    }
    
    return { iconClass, typeClass };
}

