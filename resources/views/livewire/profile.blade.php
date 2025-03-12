@vite(['resources/css/profile.css', 'resources/js/profile.js'])
<div id="profile-component">
    <div>
        <div class="button-container">
            <button class="profile-button" data-active="false">Home</button>
            <button class="profile-button" data-active="false">Portfolio</button>
            <button class="profile-button" data-active="false">Skills</button>
            <button class="profile-button" data-active="false">About</button>
            <button class="profile-button" data-active="false">Contact</button>
        </div>

        <div class="content-container">
            <div class="content-section" data-section="home">
                <h2 class="intro-title">Welcome</h2>
                <div class="intro-content">
                    <div class="avatar-container">
                        <div class="avatar-frame">
                            <!-- Replace with your actual image path -->
                            <img src="{{ asset('images/profile-photo.jpg') }}" alt="John Mervin Q. Caballero" class="avatar-img">
                        </div>
                    </div>
                    <div class="intro-text">
                        <h3 class="name-highlight">John Mervin Q. Caballero</h3>
                        <p class="tagline">Frontend Developer & UX Enthusiast</p>
                        <p class="bio">Welcome to my digital portfolio! I create elegant, user-focused web experiences and believe in going with the flow while maintaining excellence in everything I build.</p>
                        <div class="cta-buttons">
                            <a href="#contact" class="cta-button primary">Get in Touch</a>
                            <a href="#portfolio" class="cta-button secondary">View My Work</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-section" data-section="portfolio">
                <h2 class="section-title">Portfolio</h2>
                <div class="portfolio-grid">
                    <div class="project-card">
                        <div class="project-image">
                            <img src="{{ asset('images/project1.jpg') }}" alt="Project 1">
                            <div class="project-overlay">
                                <a href="#" class="view-project">View Project</a>
                            </div>
                        </div>
                        <div class="project-info">
                            <h3>Project Name</h3>
                            <p>A short description of this amazing project and the technologies used.</p>
                            <div class="project-tags">
                                <span>HTML</span>
                                <span>CSS</span>
                                <span>JavaScript</span>
                            </div>
                        </div>
                    </div>
                    <div class="project-card">
                        <div class="project-image">
                            <img src="{{ asset('images/project2.jpg') }}" alt="Project 2">
                            <div class="project-overlay">
                                <a href="#" class="view-project">View Project</a>
                            </div>
                        </div>
                        <div class="project-info">
                            <h3>Another Project</h3>
                            <p>Creative solutions implemented with modern development practices.</p>
                            <div class="project-tags">
                                <span>React</span>
                                <span>Node.js</span>
                                <span>MongoDB</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="content-section" data-section="skills">
                <h2 class="section-title">Skills</h2>
                <div class="skills-container">
                    <div class="skill-category">
                        <h3>Frontend Development</h3>
                        <div class="skill-bars">
                            <div class="skill-item">
                                <span class="skill-name">HTML/CSS</span>
                                <div class="skill-bar"><span class="skill-level" style="width:90%"></span></div>
                                <span class="skill-percent">90%</span>
                            </div>
                            <div class="skill-item">
                                <span class="skill-name">JavaScript</span>
                                <div class="skill-bar"><span class="skill-level" style="width:85%"></span></div>
                                <span class="skill-percent">85%</span>
                            </div>
                            <div class="skill-item">
                                <span class="skill-name">React</span>
                                <div class="skill-bar"><span class="skill-level" style="width:80%"></span></div>
                                <span class="skill-percent">80%</span>
                            </div>
                        </div>
                    </div>
                    <div class="skill-category">
                        <h3>Backend & Tools</h3>
                        <div class="skill-bars">
                            <div class="skill-item">
                                <span class="skill-name">PHP/Laravel</span>
                                <div class="skill-bar"><span class="skill-level" style="width:75%"></span></div>
                                <span class="skill-percent">75%</span>
                            </div>
                            <div class="skill-item">
                                <span class="skill-name">Git & CI/CD</span>
                                <div class="skill-bar"><span class="skill-level" style="width:80%"></span></div>
                                <span class="skill-percent">80%</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="content-section" data-section="about">
                <h2 class="section-title">About Me</h2>
                <div class="about-container">
                    <div class="about-image">
                        <img src="{{ asset('images/profile-photo.jpg') }}" alt="John Mervin Q. Caballero">
                    </div>
                    <div class="about-content">
                        <p class="about-intro">I'm a passionate frontend developer with a keen eye for design and user experience.</p>
                        <div class="about-details">
                            <p>With over 5 years of experience in web development, I specialize in creating responsive, accessible, and performant web applications. I believe in writing clean, maintainable code and continuously learning new technologies to stay at the forefront of web development.</p>
                            <p>When I'm not coding, you might find me exploring new coffee shops, hiking, or reading about the latest tech trends.</p>
                        </div>
                        <div class="about-timeline">
                            <div class="timeline-item">
                                <div class="timeline-dot"></div>
                                <div class="timeline-content">
                                    <h4>2022 - Present</h4>
                                    <p>Senior Frontend Developer at Tech Company</p>
                                </div>
                            </div>
                            <div class="timeline-item">
                                <div class="timeline-dot"></div>
                                <div class="timeline-content">
                                    <h4>2019 - 2022</h4>
                                    <p>Web Developer at Digital Agency</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="content-section" data-section="contact">
                <h2 class="section-title">Get In Touch</h2>
                <div class="contact-container">
                    <div class="contact-info">
                        <div class="contact-item">
                            <div class="contact-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                            </div>
                            <div class="contact-text">
                                <h3>Phone</h3>
                                <p>(123) 456-7890</p>
                            </div>
                        </div>
                        <div class="contact-item">
                            <div class="contact-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                            </div>
                            <div class="contact-text">
                                <h3>Email</h3>
                                <p>john.caballero@example.com</p>
                            </div>
                        </div>
                        <div class="contact-item">
                            <div class="contact-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                            </div>
                            <div class="contact-text">
                                <h3>Location</h3>
                                <p>San Francisco, CA</p>
                            </div>
                        </div>
                    </div>
                    <div class="contact-form">
                        <div class="form-group">
                            <input type="text" placeholder="Your Name" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="email" placeholder="Your Email" class="form-control">
                        </div>
                        <div class="form-group">
                            <textarea placeholder="Your Message" class="form-control" rows="4"></textarea>
                        </div>
                        <button class="send-message-btn">Send Message</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Add a small script to ensure initialization on Livewire updates -->
    <script>
        document.addEventListener('livewire:navigated', function() {
            // Re-initialize profile functionality after navigation
            if (typeof initializeProfile === 'function') {
                initializeProfile();
            }
        });
        
        // Also ensure it works on first load
        document.addEventListener('DOMContentLoaded', function() {
            // The main initialization will happen in profile.js
            // This is just a fallback
            if (typeof initializeProfile === 'function') {
                setTimeout(initializeProfile, 100);
            }
        });
    </script>
</div>