// Create an initialization function that can be called multiple times safely
function initializeProfile() {
    // Make sure we're only operating on the profile component if it exists
    const profileComponent = document.getElementById('profile-component');
    if (!profileComponent) return;
    
    const buttons = profileComponent.querySelectorAll('.profile-button');
    const sections = profileComponent.querySelectorAll('.content-section');
    const container = profileComponent.querySelector('.content-container');
    
    // Skip initialization if already processed
    if (profileComponent.dataset.initialized === 'true') return;
    profileComponent.dataset.initialized = 'true';
    
    // Add a flag to track if animation is in progress
    let isAnimating = false;
    // Add debounce timeout variable
    let debounceTimeout = null;
    
    // No default tab - everything starts hidden
    // Remove all active states initially
    buttons.forEach(btn => btn.setAttribute('data-active', 'false'));
    sections.forEach(section => {
        section.classList.remove('active');
    });
    container.classList.remove('visible');
    
    // Reset all skill bars initially
    const skillLevels = profileComponent.querySelectorAll('.skill-level');
    skillLevels.forEach(skillLevel => {
        // Store the original width as a data attribute
        const width = skillLevel.style.width;
        skillLevel.setAttribute('data-width', width);
        skillLevel.style.width = '0';
    });
    
    // Ensure buttons are fully visible when clicked on mobile
    buttons.forEach(button => {
        button.addEventListener('click', () => {
            // Prevent action if animation is in progress
            if (isAnimating) return;
            
            // Clear any existing timeout
            if (debounceTimeout) {
                clearTimeout(debounceTimeout);
            }
            
            // Scroll button into view on mobile
            if (window.innerWidth <= 768) {
                button.scrollIntoView({ behavior: 'smooth', inline: 'center', block: 'nearest' });
            }
            
            const isCurrentlyActive = button.getAttribute('data-active') === 'true';
            const buttonText = button.textContent.toLowerCase().trim();
            
            // Set animation flag
            isAnimating = true;
            
            // If the button is already active, deactivate it and hide content
            if (isCurrentlyActive) {
                button.setAttribute('data-active', 'false');
                container.classList.remove('visible');
                
                // Hide all sections and reset skill bars
                sections.forEach(section => {
                    section.classList.remove('active');
                });
                
                // Reset all skill bars when closing
                skillLevels.forEach(skillLevel => {
                    skillLevel.style.width = '0';
                });
                
                // End animation after transition completes
                debounceTimeout = setTimeout(() => {
                    isAnimating = false;
                }, 500); // Match with CSS transition duration
                return;
            }
            
            // Otherwise, activate this button and show its content
            
            // First remove active state from all buttons
            buttons.forEach(btn => btn.setAttribute('data-active', 'false'));
            
            // Hide all sections first
            sections.forEach(section => {
                section.classList.remove('active');
            });
            
            // Activate this button
            button.setAttribute('data-active', 'true');
            
            // Show the content container
            container.classList.add('visible');
            
            // Show the selected section
            const targetSection = profileComponent.querySelector(`.content-section[data-section="${buttonText}"]`);
            if (targetSection) {
                setTimeout(() => {
                    targetSection.classList.add('active');
                    
                    // Animate skill bars if this is the skills section
                    if (buttonText === 'skills') {
                        const sectionSkillLevels = targetSection.querySelectorAll('.skill-level');
                        sectionSkillLevels.forEach(skillLevel => {
                            // Get the stored width and animate to it
                            const targetWidth = skillLevel.getAttribute('data-width');
                            skillLevel.style.width = '0'; // Reset first
                            
                            // Use a slight delay to ensure the animation runs after the section is visible
                            setTimeout(() => {
                                skillLevel.style.width = targetWidth;
                            }, 400);
                        });
                    }
                    
                    // End animation after all transitions complete
                    debounceTimeout = setTimeout(() => {
                        isAnimating = false;
                    }, 800); // Higher than CSS transition for safety
                }, 300); // Increased delay for better visibility transition
            }
        });
    });
    
    // Handle click on CTA buttons for smooth scrolling
    profileComponent.querySelectorAll('.cta-button').forEach(ctaButton => {
        ctaButton.addEventListener('click', function(e) {
            e.preventDefault();
            
            const targetId = this.getAttribute('href').substring(1);
            const buttonText = targetId;
            
            // Find the corresponding tab button and click it
            buttons.forEach(button => {
                if (button.textContent.toLowerCase().trim() === buttonText) {
                    if (!isAnimating) {
                        button.click();
                    }
                }
            });
        });
    });
    
    // Add touch feedback for mobile
    if ('ontouchstart' in window) {
        const touchElements = profileComponent.querySelectorAll('.profile-button, .cta-button, .send-message-btn');
        touchElements.forEach(element => {
            element.addEventListener('touchstart', function() {
                this.style.opacity = '0.8';
            });
            
            element.addEventListener('touchend', function() {
                this.style.opacity = '1';
            });
        });
    }
    
    console.log("Profile component initialized");
}

// Run initialization on DOMContentLoaded
document.addEventListener('DOMContentLoaded', function() {
    initializeProfile();
});

// Make the function available globally
window.initializeProfile = initializeProfile;

// Also run initialization on Livewire update events
document.addEventListener('livewire:load', function() {
    initializeProfile();
    
    // Handle Livewire's hook system if it exists
    if (typeof Livewire !== 'undefined') {
        Livewire.hook('message.processed', () => {
            initializeProfile();
        });
    }
});
