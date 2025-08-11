document.addEventListener('DOMContentLoaded', function() {
    // DOM elements
    const fileInput = document.getElementById('fileInput');
    const uploadBtn = document.getElementById('uploadBtn');
    const statusDiv = document.getElementById('status');
    const filesTableBody = document.getElementById('filesTableBody');
    const noFilesMessage = document.getElementById('noFilesMessage');
    const filesTable = document.getElementById('filesTable');
    const uploadContainer = document.getElementById('uploadContainer');
    const selectedFilesDiv = document.getElementById('selectedFiles');
    const progressBar = document.getElementById('progressBar');
    const progress = document.getElementById('progress');
    const uploadSpinner = document.getElementById('uploadSpinner');
    
    // Initialize files array from localStorage or create empty array
    let files = JSON.parse(localStorage.getItem('uploadedFiles')) || [];
    
    // Display existing files on page load
    displayFiles();
    
    // File input change event
    fileInput.addEventListener('change', function() {
        updateSelectedFiles();
    });
    
    // Drag and drop functionality
    uploadContainer.addEventListener('dragover', function(e) {
        e.preventDefault();
        uploadContainer.classList.add('active');
    });
    
    uploadContainer.addEventListener('dragleave', function() {
        uploadContainer.classList.remove('active');
    });
    
    uploadContainer.addEventListener('drop', function(e) {
        e.preventDefault();
        uploadContainer.classList.remove('active');
        
        if (e.dataTransfer.files.length) {
            fileInput.files = e.dataTransfer.files;
            updateSelectedFiles();
        }
    });
    
    // Update selected files display
    function updateSelectedFiles() {
        const selectedFiles = fileInput.files;
        
        if (selectedFiles.length === 0) {
            selectedFilesDiv.textContent = '';
            uploadBtn.disabled = true;
            return;
        }
        
        let fileList = '';
        for (let i = 0; i < Math.min(selectedFiles.length, 3); i++) {
            fileList += selectedFiles[i].name;
            if (i < Math.min(selectedFiles.length, 3) - 1) {
                fileList += ', ';
            }
        }
        
        if (selectedFiles.length > 3) {
            fileList += ` and ${selectedFiles.length - 3} more`;
        }
        
        selectedFilesDiv.textContent = fileList;
        uploadBtn.disabled = false;
    }
    
    // Upload button click event
    uploadBtn.addEventListener('click', function() {
        const selectedFiles = fileInput.files;
        
        if (selectedFiles.length === 0) {
            showStatus('Please select at least one file.', 'error');
            return;
        }
        
        // Show loading state
        uploadBtn.disabled = true;
        uploadSpinner.style.display = 'inline-block';
        progressBar.style.display = 'block';
        
        // Process each selected file with simulated progress
        let uploadedCount = 0;
        const totalFiles = selectedFiles.length;
        
        function processNextFile(index) {
            if (index >= selectedFiles.length) return;
            
            const file = selectedFiles[index];
            const fileObj = {
                id: Date.now() + index, // Unique ID for each file
                name: file.name,
                type: getFileType(file.type),
                size: formatFileSize(file.size),
                rawSize: file.size,
                uploadDate: new Date().toLocaleString(),
                fileData: null
            };
            
            // Simulate upload progress
            let progressValue = 0;
            const progressInterval = setInterval(() => {
                progressValue += Math.random() * 10;
                if (progressValue >= 100) {
                    progressValue = 100;
                    clearInterval(progressInterval);
                }
                progress.style.width = `${progressValue}%`;
            }, 100);
            
            // Read the file as base64 for storage
            const reader = new FileReader();
            reader.onload = function(e) {
                clearInterval(progressInterval);
                progress.style.width = '100%';
                
                fileObj.fileData = e.target.result.split(',')[1]; // Store only the base64 part
                files.push(fileObj);
                
                // Save to localStorage
                localStorage.setItem('uploadedFiles', JSON.stringify(files));
                
                uploadedCount++;
                
                // Update the display after the last file
                if (uploadedCount === totalFiles) {
                    displayFiles();
                    showStatus(`${totalFiles} file(s) uploaded successfully!`, 'success');
                    fileInput.value = ''; // Clear the file input
                    selectedFilesDiv.textContent = '';
                    uploadBtn.disabled = true;
                    uploadSpinner.style.display = 'none';
                    progressBar.style.display = 'none';
                    progress.style.width = '0';
                } else {
                    // Process next file
                    setTimeout(() => {
                        processNextFile(index + 1);
                    }, 300);
                }
            };
            reader.readAsDataURL(file);
        }
        
        // Start processing files
        processNextFile(0);
    });
    
    // Function to display files in the table
    function displayFiles() {
        filesTableBody.innerHTML = '';
        
        if (files.length === 0) {
            noFilesMessage.style.display = 'block';
            filesTable.style.display = 'none';
        } else {
            noFilesMessage.style.display = 'none';
            filesTable.style.display = 'table';
            
            files.forEach(file => {
                const row = document.createElement('tr');
                const fileIcon = getFileIcon(file.type);
                
                row.innerHTML = `
                    <td>
                        <div class="file-name">
                            <i class="file-icon ${fileIcon.iconClass}"></i>
                            ${file.name}
                        </div>
                    </td>
                    <td><span class="file-type ${fileIcon.typeClass}">${file.type}</span></td>
                    <td><span class="file-size">${file.size}</span></td>
                    <td><span class="file-date">${file.uploadDate}</span></td>
                    <td class="action-btns">
                        <button class="action-btn download-btn" data-id="${file.id}">
                            <i class="fas fa-download"></i> Download
                        </button>
                        <button class="action-btn delete-btn" data-id="${file.id}">
                            <i class="fas fa-trash"></i> Delete
                        </button>
                    </td>
                `;
                
                filesTableBody.appendChild(row);
            });
            
            // Add event listeners to the buttons
            document.querySelectorAll('.download-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const fileId = parseInt(this.getAttribute('data-id'));
                    downloadFile(fileId);
                });
            });
            
            document.querySelectorAll('.delete-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const fileId = parseInt(this.getAttribute('data-id'));
                    deleteFile(fileId);
                });
            });
        }
    }
    
    // Function to download a file
    function downloadFile(fileId) {
        const file = files.find(f => f.id === fileId);
        if (!file) return;
        
        // Show loading on button
        const button = document.querySelector(`.download-btn[data-id="${fileId}"]`);
        const originalContent = button.innerHTML;
        button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Downloading...';
        button.disabled = true;
        
        // Simulate download delay
        setTimeout(() => {
            // Create a temporary anchor element
            const a = document.createElement('a');
            a.href = `data:${file.type};base64,${file.fileData}`;
            a.download = file.name;
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
            
            showStatus(`"${file.name}" downloaded successfully.`, 'success');
            
            // Restore button
            button.innerHTML = originalContent;
            button.disabled = false;
        }, 1000);
    }
    
    // Function to delete a file
    function deleteFile(fileId) {
        const file = files.find(f => f.id === fileId);
        if (!file) return;
        
        if (confirm(`Are you sure you want to delete "${file.name}"?`)) {
            // Find the row and animate its removal
            const row = document.querySelector(`tr button[data-id="${fileId}"]`).closest('tr');
            row.style.transform = 'translateX(100%)';
            row.style.opacity = '0';
            row.style.transition = 'all 0.4s ease';
            
            setTimeout(() => {
                files = files.filter(f => f.id !== fileId);
                localStorage.setItem('uploadedFiles', JSON.stringify(files));
                displayFiles();
                showStatus('File deleted successfully.', 'success');
            }, 400);
        }
    }
    
    // Function to show status messages
    function showStatus(message, type) {
        statusDiv.textContent = message;
        statusDiv.className = 'status ' + type;
        
        // Hide the status after 5 seconds
        setTimeout(() => {
            statusDiv.style.opacity = '0';
            statusDiv.style.transition = 'opacity 0.5s ease';
            setTimeout(() => {
                statusDiv.style.display = 'none';
                statusDiv.style.opacity = '1';
            }, 500);
        }, 5000);
    }
    
    // Helper function to format file size
    function formatFileSize(bytes) {
        if (bytes === 0) return '0 Bytes';
        const k = 1024;
        const sizes = ['Bytes', 'KB', 'MB', 'GB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
    }
    
    // Helper function to get file type category
    function getFileType(mimeType) {
        if (!mimeType) return 'Other';
        
        const type = mimeType.split('/')[0];
        switch(type) {
            case 'image': return 'Image';
            case 'audio': return 'Audio';
            case 'video': return 'Video';
            case 'application':
                if (mimeType.includes('pdf')) return 'PDF';
                if (mimeType.includes('zip') || mimeType.includes('compressed')) return 'Archive';
                if (mimeType.includes('msword') || mimeType.includes('wordprocessingml')) return 'Document';
                return 'Application';
            default: return 'Other';
        }
    }
    
    // Helper function to get file icon and type class
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
        }
        
        return { iconClass, typeClass };
    }
});

