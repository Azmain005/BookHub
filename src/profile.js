document.addEventListener('DOMContentLoaded', function() {
    // Select all "Change" links and "Save" buttons
    const changeLinks = document.querySelectorAll('.myprofile a[id^="change-"]');
    const saveButtons = document.querySelectorAll('.profile-form .pbtn');
  
    changeLinks.forEach(link => {
      link.addEventListener('click', function(event) {
        event.preventDefault(); // Prevent default link behavior
  
        // Hide all save buttons initially
        saveButtons.forEach(btn => btn.style.display = 'none');
  
        // Get the ID of the clicked link
        const linkId = this.id;
        const saveButtonClass = `save-${linkId.split('-')[1]}`;
  
        // Show the corresponding save button
        const saveButton = document.querySelector(`.${saveButtonClass}`);
        if (saveButton) {
          saveButton.style.display = 'block';
        }
      });
    });
  });
// Prevent form submission when Enter is pressed
document.querySelector('.profile-form').addEventListener('keypress', function(event) {
  if (event.key === 'Enter') {
      event.preventDefault();
  }
});

  