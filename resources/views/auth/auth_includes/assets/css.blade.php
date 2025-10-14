<style>
    .gradient-bg {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    .glass-effect {
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .glow-effect {
        box-shadow: 0 0 20px rgba(102, 126, 234, 0.3);
        animation: glow 2s ease-in-out infinite alternate;
    }

    @keyframes glow {
        from {
            box-shadow: 0 0 20px rgba(102, 126, 234, 0.3);
        }
        to {
            box-shadow: 0 0 30px rgba(102, 126, 234, 0.5);
        }
    }

    .hover-scale {
        transition: transform 0.2s ease;
    }

    .hover-scale:hover {
        transform: scale(1.02);
    }

    .input-focus {
        transition: all 0.3s ease;
    }

    .input-focus:focus {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }

    .floating-animation {
        animation: floating 3s ease-in-out infinite;
    }

    @keyframes floating {
        0%, 100% {
            transform: translateY(0);
        }
        50% {
            transform: translateY(-10px);
        }
    }

    .fade-in {
        animation: fadeIn 1s ease-out;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .progress-bar {
        transition: width 0.3s ease;
    }

    .strength-weak { background-color: #ef4444; }
    .strength-medium { background-color: #f59e0b; }
    .strength-strong { background-color: #10b981; }
</style>
