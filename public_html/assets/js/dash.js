
function showDropdown() {
    // Add event listener to dropdown trigger
document.getElementById('user-profile-trigger').addEventListener('click', function() {
  // Toggle show class on dropdown content
  document.getElementById('user-profile-dropdown-content').classList.toggle('show');
});

// Close dropdown when user clicks outside of it
window.addEventListener('click', function(event) {
  if (!event.target.matches('#user-profile-trigger')) {
    var dropdownContent = document.getElementById('user-profile-dropdown-content');
    if (dropdownContent.classList.contains('show')) {
      dropdownContent.classList.remove('show');
    }
  }
});
}


