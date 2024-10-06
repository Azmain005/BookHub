document.querySelectorAll('.choose-file').forEach(function(label) {
    const fileInput = label.nextElementSibling;
    const textInput = label.previousElementSibling;

    label.addEventListener('click', function() {
        fileInput.click();
    });

    fileInput.addEventListener('change', function() {
        if (fileInput.files.length > 0) {
            textInput.value = fileInput.files[0].name;
        } else {
            textInput.value = 'No file chosen';
        }
    });
});

// Prevent form submission when Enter is pressed
document.querySelector('.seller').addEventListener('keypress', function(event) {
    if (event.key === 'Enter') {
        event.preventDefault();
    }
});
