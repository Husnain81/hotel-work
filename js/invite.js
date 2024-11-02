document.getElementById('profileImageInput').addEventListener('change', function() {
    const file = this.files[0];
    if (!file) return;

    // Get the user ID from the hidden input field
    const userId = document.getElementById('userIdInput').value;

    // Send the file and user ID to the PHP backend
    const formData = new FormData();
    formData.append('profileImage', file);
    formData.append('user_id', userId);

    fetch('upload.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(result => {
        console.log(result);
        if (result.includes("Profile photo updated successfully")) {
            document.querySelector('photoprofile').src = URL.createObjectURL(file);
        } else {
            alert("Failed to update profile image.");
        }
    })
    .catch(error => console.error('Error uploading image:', error));
});
