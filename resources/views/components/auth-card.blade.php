<main class="flex items-center flex-1 sm:justify-center">
    <style>
        .bubbles {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 0;
            top: 0;
            left: 0;
        }

        .bubble {
            position: absolute;
            bottom: -150px;
            border-radius:20%;
            background: rgba(151, 213, 232, 0.7);
            opacity: 0.6;
            animation: rise 10s infinite ease-in;
        }

        /* Bubble Variasi Ukuran, Kecepatan, dan Posisi */
        .bubble:nth-child(1)  { width: 80px; height: 80px; left: 5%;  animation-duration: 8s; }
        .bubble:nth-child(2)  { width: 60px; height: 60px; left: 10%; animation-duration: 9s; animation-delay: 1s; }
        .bubble:nth-child(3)  { width: 100px; height: 100px; left: 15%; animation-duration: 11s; }
        .bubble:nth-child(4)  { width: 70px; height: 70px; left: 20%; animation-duration: 10s; animation-delay: 0.5s; }
        .bubble:nth-child(5)  { width: 50px; height: 50px; left: 25%; animation-duration: 8s; animation-delay: 1.5s; }
        .bubble:nth-child(6)  { width: 90px; height: 90px; left: 30%; animation-duration: 9s; }
        .bubble:nth-child(7)  { width: 65px; height: 65px; left: 35%; animation-duration: 7s; animation-delay: 0.8s; }
        .bubble:nth-child(8)  { width: 120px; height: 120px; left: 40%; animation-duration: 12s; animation-delay: 2s; }
        .bubble:nth-child(9)  { width: 85px; height: 85px; left: 45%; animation-duration: 10s; }
        .bubble:nth-child(10) { width: 75px; height: 75px; left: 50%; animation-duration: 9s; animation-delay: 1s; }
        .bubble:nth-child(11) { width: 55px; height: 55px; left: 55%; animation-duration: 8s; }
        .bubble:nth-child(12) { width: 60px; height: 60px; left: 60%; animation-duration: 7s; animation-delay: 1.3s; }
        .bubble:nth-child(13) { width: 100px; height: 100px; left: 65%; animation-duration: 12s; }
        .bubble:nth-child(14) { width: 90px; height: 90px; left: 70%; animation-duration: 10s; animation-delay: 2s; }
        .bubble:nth-child(15) { width: 20px; height: 20px; left: 75%; animation-duration: 7s; }
        .bubble:nth-child(16) { width: 80px; height: 80px; left: 80%; animation-duration: 8s; animation-delay: 0.7s; }
        .bubble:nth-child(17) { width: 65px; height: 65px; left: 85%; animation-duration: 9s; }
        .bubble:nth-child(18) { width: 55px; height: 55px; left: 90%; animation-duration: 7s; animation-delay: 1.1s; }
        .bubble:nth-child(19) { width: 75px; height: 75px; left: 95%; animation-duration: 10s; }
        .bubble:nth-child(20) { width: 110px; height: 110px; left: 50%; animation-duration: 12s; animation-delay: 3s; }
        .bubble:nth-child(21) { width: 110px; height: 110px; left: 70%; animation-duration: 5s; animation-delay: 3s; }
        .bubble:nth-child(22) { width: 110px; height: 110px; left: 10%; animation-duration: 8s; animation-delay: 3s; }

        @keyframes rise {
            0% {
                bottom: -150px;
                transform: translateX(0) scale(1);
            }
            50% {
                transform: translateX(30px) scale(1.05);
            }
            100% {
                bottom: 110%;
                transform: translateX(-60px) scale(1.1);
            }
        }
    </style>
    <div class="bubbles">
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
        <div class="bubble"></div>
    </div>
    <div class="h-svh flex-grow hidden md:flex justify-center bg-turquoise-600 items-center">
        <div class="relative z-[90]">
            <x-application-logo class="w-[30em] h-[30em]"/>
        </div>
        <div class="text-white roboto absolute bottom-0">
            <x-footer class="text-white"/>
        </div>

    </div>
    <div class="w-full px-6 py-4 my-6 overflow-hidden bg-white sm:max-w-md dark:bg-dark-eval-1 md:mx-7 z-[100]">
        <div class="text-black my-5 pb-10 border-b pt-5">
            <div class="flex justify-center">
                <a href="/" class="flex gap-3">
                    <x-application-logo class="w-[10em] h-[10em]"/>
                </a>
            </div>
        </div>
        {{ $slot }}
    </div>
</main>
