<x-layouts.app title="Dashboard">
<div class="profile-header">
    <div class="profile-title-container" id="profile-title-container">
        <h1 class="profile-title">{{ auth()->user()->name ?? 'Guest' }}</h1>
        <p class="profile-subtitle">Welcome back, {{ auth()->user()->name ?? 'Guest' }}</p>
    </div>

    <div class="cube-container">
        <div class="cube">
            <div class="cube-face front"></div>
            <div class="cube-face back"></div>
            <div class="cube-face right"></div>
            <div class="cube-face left"></div>
            <div class="cube-face top"></div>
            <div class="cube-face bottom"></div>
        </div>
    </div>
    
    <div class="manila-clock">
        <div class="clock-label">MANILA</div>
        <div id="manila-time">00:00:00</div>
        <div id="manila-date">Loading...</div>
    </div>
    
</div>

<style>
    .profile-header {   
        padding: 1.5rem;
        background: #111118;
        border-radius: 0.25rem;
        margin-bottom: 2rem;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.08);
        overflow: hidden;
        position: relative;
        border: 1px solid rgba(255, 255, 255, 0.05);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .profile-header::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 1px;
        background: linear-gradient(90deg, transparent, rgba(99, 212, 255, 0.5), transparent);
        animation: scanline 4s linear infinite;
    }

    .profile-title-container {
        opacity: 0;
        transform: translateY(10px);
        animation: fadeInUp 0.6s ease forwards;
    }

    .profile-title {
        font-size: 2.2rem;
        font-weight: 300;
        color: #fff;
        margin-bottom: 0.75rem;
        letter-spacing: 0.5px;
    }

    .profile-subtitle {
        color: rgba(255, 255, 255, 0.7);
        font-size: 1rem;
        position: relative;
        display: inline-block;
        font-weight: 300;
        letter-spacing: 0.5px;
    }

    .profile-subtitle::after {
        content: '';
        position: absolute;
        bottom: -5px;
        left: 0;
        width: 0;
        height: 1px;
        background-color: rgba(99, 212, 255, 0.7);
        animation: lineExpand 1.2s ease forwards 0.6s;
    }

    @keyframes fadeInUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes lineExpand {
        to {
            width: 100%;
        }
    }

    @keyframes scanline {
        0% {
            transform: translateX(-100%);
        }
        100% {
            transform: translateX(100%);
        }
    }

    /* Manila Clock Styles */
    .manila-clock {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        background: rgba(17, 17, 24, 0.7);
        border: 1px solid rgba(99, 212, 255, 0.3);
        border-radius: 4px;
        padding: 0.75rem 1.5rem;
        box-shadow: 0 0 15px rgba(99, 212, 255, 0.2);
        position: relative;
    }
    
    .manila-clock::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(45deg, transparent, rgba(99, 212, 255, 0.05), transparent);
        pointer-events: none;
    }
    
    .clock-label {
        font-size: 0.75rem;
        color: rgba(99, 212, 255, 0.8);
        letter-spacing: 2px;
        margin-bottom: 0.25rem;
        font-weight: 500;
    }
    
    #manila-time {
        font-size: 1.5rem;
        font-weight: 300;
        color: rgba(255, 255, 255, 0.9);
        font-family: monospace;
        letter-spacing: 1px;
    }
    
    #manila-date {
        font-size: 0.75rem;
        color: rgba(255, 255, 255, 0.6);
        margin-top: 0.25rem;
    }

    /* 3D Cube Styles */
    .cube-container {
        width: 100px;
        height: 100px;
        perspective: 1000px;
        margin-right: 20px;
    }

    .cube {
        width: 100%;
        height: 100%;
        position: relative;
        transform-style: preserve-3d;
        transform: translateZ(-50px);
        animation: cube-rotate 15s linear infinite;
    }

    .cube-face {
        position: absolute;
        width: 100px;
        height: 100px;
        border: 2px solid rgba(99, 212, 255, 0.4);
        background: rgba(17, 17, 24, 0.7);
        box-shadow: 0 0 15px rgba(99, 212, 255, 0.2);
        opacity: 0.9;
    }

    .front  { 
        transform: rotateY(0deg) translateZ(50px); 
        background: linear-gradient(45deg, rgba(17, 17, 24, 0.9), rgba(99, 212, 255, 0.2));
    }
    .back   { 
        transform: rotateY(180deg) translateZ(50px);
        background: linear-gradient(-45deg, rgba(17, 17, 24, 0.9), rgba(99, 212, 255, 0.2)); 
    }
    .right  { 
        transform: rotateY(90deg) translateZ(50px);
        background: linear-gradient(135deg, rgba(17, 17, 24, 0.9), rgba(99, 212, 255, 0.2)); 
    }
    .left   { 
        transform: rotateY(-90deg) translateZ(50px);
        background: linear-gradient(-135deg, rgba(17, 17, 24, 0.9), rgba(99, 212, 255, 0.2)); 
    }
    .top    { 
        transform: rotateX(90deg) translateZ(50px);
        background: linear-gradient(90deg, rgba(17, 17, 24, 0.9), rgba(99, 212, 255, 0.2)); 
    }
    .bottom { 
        transform: rotateX(-90deg) translateZ(50px);
        background: linear-gradient(-90deg, rgba(17, 17, 24, 0.9), rgba(99, 212, 255, 0.2)); 
    }

    .front::after, .back::after, .right::after, .left::after, .top::after, .bottom::after {
        content: '';
        position: absolute;
        width: 15px;
        height: 15px;
        background: rgba(99, 212, 255, 0.8);
        border-radius: 50%;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        box-shadow: 0 0 10px 2px rgba(99, 212, 255, 0.6);
    }

    @keyframes cube-rotate {
        0% { transform: translateZ(-50px) rotateX(0deg) rotateY(0deg); }
        100% { transform: translateZ(-50px) rotateX(360deg) rotateY(360deg); }
    }

    @media (max-width: 640px) {
        .profile-header {
            flex-direction: column;
            gap: 1rem;
            align-items: center;
            text-align: center;
        }
        
        .manila-clock {
            order: 2;
            margin: 1rem 0;
            width: 100%;
        }
        
        .cube-container {
            order: 3;
            margin-right: 0;
        }
        
        .profile-title-container {
            order: 1;
        }
        
        .cube-container {
            width: 60px;
            height: 60px;
        }
        
        .cube-face {
            width: 60px;
            height: 60px;
        }
        
        .front, .back, .right, .left, .top, .bottom {
            transform-origin: center;
        }
        
        .front  { transform: rotateY(0deg) translateZ(30px); }
        .back   { transform: rotateY(180deg) translateZ(30px); }
        .right  { transform: rotateY(90deg) translateZ(30px); }
        .left   { transform: rotateY(-90deg) translateZ(30px); }
        .top    { transform: rotateX(90deg) translateZ(30px); }
        .bottom { transform: rotateX(-90deg) translateZ(30px); }
        
        .cube {
            transform: translateZ(-30px);
        }
        
        @keyframes cube-rotate {
            0% { transform: translateZ(-30px) rotateX(0deg) rotateY(0deg); }
            100% { transform: translateZ(-30px) rotateX(360deg) rotateY(360deg); }
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const titleContainer = document.getElementById('profile-title-container');
        const manilaTimeElement = document.getElementById('manila-time');
        const manilaDateElement = document.getElementById('manila-date');
        
        // Update Manila time function
        function updateManilaTime() {
            const options = { 
                timeZone: 'Asia/Manila',
                hour: '2-digit', 
                minute: '2-digit',
                second: '2-digit',
                hour12: false
            };
            
            const dateOptions = {
                timeZone: 'Asia/Manila',
                weekday: 'short',
                year: 'numeric',
                month: 'short',
                day: 'numeric'
            };
            
            const manilaTime = new Date().toLocaleTimeString('en-US', options);
            const manilaDate = new Date().toLocaleDateString('en-US', dateOptions);
            
            manilaTimeElement.textContent = manilaTime;
            manilaDateElement.textContent = manilaDate;
        }
        
        // Update time immediately and then every second
        updateManilaTime();
        setInterval(updateManilaTime, 1000);
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    titleContainer.style.animation = 'none';
                    setTimeout(() => {
                        titleContainer.style.animation = 'fadeInUp 0.6s ease forwards';
                    }, 10);
                    observer.unobserve(titleContainer);
                }
            });
        }, { threshold: 0.1 });
        
        observer.observe(titleContainer);
    });
</script>
<livewire:profile />
</x-layouts.app>
