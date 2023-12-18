// JavaScript for activating sidebar links
document.addEventListener('DOMContentLoaded', function () {
    var sidebarLinks = document.querySelectorAll('.sidebar-links a');

    sidebarLinks.forEach(function(link) {
        link.addEventListener('click', function() {
            // Remove active class from all links
            sidebarLinks.forEach(function(link) {
                link.classList.remove('active');
            });

            // Add active class to clicked link
            this.classList.add('active');
        });
    });
});
