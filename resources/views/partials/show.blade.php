   <style>
       .snow-wrap {
           position: fixed;
           top: 0;
           z-index: 999;
       }

        .snow {
            position: absolute;
            width: 10px;
            height: 10px;
            background: white;
            border-radius: 50%;
            -moz-box-shadow:    inset 0 0 10px rgba(128, 128, 128, 0.3);
            -webkit-box-shadow: inset 0 0 10px rgba(128, 128, 128, 0.3);
            box-shadow:         inset 0 0 10px rgba(128, 128, 128, 0.3);
        }
        .snow:nth-child(1) {
            opacity: 0.8769;
            transform: translate(2.4151vw, -10px) scale(0.9602);
            animation: fall-1 17s -21s linear infinite;
        }
        @keyframes fall-1 {
            75.192% {
                transform: translate(-7.0697vw, 75.192vh) scale(0.9602);
            }
            to {
                transform: translate(-2.3273vw, 100vh) scale(0.9602);
            }
        }
        .snow:nth-child(2) {
            opacity: 0.0588;
            transform: translate(86.9324vw, -10px) scale(0.0898);
            animation: fall-2 11s -15s linear infinite;
        }
        @keyframes fall-2 {
            46.753% {
                transform: translate(86.062vw, 46.753vh) scale(0.0898);
            }
            to {
                transform: translate(86.4972vw, 100vh) scale(0.0898);
            }
        }
        .snow:nth-child(3) {
            opacity: 0.4201;
            transform: translate(93.0807vw, -10px) scale(0.2226);
            animation: fall-3 15s -7s linear infinite;
        }
        @keyframes fall-3 {
            34.544% {
                transform: translate(83.5272vw, 34.544vh) scale(0.2226);
            }
            to {
                transform: translate(88.30395vw, 100vh) scale(0.2226);
            }
        }
        .snow:nth-child(4) {
            opacity: 0.1943;
            transform: translate(17.7918vw, -10px) scale(0.6679);
            animation: fall-4 12s -9s linear infinite;
        }
        @keyframes fall-4 {
            72.505% {
                transform: translate(25.8838vw, 72.505vh) scale(0.6679);
            }
            to {
                transform: translate(21.8378vw, 100vh) scale(0.6679);
            }
        }
        .snow:nth-child(5) {
            opacity: 0.4828;
            transform: translate(37.3109vw, -10px) scale(0.4516);
            animation: fall-5 30s -9s linear infinite;
        }
        @keyframes fall-5 {
            71.754% {
                transform: translate(46.5199vw, 71.754vh) scale(0.4516);
            }
            to {
                transform: translate(41.9154vw, 100vh) scale(0.4516);
            }
        }
        .snow:nth-child(6) {
            opacity: 0.5774;
            transform: translate(67.0576vw, -10px) scale(0.9364);
            animation: fall-6 18s -4s linear infinite;
        }
        @keyframes fall-6 {
            47.474% {
                transform: translate(65.4719vw, 47.474vh) scale(0.9364);
            }
            to {
                transform: translate(66.26475vw, 100vh) scale(0.9364);
            }
        }
        .snow:nth-child(7) {
            opacity: 0.1438;
            transform: translate(39.777vw, -10px) scale(0.2992);
            animation: fall-7 16s -1s linear infinite;
        }
        @keyframes fall-7 {
            40.808% {
                transform: translate(34.3014vw, 40.808vh) scale(0.2992);
            }
            to {
                transform: translate(37.0392vw, 100vh) scale(0.2992);
            }
        }
        .snow:nth-child(8) {
            opacity: 0.3073;
            transform: translate(83.3671vw, -10px) scale(0.6481);
            animation: fall-8 19s -20s linear infinite;
        }
        @keyframes fall-8 {
            47.099% {
                transform: translate(83.6912vw, 47.099vh) scale(0.6481);
            }
            to {
                transform: translate(83.52915vw, 100vh) scale(0.6481);
            }
        }
        .snow:nth-child(9) {
            opacity: 0.8425;
            transform: translate(45.7567vw, -10px) scale(0.1535);
            animation: fall-9 16s -1s linear infinite;
        }
        @keyframes fall-9 {
            32.305% {
                transform: translate(44.2538vw, 32.305vh) scale(0.1535);
            }
            to {
                transform: translate(45.00525vw, 100vh) scale(0.1535);
            }
        }
        .snow:nth-child(10) {
            opacity: 0.465;
            transform: translate(69.5475vw, -10px) scale(0.901);
            animation: fall-10 14s -5s linear infinite;
        }
        @keyframes fall-10 {
            70.999% {
                transform: translate(68.4774vw, 70.999vh) scale(0.901);
            }
            to {
                transform: translate(69.01245vw, 100vh) scale(0.901);
            }
        }
        .snow:nth-child(11) {
            opacity: 0.1664;
            transform: translate(25.2196vw, -10px) scale(0.5728);
            animation: fall-11 16s -18s linear infinite;
        }
        @keyframes fall-11 {
            58.329% {
                transform: translate(19.8058vw, 58.329vh) scale(0.5728);
            }
            to {
                transform: translate(22.5127vw, 100vh) scale(0.5728);
            }
        }
        .snow:nth-child(12) {
            opacity: 0.7566;
            transform: translate(99.9597vw, -10px) scale(0.6836);
            animation: fall-12 29s -19s linear infinite;
        }
        @keyframes fall-12 {
            79.473% {
                transform: translate(90.1267vw, 79.473vh) scale(0.6836);
            }
            to {
                transform: translate(95.0432vw, 100vh) scale(0.6836);
            }
        }
        .snow:nth-child(13) {
            opacity: 0.102;
            transform: translate(59.4245vw, -10px) scale(0.7338);
            animation: fall-13 19s -19s linear infinite;
        }
        @keyframes fall-13 {
            36.914% {
                transform: translate(52.5989vw, 36.914vh) scale(0.7338);
            }
            to {
                transform: translate(56.0117vw, 100vh) scale(0.7338);
            }
        }
        .snow:nth-child(14) {
            opacity: 0.2562;
            transform: translate(74.5477vw, -10px) scale(0.999);
            animation: fall-14 28s -21s linear infinite;
        }
        @keyframes fall-14 {
            54.527% {
                transform: translate(83.903vw, 54.527vh) scale(0.999);
            }
            to {
                transform: translate(79.22535vw, 100vh) scale(0.999);
            }
        }
        .snow:nth-child(15) {
            opacity: 0.845;
            transform: translate(94.1382vw, -10px) scale(0.7542);
            animation: fall-15 11s -21s linear infinite;
        }
        @keyframes fall-15 {
            52.257% {
                transform: translate(88.7809vw, 52.257vh) scale(0.7542);
            }
            to {
                transform: translate(91.45955vw, 100vh) scale(0.7542);
            }
        }
        .snow:nth-child(16) {
            opacity: 0.792;
            transform: translate(42.9912vw, -10px) scale(0.1658);
            animation: fall-16 17s -27s linear infinite;
        }
        @keyframes fall-16 {
            43.031% {
                transform: translate(39.0793vw, 43.031vh) scale(0.1658);
            }
            to {
                transform: translate(41.03525vw, 100vh) scale(0.1658);
            }
        }
        .snow:nth-child(17) {
            opacity: 0.7174;
            transform: translate(9.2026vw, -10px) scale(0.9935);
            animation: fall-17 23s -24s linear infinite;
        }
        @keyframes fall-17 {
            69.646% {
                transform: translate(5.0441vw, 69.646vh) scale(0.9935);
            }
            to {
                transform: translate(7.12335vw, 100vh) scale(0.9935);
            }
        }
        .snow:nth-child(18) {
            opacity: 0.9053;
            transform: translate(16.8656vw, -10px) scale(0.8508);
            animation: fall-18 15s -30s linear infinite;
        }
        @keyframes fall-18 {
            43.571% {
                transform: translate(8.3273vw, 43.571vh) scale(0.8508);
            }
            to {
                transform: translate(12.59645vw, 100vh) scale(0.8508);
            }
        }
        .snow:nth-child(19) {
            opacity: 0.387;
            transform: translate(97.4161vw, -10px) scale(0.16);
            animation: fall-19 19s -29s linear infinite;
        }
        @keyframes fall-19 {
            42.702% {
                transform: translate(89.3216vw, 42.702vh) scale(0.16);
            }
            to {
                transform: translate(93.36885vw, 100vh) scale(0.16);
            }
        }
        .snow:nth-child(20) {
            opacity: 0.5765;
            transform: translate(74.1346vw, -10px) scale(0.4941);
            animation: fall-20 28s -8s linear infinite;
        }
        @keyframes fall-20 {
            73.188% {
                transform: translate(73.3124vw, 73.188vh) scale(0.4941);
            }
            to {
                transform: translate(73.7235vw, 100vh) scale(0.4941);
            }
        }
        .snow:nth-child(21) {
            opacity: 0.3258;
            transform: translate(17.4537vw, -10px) scale(0.58);
            animation: fall-21 13s -12s linear infinite;
        }
        @keyframes fall-21 {
            73.018% {
                transform: translate(9.5663vw, 73.018vh) scale(0.58);
            }
            to {
                transform: translate(13.51vw, 100vh) scale(0.58);
            }
        }
        .snow:nth-child(22) {
            opacity: 0.5515;
            transform: translate(42.8674vw, -10px) scale(0.9166);
            animation: fall-22 10s -12s linear infinite;
        }
        @keyframes fall-22 {
            51.629% {
                transform: translate(44.4915vw, 51.629vh) scale(0.9166);
            }
            to {
                transform: translate(43.67945vw, 100vh) scale(0.9166);
            }
        }
        .snow:nth-child(23) {
            opacity: 0.2431;
            transform: translate(1.876vw, -10px) scale(0.4021);
            animation: fall-23 10s -25s linear infinite;
        }
        @keyframes fall-23 {
            40.18% {
                transform: translate(-3.2991vw, 40.18vh) scale(0.4021);
            }
            to {
                transform: translate(-0.71155vw, 100vh) scale(0.4021);
            }
        }
        .snow:nth-child(24) {
            opacity: 0.4214;
            transform: translate(49.161vw, -10px) scale(0.2577);
            animation: fall-24 28s -8s linear infinite;
        }
        @keyframes fall-24 {
            41.102% {
                transform: translate(51.5218vw, 41.102vh) scale(0.2577);
            }
            to {
                transform: translate(50.3414vw, 100vh) scale(0.2577);
            }
        }
        .snow:nth-child(25) {
            opacity: 0.6987;
            transform: translate(80.6196vw, -10px) scale(0.0007);
            animation: fall-25 12s -24s linear infinite;
        }
        @keyframes fall-25 {
            40.664% {
                transform: translate(73.1909vw, 40.664vh) scale(0.0007);
            }
            to {
                transform: translate(76.90525vw, 100vh) scale(0.0007);
            }
        }
        .snow:nth-child(26) {
            opacity: 0.0657;
            transform: translate(63.3496vw, -10px) scale(0.7874);
            animation: fall-26 18s -19s linear infinite;
        }
        @keyframes fall-26 {
            33.029% {
                transform: translate(69.0139vw, 33.029vh) scale(0.7874);
            }
            to {
                transform: translate(66.18175vw, 100vh) scale(0.7874);
            }
        }
        .snow:nth-child(27) {
            opacity: 0.9947;
            transform: translate(16.9978vw, -10px) scale(0.5452);
            animation: fall-27 16s -5s linear infinite;
        }
        @keyframes fall-27 {
            53.164% {
                transform: translate(19.5571vw, 53.164vh) scale(0.5452);
            }
            to {
                transform: translate(18.27745vw, 100vh) scale(0.5452);
            }
        }
        .snow:nth-child(28) {
            opacity: 0.9707;
            transform: translate(34.1559vw, -10px) scale(0.2739);
            animation: fall-28 15s -12s linear infinite;
        }
        @keyframes fall-28 {
            64.998% {
                transform: translate(25.5711vw, 64.998vh) scale(0.2739);
            }
            to {
                transform: translate(29.8635vw, 100vh) scale(0.2739);
            }
        }
        .snow:nth-child(29) {
            opacity: 0.3642;
            transform: translate(92.469vw, -10px) scale(0.5675);
            animation: fall-29 29s -12s linear infinite;
        }
        @keyframes fall-29 {
            47.281% {
                transform: translate(95.1579vw, 47.281vh) scale(0.5675);
            }
            to {
                transform: translate(93.81345vw, 100vh) scale(0.5675);
            }
        }
        .snow:nth-child(30) {
            opacity: 0.4769;
            transform: translate(22.5342vw, -10px) scale(0.5);
            animation: fall-30 27s -23s linear infinite;
        }
        @keyframes fall-30 {
            68.7% {
                transform: translate(30.3876vw, 68.7vh) scale(0.5);
            }
            to {
                transform: translate(26.4609vw, 100vh) scale(0.5);
            }
        }
        .snow:nth-child(31) {
            opacity: 0.3907;
            transform: translate(70.2793vw, -10px) scale(0.3137);
            animation: fall-31 27s -26s linear infinite;
        }
        @keyframes fall-31 {
            66.908% {
                transform: translate(68.278vw, 66.908vh) scale(0.3137);
            }
            to {
                transform: translate(69.27865vw, 100vh) scale(0.3137);
            }
        }
        .snow:nth-child(32) {
            opacity: 0.0644;
            transform: translate(37.9836vw, -10px) scale(0.478);
            animation: fall-32 10s -8s linear infinite;
        }
        @keyframes fall-32 {
            36.331% {
                transform: translate(45.8591vw, 36.331vh) scale(0.478);
            }
            to {
                transform: translate(41.92135vw, 100vh) scale(0.478);
            }
        }
        .snow:nth-child(33) {
            opacity: 0.2812;
            transform: translate(44.3295vw, -10px) scale(0.6851);
            animation: fall-33 24s -1s linear infinite;
        }
        @keyframes fall-33 {
            55.998% {
                transform: translate(48.7605vw, 55.998vh) scale(0.6851);
            }
            to {
                transform: translate(46.545vw, 100vh) scale(0.6851);
            }
        }
        .snow:nth-child(34) {
            opacity: 0.1921;
            transform: translate(26.4893vw, -10px) scale(0.445);
            animation: fall-34 10s -17s linear infinite;
        }
        @keyframes fall-34 {
            43.764% {
                transform: translate(27.5087vw, 43.764vh) scale(0.445);
            }
            to {
                transform: translate(26.999vw, 100vh) scale(0.445);
            }
        }
        .snow:nth-child(35) {
            opacity: 0.6203;
            transform: translate(13.6284vw, -10px) scale(0.6004);
            animation: fall-35 28s -5s linear infinite;
        }
        @keyframes fall-35 {
            42.164% {
                transform: translate(10.4332vw, 42.164vh) scale(0.6004);
            }
            to {
                transform: translate(12.0308vw, 100vh) scale(0.6004);
            }
        }
        .snow:nth-child(36) {
            opacity: 0.8696;
            transform: translate(92.3997vw, -10px) scale(0.2984);
            animation: fall-36 20s -6s linear infinite;
        }
        @keyframes fall-36 {
            34.762% {
                transform: translate(100.6994vw, 34.762vh) scale(0.2984);
            }
            to {
                transform: translate(96.54955vw, 100vh) scale(0.2984);
            }
        }
        .snow:nth-child(37) {
            opacity: 0.4891;
            transform: translate(10.8901vw, -10px) scale(0.7953);
            animation: fall-37 19s -5s linear infinite;
        }
        @keyframes fall-37 {
            41.126% {
                transform: translate(8.0525vw, 41.126vh) scale(0.7953);
            }
            to {
                transform: translate(9.4713vw, 100vh) scale(0.7953);
            }
        }
        .snow:nth-child(38) {
            opacity: 0.8274;
            transform: translate(76.3944vw, -10px) scale(0.6574);
            animation: fall-38 10s -20s linear infinite;
        }
        @keyframes fall-38 {
            63.083% {
                transform: translate(70.0454vw, 63.083vh) scale(0.6574);
            }
            to {
                transform: translate(73.2199vw, 100vh) scale(0.6574);
            }
        }
        .snow:nth-child(39) {
            opacity: 0.999;
            transform: translate(67.0921vw, -10px) scale(0.0553);
            animation: fall-39 10s -21s linear infinite;
        }
        @keyframes fall-39 {
            60.656% {
                transform: translate(65.1215vw, 60.656vh) scale(0.0553);
            }
            to {
                transform: translate(66.1068vw, 100vh) scale(0.0553);
            }
        }
        .snow:nth-child(40) {
            opacity: 0.7026;
            transform: translate(70.5596vw, -10px) scale(0.1889);
            animation: fall-40 15s -11s linear infinite;
        }
        @keyframes fall-40 {
            42.264% {
                transform: translate(66.1392vw, 42.264vh) scale(0.1889);
            }
            to {
                transform: translate(68.3494vw, 100vh) scale(0.1889);
            }
        }
        .snow:nth-child(41) {
            opacity: 0.6859;
            transform: translate(14.2295vw, -10px) scale(0.9578);
            animation: fall-41 15s -8s linear infinite;
        }
        @keyframes fall-41 {
            64.86% {
                transform: translate(15.2085vw, 64.86vh) scale(0.9578);
            }
            to {
                transform: translate(14.719vw, 100vh) scale(0.9578);
            }
        }
        .snow:nth-child(42) {
            opacity: 0.4589;
            transform: translate(72.3809vw, -10px) scale(0.9539);
            animation: fall-42 11s -24s linear infinite;
        }
        @keyframes fall-42 {
            75.833% {
                transform: translate(82.1567vw, 75.833vh) scale(0.9539);
            }
            to {
                transform: translate(77.2688vw, 100vh) scale(0.9539);
            }
        }
        .snow:nth-child(43) {
            opacity: 0.829;
            transform: translate(31.5022vw, -10px) scale(0.8371);
            animation: fall-43 12s -3s linear infinite;
        }
        @keyframes fall-43 {
            75.9% {
                transform: translate(31.6574vw, 75.9vh) scale(0.8371);
            }
            to {
                transform: translate(31.5798vw, 100vh) scale(0.8371);
            }
        }
        .snow:nth-child(44) {
            opacity: 0.3706;
            transform: translate(63.7787vw, -10px) scale(0.5391);
            animation: fall-44 18s -28s linear infinite;
        }
        @keyframes fall-44 {
            64.943% {
                transform: translate(72.9947vw, 64.943vh) scale(0.5391);
            }
            to {
                transform: translate(68.3867vw, 100vh) scale(0.5391);
            }
        }
        .snow:nth-child(45) {
            opacity: 0.1957;
            transform: translate(10.6941vw, -10px) scale(0.7863);
            animation: fall-45 30s -7s linear infinite;
        }
        @keyframes fall-45 {
            74.125% {
                transform: translate(13.3148vw, 74.125vh) scale(0.7863);
            }
            to {
                transform: translate(12.00445vw, 100vh) scale(0.7863);
            }
        }
        .snow:nth-child(46) {
            opacity: 0.7032;
            transform: translate(42.2141vw, -10px) scale(0.59);
            animation: fall-46 23s -1s linear infinite;
        }
        @keyframes fall-46 {
            69.039% {
                transform: translate(40.8176vw, 69.039vh) scale(0.59);
            }
            to {
                transform: translate(41.51585vw, 100vh) scale(0.59);
            }
        }
        .snow:nth-child(47) {
            opacity: 0.2368;
            transform: translate(82.3393vw, -10px) scale(0.2364);
            animation: fall-47 12s -3s linear infinite;
        }
        @keyframes fall-47 {
            54.871% {
                transform: translate(88.2884vw, 54.871vh) scale(0.2364);
            }
            to {
                transform: translate(85.31385vw, 100vh) scale(0.2364);
            }
        }
        .snow:nth-child(48) {
            opacity: 0.9529;
            transform: translate(79.3662vw, -10px) scale(0.1138);
            animation: fall-48 14s -21s linear infinite;
        }
        @keyframes fall-48 {
            47.809% {
                transform: translate(76.8313vw, 47.809vh) scale(0.1138);
            }
            to {
                transform: translate(78.09875vw, 100vh) scale(0.1138);
            }
        }
        .snow:nth-child(49) {
            opacity: 0.0105;
            transform: translate(69.4186vw, -10px) scale(0.0941);
            animation: fall-49 12s -19s linear infinite;
        }
        @keyframes fall-49 {
            54.649% {
                transform: translate(75.2583vw, 54.649vh) scale(0.0941);
            }
            to {
                transform: translate(72.33845vw, 100vh) scale(0.0941);
            }
        }
        .snow:nth-child(50) {
            opacity: 0.0896;
            transform: translate(56.38vw, -10px) scale(0.1218);
            animation: fall-50 22s -16s linear infinite;
        }
        @keyframes fall-50 {
            43.71% {
                transform: translate(47.8552vw, 43.71vh) scale(0.1218);
            }
            to {
                transform: translate(52.1176vw, 100vh) scale(0.1218);
            }
        }
        .snow:nth-child(51) {
            opacity: 0.9839;
            transform: translate(94.5158vw, -10px) scale(0.2382);
            animation: fall-51 30s -10s linear infinite;
        }
        @keyframes fall-51 {
            48.745% {
                transform: translate(99.7832vw, 48.745vh) scale(0.2382);
            }
            to {
                transform: translate(97.1495vw, 100vh) scale(0.2382);
            }
        }
        .snow:nth-child(52) {
            opacity: 0.4801;
            transform: translate(31.3215vw, -10px) scale(0.0116);
            animation: fall-52 12s -9s linear infinite;
        }
        @keyframes fall-52 {
            56.92% {
                transform: translate(38.1098vw, 56.92vh) scale(0.0116);
            }
            to {
                transform: translate(34.71565vw, 100vh) scale(0.0116);
            }
        }
        .snow:nth-child(53) {
            opacity: 0.8776;
            transform: translate(23.1549vw, -10px) scale(0.4477);
            animation: fall-53 26s -12s linear infinite;
        }
        @keyframes fall-53 {
            74.33% {
                transform: translate(19.197vw, 74.33vh) scale(0.4477);
            }
            to {
                transform: translate(21.17595vw, 100vh) scale(0.4477);
            }
        }
        .snow:nth-child(54) {
            opacity: 0.5654;
            transform: translate(0.9023vw, -10px) scale(0.1331);
            animation: fall-54 27s -28s linear infinite;
        }
        @keyframes fall-54 {
            58.28% {
                transform: translate(-3.1078vw, 58.28vh) scale(0.1331);
            }
            to {
                transform: translate(-1.10275vw, 100vh) scale(0.1331);
            }
        }
        .snow:nth-child(55) {
            opacity: 0.081;
            transform: translate(11.7247vw, -10px) scale(0.3412);
            animation: fall-55 16s -14s linear infinite;
        }
        @keyframes fall-55 {
            54.51% {
                transform: translate(19.1005vw, 54.51vh) scale(0.3412);
            }
            to {
                transform: translate(15.4126vw, 100vh) scale(0.3412);
            }
        }
        .snow:nth-child(56) {
            opacity: 0.1228;
            transform: translate(55.4528vw, -10px) scale(0.543);
            animation: fall-56 13s -11s linear infinite;
        }
        @keyframes fall-56 {
            48.843% {
                transform: translate(53.9095vw, 48.843vh) scale(0.543);
            }
            to {
                transform: translate(54.68115vw, 100vh) scale(0.543);
            }
        }
        .snow:nth-child(57) {
            opacity: 0.7489;
            transform: translate(58.4849vw, -10px) scale(0.3715);
            animation: fall-57 22s -25s linear infinite;
        }
        @keyframes fall-57 {
            55.311% {
                transform: translate(58.3601vw, 55.311vh) scale(0.3715);
            }
            to {
                transform: translate(58.4225vw, 100vh) scale(0.3715);
            }
        }
        .snow:nth-child(58) {
            opacity: 0.9928;
            transform: translate(80.1185vw, -10px) scale(0.6324);
            animation: fall-58 16s -30s linear infinite;
        }
        @keyframes fall-58 {
            54.821% {
                transform: translate(81.9992vw, 54.821vh) scale(0.6324);
            }
            to {
                transform: translate(81.05885vw, 100vh) scale(0.6324);
            }
        }
        .snow:nth-child(59) {
            opacity: 0.3373;
            transform: translate(75.6803vw, -10px) scale(0.6889);
            animation: fall-59 15s -2s linear infinite;
        }
        @keyframes fall-59 {
            58.662% {
                transform: translate(66.842vw, 58.662vh) scale(0.6889);
            }
            to {
                transform: translate(71.26115vw, 100vh) scale(0.6889);
            }
        }
        .snow:nth-child(60) {
            opacity: 0.9517;
            transform: translate(5.9328vw, -10px) scale(0.1266);
            animation: fall-60 14s -11s linear infinite;
        }
        @keyframes fall-60 {
            30.92% {
                transform: translate(-1.7259vw, 30.92vh) scale(0.1266);
            }
            to {
                transform: translate(2.10345vw, 100vh) scale(0.1266);
            }
        }
        .snow:nth-child(61) {
            opacity: 0.35;
            transform: translate(50.9874vw, -10px) scale(0.5071);
            animation: fall-61 25s -24s linear infinite;
        }
        @keyframes fall-61 {
            69.741% {
                transform: translate(53.6088vw, 69.741vh) scale(0.5071);
            }
            to {
                transform: translate(52.2981vw, 100vh) scale(0.5071);
            }
        }
        .snow:nth-child(62) {
            opacity: 0.342;
            transform: translate(79.9365vw, -10px) scale(0.8787);
            animation: fall-62 21s -29s linear infinite;
        }
        @keyframes fall-62 {
            35.352% {
                transform: translate(76.5228vw, 35.352vh) scale(0.8787);
            }
            to {
                transform: translate(78.22965vw, 100vh) scale(0.8787);
            }
        }
        .snow:nth-child(63) {
            opacity: 0.2164;
            transform: translate(10.109vw, -10px) scale(0.174);
            animation: fall-63 13s -17s linear infinite;
        }
        @keyframes fall-63 {
            79.457% {
                transform: translate(3.6025vw, 79.457vh) scale(0.174);
            }
            to {
                transform: translate(6.85575vw, 100vh) scale(0.174);
            }
        }
        .snow:nth-child(64) {
            opacity: 0.011;
            transform: translate(24.029vw, -10px) scale(0.8131);
            animation: fall-64 13s -12s linear infinite;
        }
        @keyframes fall-64 {
            76.801% {
                transform: translate(26.5901vw, 76.801vh) scale(0.8131);
            }
            to {
                transform: translate(25.30955vw, 100vh) scale(0.8131);
            }
        }
        .snow:nth-child(65) {
            opacity: 0.1962;
            transform: translate(19.3675vw, -10px) scale(0.9882);
            animation: fall-65 18s -28s linear infinite;
        }
        @keyframes fall-65 {
            30.18% {
                transform: translate(18.3502vw, 30.18vh) scale(0.9882);
            }
            to {
                transform: translate(18.85885vw, 100vh) scale(0.9882);
            }
        }
        .snow:nth-child(66) {
            opacity: 0.5076;
            transform: translate(59.2701vw, -10px) scale(0.0448);
            animation: fall-66 21s -27s linear infinite;
        }
        @keyframes fall-66 {
            46.802% {
                transform: translate(52.5915vw, 46.802vh) scale(0.0448);
            }
            to {
                transform: translate(55.9308vw, 100vh) scale(0.0448);
            }
        }
        .snow:nth-child(67) {
            opacity: 0.9143;
            transform: translate(97.5984vw, -10px) scale(0.638);
            animation: fall-67 18s -6s linear infinite;
        }
        @keyframes fall-67 {
            73.381% {
                transform: translate(88.3217vw, 73.381vh) scale(0.638);
            }
            to {
                transform: translate(92.96005vw, 100vh) scale(0.638);
            }
        }
        .snow:nth-child(68) {
            opacity: 0.5542;
            transform: translate(97.265vw, -10px) scale(0.5232);
            animation: fall-68 30s -27s linear infinite;
        }
        @keyframes fall-68 {
            69.051% {
                transform: translate(88.0281vw, 69.051vh) scale(0.5232);
            }
            to {
                transform: translate(92.64655vw, 100vh) scale(0.5232);
            }
        }
        .snow:nth-child(69) {
            opacity: 0.5366;
            transform: translate(48.6363vw, -10px) scale(0.8019);
            animation: fall-69 20s -22s linear infinite;
        }
        @keyframes fall-69 {
            56.445% {
                transform: translate(57.0749vw, 56.445vh) scale(0.8019);
            }
            to {
                transform: translate(52.8556vw, 100vh) scale(0.8019);
            }
        }
        .snow:nth-child(70) {
            opacity: 0.1702;
            transform: translate(49.2747vw, -10px) scale(0.1255);
            animation: fall-70 24s -13s linear infinite;
        }
        @keyframes fall-70 {
            64.268% {
                transform: translate(57.6946vw, 64.268vh) scale(0.1255);
            }
            to {
                transform: translate(53.48465vw, 100vh) scale(0.1255);
            }
        }
        .snow:nth-child(71) {
            opacity: 0.593;
            transform: translate(85.6549vw, -10px) scale(0.8955);
            animation: fall-71 28s -16s linear infinite;
        }
        @keyframes fall-71 {
            34.258% {
                transform: translate(80.1199vw, 34.258vh) scale(0.8955);
            }
            to {
                transform: translate(82.8874vw, 100vh) scale(0.8955);
            }
        }
        .snow:nth-child(72) {
            opacity: 0.2118;
            transform: translate(95.287vw, -10px) scale(0.7331);
            animation: fall-72 12s -25s linear infinite;
        }
        @keyframes fall-72 {
            48.717% {
                transform: translate(86.5346vw, 48.717vh) scale(0.7331);
            }
            to {
                transform: translate(90.9108vw, 100vh) scale(0.7331);
            }
        }
        .snow:nth-child(73) {
            opacity: 0.73;
            transform: translate(58.5787vw, -10px) scale(0.9206);
            animation: fall-73 13s -1s linear infinite;
        }
        @keyframes fall-73 {
            36.979% {
                transform: translate(58.7972vw, 36.979vh) scale(0.9206);
            }
            to {
                transform: translate(58.68795vw, 100vh) scale(0.9206);
            }
        }
        .snow:nth-child(74) {
            opacity: 0.1119;
            transform: translate(20.8404vw, -10px) scale(0.1367);
            animation: fall-74 19s -8s linear infinite;
        }
        @keyframes fall-74 {
            68.697% {
                transform: translate(17.0862vw, 68.697vh) scale(0.1367);
            }
            to {
                transform: translate(18.9633vw, 100vh) scale(0.1367);
            }
        }
        .snow:nth-child(75) {
            opacity: 0.479;
            transform: translate(61.2258vw, -10px) scale(0.5475);
            animation: fall-75 14s -7s linear infinite;
        }
        @keyframes fall-75 {
            48.929% {
                transform: translate(62.5011vw, 48.929vh) scale(0.5475);
            }
            to {
                transform: translate(61.86345vw, 100vh) scale(0.5475);
            }
        }
        .snow:nth-child(76) {
            opacity: 0.2204;
            transform: translate(1.1764vw, -10px) scale(0.5707);
            animation: fall-76 25s -12s linear infinite;
        }
        @keyframes fall-76 {
            66.103% {
                transform: translate(-6.9718vw, 66.103vh) scale(0.5707);
            }
            to {
                transform: translate(-2.8977vw, 100vh) scale(0.5707);
            }
        }
        .snow:nth-child(77) {
            opacity: 0.957;
            transform: translate(20.4909vw, -10px) scale(0.1077);
            animation: fall-77 24s -29s linear infinite;
        }
        @keyframes fall-77 {
            73.941% {
                transform: translate(16.1325vw, 73.941vh) scale(0.1077);
            }
            to {
                transform: translate(18.3117vw, 100vh) scale(0.1077);
            }
        }
        .snow:nth-child(78) {
            opacity: 0.2076;
            transform: translate(77.0313vw, -10px) scale(0.2627);
            animation: fall-78 19s -18s linear infinite;
        }
        @keyframes fall-78 {
            58.312% {
                transform: translate(70.5616vw, 58.312vh) scale(0.2627);
            }
            to {
                transform: translate(73.79645vw, 100vh) scale(0.2627);
            }
        }
        .snow:nth-child(79) {
            opacity: 0.875;
            transform: translate(51.1525vw, -10px) scale(0.8307);
            animation: fall-79 19s -14s linear infinite;
        }
        @keyframes fall-79 {
            68.527% {
                transform: translate(48.6459vw, 68.527vh) scale(0.8307);
            }
            to {
                transform: translate(49.8992vw, 100vh) scale(0.8307);
            }
        }
        .snow:nth-child(80) {
            opacity: 0.0559;
            transform: translate(32.2406vw, -10px) scale(0.1027);
            animation: fall-80 21s -15s linear infinite;
        }
        @keyframes fall-80 {
            68.437% {
                transform: translate(25.9937vw, 68.437vh) scale(0.1027);
            }
            to {
                transform: translate(29.11715vw, 100vh) scale(0.1027);
            }
        }
        .snow:nth-child(81) {
            opacity: 0.6691;
            transform: translate(76.1606vw, -10px) scale(0.1355);
            animation: fall-81 21s -4s linear infinite;
        }
        @keyframes fall-81 {
            36.596% {
                transform: translate(75.3529vw, 36.596vh) scale(0.1355);
            }
            to {
                transform: translate(75.75675vw, 100vh) scale(0.1355);
            }
        }
        .snow:nth-child(82) {
            opacity: 0.8709;
            transform: translate(52.5072vw, -10px) scale(0.0769);
            animation: fall-82 12s -15s linear infinite;
        }
        @keyframes fall-82 {
            63.86% {
                transform: translate(52.3778vw, 63.86vh) scale(0.0769);
            }
            to {
                transform: translate(52.4425vw, 100vh) scale(0.0769);
            }
        }
        .snow:nth-child(83) {
            opacity: 0.3233;
            transform: translate(22.3154vw, -10px) scale(0.0023);
            animation: fall-83 24s -13s linear infinite;
        }
        @keyframes fall-83 {
            76.389% {
                transform: translate(26.0243vw, 76.389vh) scale(0.0023);
            }
            to {
                transform: translate(24.16985vw, 100vh) scale(0.0023);
            }
        }
        .snow:nth-child(84) {
            opacity: 0.1094;
            transform: translate(0.806vw, -10px) scale(0.7445);
            animation: fall-84 21s -7s linear infinite;
        }
        @keyframes fall-84 {
            51.947% {
                transform: translate(-4.113vw, 51.947vh) scale(0.7445);
            }
            to {
                transform: translate(-1.6535vw, 100vh) scale(0.7445);
            }
        }
        .snow:nth-child(85) {
            opacity: 0.7791;
            transform: translate(68.2014vw, -10px) scale(0.6104);
            animation: fall-85 22s -5s linear infinite;
        }
        @keyframes fall-85 {
            60.464% {
                transform: translate(68.4381vw, 60.464vh) scale(0.6104);
            }
            to {
                transform: translate(68.31975vw, 100vh) scale(0.6104);
            }
        }
        .snow:nth-child(86) {
            opacity: 0.3144;
            transform: translate(94.3174vw, -10px) scale(0.4638);
            animation: fall-86 18s -12s linear infinite;
        }
        @keyframes fall-86 {
            46.145% {
                transform: translate(86.1623vw, 46.145vh) scale(0.4638);
            }
            to {
                transform: translate(90.23985vw, 100vh) scale(0.4638);
            }
        }
        .snow:nth-child(87) {
            opacity: 0.7056;
            transform: translate(59.185vw, -10px) scale(0.0571);
            animation: fall-87 26s -2s linear infinite;
        }
        @keyframes fall-87 {
            35.724% {
                transform: translate(60.3962vw, 35.724vh) scale(0.0571);
            }
            to {
                transform: translate(59.7906vw, 100vh) scale(0.0571);
            }
        }
        .snow:nth-child(88) {
            opacity: 0.0806;
            transform: translate(14.4147vw, -10px) scale(0.217);
            animation: fall-88 15s -11s linear infinite;
        }
        @keyframes fall-88 {
            47.915% {
                transform: translate(6.0275vw, 47.915vh) scale(0.217);
            }
            to {
                transform: translate(10.2211vw, 100vh) scale(0.217);
            }
        }
        .snow:nth-child(89) {
            opacity: 0.0861;
            transform: translate(47.5698vw, -10px) scale(0.6714);
            animation: fall-89 24s -19s linear infinite;
        }
        @keyframes fall-89 {
            51.118% {
                transform: translate(40.7435vw, 51.118vh) scale(0.6714);
            }
            to {
                transform: translate(44.15665vw, 100vh) scale(0.6714);
            }
        }
        .snow:nth-child(90) {
            opacity: 0.1453;
            transform: translate(3.0803vw, -10px) scale(0.7487);
            animation: fall-90 14s -30s linear infinite;
        }
        @keyframes fall-90 {
            45.026% {
                transform: translate(12.7674vw, 45.026vh) scale(0.7487);
            }
            to {
                transform: translate(7.92385vw, 100vh) scale(0.7487);
            }
        }
        .snow:nth-child(91) {
            opacity: 0.0456;
            transform: translate(63.3886vw, -10px) scale(0.1736);
            animation: fall-91 23s -13s linear infinite;
        }
        @keyframes fall-91 {
            66.303% {
                transform: translate(73.3219vw, 66.303vh) scale(0.1736);
            }
            to {
                transform: translate(68.35525vw, 100vh) scale(0.1736);
            }
        }
        .snow:nth-child(92) {
            opacity: 0.0194;
            transform: translate(36.0326vw, -10px) scale(0.3112);
            animation: fall-92 29s -25s linear infinite;
        }
        @keyframes fall-92 {
            60.935% {
                transform: translate(35.1362vw, 60.935vh) scale(0.3112);
            }
            to {
                transform: translate(35.5844vw, 100vh) scale(0.3112);
            }
        }
        .snow:nth-child(93) {
            opacity: 0.3024;
            transform: translate(77.8942vw, -10px) scale(0.0324);
            animation: fall-93 21s -12s linear infinite;
        }
        @keyframes fall-93 {
            47.067% {
                transform: translate(78.7981vw, 47.067vh) scale(0.0324);
            }
            to {
                transform: translate(78.34615vw, 100vh) scale(0.0324);
            }
        }
        .snow:nth-child(94) {
            opacity: 0.6699;
            transform: translate(14.6521vw, -10px) scale(0.1281);
            animation: fall-94 16s -9s linear infinite;
        }
        @keyframes fall-94 {
            44.71% {
                transform: translate(21.3987vw, 44.71vh) scale(0.1281);
            }
            to {
                transform: translate(18.0254vw, 100vh) scale(0.1281);
            }
        }
        .snow:nth-child(95) {
            opacity: 0.1982;
            transform: translate(82.3756vw, -10px) scale(0.2749);
            animation: fall-95 23s -3s linear infinite;
        }
        @keyframes fall-95 {
            72.047% {
                transform: translate(75.1579vw, 72.047vh) scale(0.2749);
            }
            to {
                transform: translate(78.76675vw, 100vh) scale(0.2749);
            }
        }
        .snow:nth-child(96) {
            opacity: 0.5603;
            transform: translate(38.8805vw, -10px) scale(0.1993);
            animation: fall-96 13s -2s linear infinite;
        }
        @keyframes fall-96 {
            75.063% {
                transform: translate(34.3989vw, 75.063vh) scale(0.1993);
            }
            to {
                transform: translate(36.6397vw, 100vh) scale(0.1993);
            }
        }
        .snow:nth-child(97) {
            opacity: 0.947;
            transform: translate(41.0848vw, -10px) scale(0.7338);
            animation: fall-97 17s -29s linear infinite;
        }
        @keyframes fall-97 {
            65.797% {
                transform: translate(33.3395vw, 65.797vh) scale(0.7338);
            }
            to {
                transform: translate(37.21215vw, 100vh) scale(0.7338);
            }
        }
        .snow:nth-child(98) {
            opacity: 0.3997;
            transform: translate(98.9877vw, -10px) scale(0.3244);
            animation: fall-98 14s -24s linear infinite;
        }
        @keyframes fall-98 {
            44.914% {
                transform: translate(96.2265vw, 44.914vh) scale(0.3244);
            }
            to {
                transform: translate(97.6071vw, 100vh) scale(0.3244);
            }
        }
        .snow:nth-child(99) {
            opacity: 0.2604;
            transform: translate(90.9414vw, -10px) scale(0.5658);
            animation: fall-99 16s -19s linear infinite;
        }
        @keyframes fall-99 {
            42.02% {
                transform: translate(92.0336vw, 42.02vh) scale(0.5658);
            }
            to {
                transform: translate(91.4875vw, 100vh) scale(0.5658);
            }
        }
        .snow:nth-child(100) {
            opacity: 0.318;
            transform: translate(6.7257vw, -10px) scale(0.8311);
            animation: fall-100 28s -11s linear infinite;
        }
        @keyframes fall-100 {
            65.044% {
                transform: translate(2.1828vw, 65.044vh) scale(0.8311);
            }
            to {
                transform: translate(4.45425vw, 100vh) scale(0.8311);
            }
        }
        .snow:nth-child(101) {
            opacity: 0.0701;
            transform: translate(84.7412vw, -10px) scale(0.2032);
            animation: fall-101 12s -23s linear infinite;
        }
        @keyframes fall-101 {
            64.628% {
                transform: translate(77.6623vw, 64.628vh) scale(0.2032);
            }
            to {
                transform: translate(81.20175vw, 100vh) scale(0.2032);
            }
        }
        .snow:nth-child(102) {
            opacity: 0.3385;
            transform: translate(47.3951vw, -10px) scale(0.9145);
            animation: fall-102 14s -21s linear infinite;
        }
        @keyframes fall-102 {
            31.754% {
                transform: translate(44.288vw, 31.754vh) scale(0.9145);
            }
            to {
                transform: translate(45.84155vw, 100vh) scale(0.9145);
            }
        }
        .snow:nth-child(103) {
            opacity: 0.6815;
            transform: translate(69.6224vw, -10px) scale(0.3831);
            animation: fall-103 24s -2s linear infinite;
        }
        @keyframes fall-103 {
            52.992% {
                transform: translate(70.9462vw, 52.992vh) scale(0.3831);
            }
            to {
                transform: translate(70.2843vw, 100vh) scale(0.3831);
            }
        }
        .snow:nth-child(104) {
            opacity: 0.8449;
            transform: translate(84.9039vw, -10px) scale(0.6097);
            animation: fall-104 17s -9s linear infinite;
        }
        @keyframes fall-104 {
            69.948% {
                transform: translate(93.802vw, 69.948vh) scale(0.6097);
            }
            to {
                transform: translate(89.35295vw, 100vh) scale(0.6097);
            }
        }
        .snow:nth-child(105) {
            opacity: 0.6037;
            transform: translate(68.5003vw, -10px) scale(0.9816);
            animation: fall-105 30s -15s linear infinite;
        }
        @keyframes fall-105 {
            36.958% {
                transform: translate(62.8778vw, 36.958vh) scale(0.9816);
            }
            to {
                transform: translate(65.68905vw, 100vh) scale(0.9816);
            }
        }
        .snow:nth-child(106) {
            opacity: 0.6407;
            transform: translate(88.4515vw, -10px) scale(0.7038);
            animation: fall-106 29s -30s linear infinite;
        }
        @keyframes fall-106 {
            59.441% {
                transform: translate(83.1437vw, 59.441vh) scale(0.7038);
            }
            to {
                transform: translate(85.7976vw, 100vh) scale(0.7038);
            }
        }
        .snow:nth-child(107) {
            opacity: 0.4446;
            transform: translate(41.5715vw, -10px) scale(0.0502);
            animation: fall-107 23s -26s linear infinite;
        }
        @keyframes fall-107 {
            79.996% {
                transform: translate(49.7195vw, 79.996vh) scale(0.0502);
            }
            to {
                transform: translate(45.6455vw, 100vh) scale(0.0502);
            }
        }
        .snow:nth-child(108) {
            opacity: 0.9305;
            transform: translate(94.1005vw, -10px) scale(0.568);
            animation: fall-108 24s -22s linear infinite;
        }
        @keyframes fall-108 {
            47.858% {
                transform: translate(92.0742vw, 47.858vh) scale(0.568);
            }
            to {
                transform: translate(93.08735vw, 100vh) scale(0.568);
            }
        }
        .snow:nth-child(109) {
            opacity: 0.4231;
            transform: translate(1.1406vw, -10px) scale(0.8836);
            animation: fall-109 11s -4s linear infinite;
        }
        @keyframes fall-109 {
            63.368% {
                transform: translate(-1.5358vw, 63.368vh) scale(0.8836);
            }
            to {
                transform: translate(-0.1976vw, 100vh) scale(0.8836);
            }
        }
        .snow:nth-child(110) {
            opacity: 0.5259;
            transform: translate(56.6684vw, -10px) scale(0.2244);
            animation: fall-110 29s -25s linear infinite;
        }
        @keyframes fall-110 {
            61.717% {
                transform: translate(54.0688vw, 61.717vh) scale(0.2244);
            }
            to {
                transform: translate(55.3686vw, 100vh) scale(0.2244);
            }
        }
        .snow:nth-child(111) {
            opacity: 0.2369;
            transform: translate(37.1788vw, -10px) scale(0.7039);
            animation: fall-111 30s -17s linear infinite;
        }
        @keyframes fall-111 {
            62.79% {
                transform: translate(29.8387vw, 62.79vh) scale(0.7039);
            }
            to {
                transform: translate(33.50875vw, 100vh) scale(0.7039);
            }
        }
        .snow:nth-child(112) {
            opacity: 0.3765;
            transform: translate(63.9542vw, -10px) scale(0.8097);
            animation: fall-112 28s -23s linear infinite;
        }
        @keyframes fall-112 {
            58.886% {
                transform: translate(66.3553vw, 58.886vh) scale(0.8097);
            }
            to {
                transform: translate(65.15475vw, 100vh) scale(0.8097);
            }
        }
        .snow:nth-child(113) {
            opacity: 0.9242;
            transform: translate(30.1378vw, -10px) scale(0.0995);
            animation: fall-113 17s -12s linear infinite;
        }
        @keyframes fall-113 {
            68.742% {
                transform: translate(37.0127vw, 68.742vh) scale(0.0995);
            }
            to {
                transform: translate(33.57525vw, 100vh) scale(0.0995);
            }
        }
        .snow:nth-child(114) {
            opacity: 0.4738;
            transform: translate(44.7052vw, -10px) scale(0.8673);
            animation: fall-114 19s -20s linear infinite;
        }
        @keyframes fall-114 {
            48.916% {
                transform: translate(46.9009vw, 48.916vh) scale(0.8673);
            }
            to {
                transform: translate(45.80305vw, 100vh) scale(0.8673);
            }
        }
        .snow:nth-child(115) {
            opacity: 0.084;
            transform: translate(64.7154vw, -10px) scale(0.147);
            animation: fall-115 11s -20s linear infinite;
        }
        @keyframes fall-115 {
            50.738% {
                transform: translate(68.3899vw, 50.738vh) scale(0.147);
            }
            to {
                transform: translate(66.55265vw, 100vh) scale(0.147);
            }
        }
        .snow:nth-child(116) {
            opacity: 0.36;
            transform: translate(60.7194vw, -10px) scale(0.6929);
            animation: fall-116 11s -12s linear infinite;
        }
        @keyframes fall-116 {
            41.935% {
                transform: translate(64.3691vw, 41.935vh) scale(0.6929);
            }
            to {
                transform: translate(62.54425vw, 100vh) scale(0.6929);
            }
        }
        .snow:nth-child(117) {
            opacity: 0.6814;
            transform: translate(22.1227vw, -10px) scale(0.824);
            animation: fall-117 19s -1s linear infinite;
        }
        @keyframes fall-117 {
            72.94% {
                transform: translate(18.7721vw, 72.94vh) scale(0.824);
            }
            to {
                transform: translate(20.4474vw, 100vh) scale(0.824);
            }
        }
        .snow:nth-child(118) {
            opacity: 0.6184;
            transform: translate(56.992vw, -10px) scale(0.8818);
            animation: fall-118 16s -23s linear infinite;
        }
        @keyframes fall-118 {
            72.829% {
                transform: translate(64.7064vw, 72.829vh) scale(0.8818);
            }
            to {
                transform: translate(60.8492vw, 100vh) scale(0.8818);
            }
        }
        .snow:nth-child(119) {
            opacity: 0.1581;
            transform: translate(70.1582vw, -10px) scale(0.4366);
            animation: fall-119 15s -28s linear infinite;
        }
        @keyframes fall-119 {
            46.388% {
                transform: translate(75.7713vw, 46.388vh) scale(0.4366);
            }
            to {
                transform: translate(72.96475vw, 100vh) scale(0.4366);
            }
        }
        .snow:nth-child(120) {
            opacity: 0.9957;
            transform: translate(40.2716vw, -10px) scale(0.0849);
            animation: fall-120 14s -13s linear infinite;
        }
        @keyframes fall-120 {
            65.39% {
                transform: translate(33.7024vw, 65.39vh) scale(0.0849);
            }
            to {
                transform: translate(36.987vw, 100vh) scale(0.0849);
            }
        }
        .snow:nth-child(121) {
            opacity: 0.7397;
            transform: translate(61.107vw, -10px) scale(0.551);
            animation: fall-121 21s -7s linear infinite;
        }
        @keyframes fall-121 {
            79.641% {
                transform: translate(67.3996vw, 79.641vh) scale(0.551);
            }
            to {
                transform: translate(64.2533vw, 100vh) scale(0.551);
            }
        }
        .snow:nth-child(122) {
            opacity: 0.3788;
            transform: translate(51.7397vw, -10px) scale(0.714);
            animation: fall-122 27s -2s linear infinite;
        }
        @keyframes fall-122 {
            79.359% {
                transform: translate(50.4835vw, 79.359vh) scale(0.714);
            }
            to {
                transform: translate(51.1116vw, 100vh) scale(0.714);
            }
        }
        .snow:nth-child(123) {
            opacity: 0.2137;
            transform: translate(96.7807vw, -10px) scale(0.4866);
            animation: fall-123 22s -17s linear infinite;
        }
        @keyframes fall-123 {
            55.276% {
                transform: translate(106.7514vw, 55.276vh) scale(0.4866);
            }
            to {
                transform: translate(101.76605vw, 100vh) scale(0.4866);
            }
        }
        .snow:nth-child(124) {
            opacity: 0.3765;
            transform: translate(65.8631vw, -10px) scale(0.4002);
            animation: fall-124 26s -30s linear infinite;
        }
        @keyframes fall-124 {
            45.122% {
                transform: translate(62.2054vw, 45.122vh) scale(0.4002);
            }
            to {
                transform: translate(64.03425vw, 100vh) scale(0.4002);
            }
        }
        .snow:nth-child(125) {
            opacity: 0.845;
            transform: translate(8.189vw, -10px) scale(0.0649);
            animation: fall-125 14s -17s linear infinite;
        }
        @keyframes fall-125 {
            56.266% {
                transform: translate(7.4384vw, 56.266vh) scale(0.0649);
            }
            to {
                transform: translate(7.8137vw, 100vh) scale(0.0649);
            }
        }
        .snow:nth-child(126) {
            opacity: 0.453;
            transform: translate(37.8628vw, -10px) scale(0.9598);
            animation: fall-126 14s -21s linear infinite;
        }
        @keyframes fall-126 {
            69.847% {
                transform: translate(31.4559vw, 69.847vh) scale(0.9598);
            }
            to {
                transform: translate(34.65935vw, 100vh) scale(0.9598);
            }
        }
        .snow:nth-child(127) {
            opacity: 0.8668;
            transform: translate(56.7668vw, -10px) scale(0.0164);
            animation: fall-127 26s -28s linear infinite;
        }
        @keyframes fall-127 {
            41.021% {
                transform: translate(51.8108vw, 41.021vh) scale(0.0164);
            }
            to {
                transform: translate(54.2888vw, 100vh) scale(0.0164);
            }
        }
        .snow:nth-child(128) {
            opacity: 0.1136;
            transform: translate(5.8687vw, -10px) scale(0.054);
            animation: fall-128 30s -26s linear infinite;
        }
        @keyframes fall-128 {
            67.365% {
                transform: translate(-3.5421vw, 67.365vh) scale(0.054);
            }
            to {
                transform: translate(1.1633vw, 100vh) scale(0.054);
            }
        }
        .snow:nth-child(129) {
            opacity: 0.542;
            transform: translate(6.0737vw, -10px) scale(0.4501);
            animation: fall-129 18s -21s linear infinite;
        }
        @keyframes fall-129 {
            46.69% {
                transform: translate(5.8506vw, 46.69vh) scale(0.4501);
            }
            to {
                transform: translate(5.96215vw, 100vh) scale(0.4501);
            }
        }
        .snow:nth-child(130) {
            opacity: 0.3886;
            transform: translate(56.7128vw, -10px) scale(0.7191);
            animation: fall-130 26s -23s linear infinite;
        }
        @keyframes fall-130 {
            64.279% {
                transform: translate(55.7162vw, 64.279vh) scale(0.7191);
            }
            to {
                transform: translate(56.2145vw, 100vh) scale(0.7191);
            }
        }
        .snow:nth-child(131) {
            opacity: 0.1552;
            transform: translate(36.0896vw, -10px) scale(0.8421);
            animation: fall-131 24s -27s linear infinite;
        }
        @keyframes fall-131 {
            45.382% {
                transform: translate(39.9537vw, 45.382vh) scale(0.8421);
            }
            to {
                transform: translate(38.02165vw, 100vh) scale(0.8421);
            }
        }
        .snow:nth-child(132) {
            opacity: 0.2871;
            transform: translate(59.1183vw, -10px) scale(0.6077);
            animation: fall-132 12s -17s linear infinite;
        }
        @keyframes fall-132 {
            61.703% {
                transform: translate(69.0469vw, 61.703vh) scale(0.6077);
            }
            to {
                transform: translate(64.0826vw, 100vh) scale(0.6077);
            }
        }
        .snow:nth-child(133) {
            opacity: 0.4707;
            transform: translate(27.4237vw, -10px) scale(0.4135);
            animation: fall-133 27s -25s linear infinite;
        }
        @keyframes fall-133 {
            58.367% {
                transform: translate(18.3058vw, 58.367vh) scale(0.4135);
            }
            to {
                transform: translate(22.86475vw, 100vh) scale(0.4135);
            }
        }
        .snow:nth-child(134) {
            opacity: 0.2488;
            transform: translate(51.8483vw, -10px) scale(0.7594);
            animation: fall-134 11s -22s linear infinite;
        }
        @keyframes fall-134 {
            59.254% {
                transform: translate(47.4989vw, 59.254vh) scale(0.7594);
            }
            to {
                transform: translate(49.6736vw, 100vh) scale(0.7594);
            }
        }
        .snow:nth-child(135) {
            opacity: 0.0605;
            transform: translate(95.0601vw, -10px) scale(0.7675);
            animation: fall-135 23s -24s linear infinite;
        }
        @keyframes fall-135 {
            43.999% {
                transform: translate(88.9207vw, 43.999vh) scale(0.7675);
            }
            to {
                transform: translate(91.9904vw, 100vh) scale(0.7675);
            }
        }
        .snow:nth-child(136) {
            opacity: 0.9992;
            transform: translate(92.4454vw, -10px) scale(0.6627);
            animation: fall-136 27s -5s linear infinite;
        }
        @keyframes fall-136 {
            55.213% {
                transform: translate(97.3304vw, 55.213vh) scale(0.6627);
            }
            to {
                transform: translate(94.8879vw, 100vh) scale(0.6627);
            }
        }
        .snow:nth-child(137) {
            opacity: 0.313;
            transform: translate(42.2981vw, -10px) scale(0.2539);
            animation: fall-137 11s -20s linear infinite;
        }
        @keyframes fall-137 {
            60.735% {
                transform: translate(51.4381vw, 60.735vh) scale(0.2539);
            }
            to {
                transform: translate(46.8681vw, 100vh) scale(0.2539);
            }
        }
        .snow:nth-child(138) {
            opacity: 0.2553;
            transform: translate(34.8292vw, -10px) scale(0.7522);
            animation: fall-138 30s -4s linear infinite;
        }
        @keyframes fall-138 {
            42.559% {
                transform: translate(26.999vw, 42.559vh) scale(0.7522);
            }
            to {
                transform: translate(30.9141vw, 100vh) scale(0.7522);
            }
        }
        .snow:nth-child(139) {
            opacity: 0.6974;
            transform: translate(20.2258vw, -10px) scale(0.6393);
            animation: fall-139 15s -16s linear infinite;
        }
        @keyframes fall-139 {
            47.864% {
                transform: translate(19.5004vw, 47.864vh) scale(0.6393);
            }
            to {
                transform: translate(19.8631vw, 100vh) scale(0.6393);
            }
        }
        .snow:nth-child(140) {
            opacity: 0.8738;
            transform: translate(46.2528vw, -10px) scale(0.8967);
            animation: fall-140 12s -19s linear infinite;
        }
        @keyframes fall-140 {
            79.264% {
                transform: translate(51.3535vw, 79.264vh) scale(0.8967);
            }
            to {
                transform: translate(48.80315vw, 100vh) scale(0.8967);
            }
        }
        .snow:nth-child(141) {
            opacity: 0.2196;
            transform: translate(87.9896vw, -10px) scale(0.2811);
            animation: fall-141 24s -13s linear infinite;
        }
        @keyframes fall-141 {
            53.374% {
                transform: translate(91.5235vw, 53.374vh) scale(0.2811);
            }
            to {
                transform: translate(89.75655vw, 100vh) scale(0.2811);
            }
        }
        .snow:nth-child(142) {
            opacity: 0.1734;
            transform: translate(95.199vw, -10px) scale(0.9729);
            animation: fall-142 20s -9s linear infinite;
        }
        @keyframes fall-142 {
            53.827% {
                transform: translate(85.356vw, 53.827vh) scale(0.9729);
            }
            to {
                transform: translate(90.2775vw, 100vh) scale(0.9729);
            }
        }
        .snow:nth-child(143) {
            opacity: 0.9319;
            transform: translate(30.7601vw, -10px) scale(0.193);
            animation: fall-143 26s -4s linear infinite;
        }
        @keyframes fall-143 {
            37.896% {
                transform: translate(30.8337vw, 37.896vh) scale(0.193);
            }
            to {
                transform: translate(30.7969vw, 100vh) scale(0.193);
            }
        }
        .snow:nth-child(144) {
            opacity: 0.7247;
            transform: translate(1.5128vw, -10px) scale(0.6734);
            animation: fall-144 13s -11s linear infinite;
        }
        @keyframes fall-144 {
            75.42% {
                transform: translate(5.2596vw, 75.42vh) scale(0.6734);
            }
            to {
                transform: translate(3.3862vw, 100vh) scale(0.6734);
            }
        }
        .snow:nth-child(145) {
            opacity: 0.3017;
            transform: translate(69.458vw, -10px) scale(0.4671);
            animation: fall-145 16s -21s linear infinite;
        }
        @keyframes fall-145 {
            71.267% {
                transform: translate(71.8558vw, 71.267vh) scale(0.4671);
            }
            to {
                transform: translate(70.6569vw, 100vh) scale(0.4671);
            }
        }
        .snow:nth-child(146) {
            opacity: 0.4814;
            transform: translate(42.6957vw, -10px) scale(0.5675);
            animation: fall-146 18s -23s linear infinite;
        }
        @keyframes fall-146 {
            60.229% {
                transform: translate(38.1352vw, 60.229vh) scale(0.5675);
            }
            to {
                transform: translate(40.41545vw, 100vh) scale(0.5675);
            }
        }
        .snow:nth-child(147) {
            opacity: 0.6613;
            transform: translate(33.8948vw, -10px) scale(0.8362);
            animation: fall-147 26s -6s linear infinite;
        }
        @keyframes fall-147 {
            70.009% {
                transform: translate(38.4313vw, 70.009vh) scale(0.8362);
            }
            to {
                transform: translate(36.16305vw, 100vh) scale(0.8362);
            }
        }
        .snow:nth-child(148) {
            opacity: 0.009;
            transform: translate(60.698vw, -10px) scale(0.6534);
            animation: fall-148 22s -17s linear infinite;
        }
        @keyframes fall-148 {
            69.251% {
                transform: translate(65.8045vw, 69.251vh) scale(0.6534);
            }
            to {
                transform: translate(63.25125vw, 100vh) scale(0.6534);
            }
        }
        .snow:nth-child(149) {
            opacity: 0.5629;
            transform: translate(38.1197vw, -10px) scale(0.2097);
            animation: fall-149 30s -3s linear infinite;
        }
        @keyframes fall-149 {
            60.483% {
                transform: translate(36.3639vw, 60.483vh) scale(0.2097);
            }
            to {
                transform: translate(37.2418vw, 100vh) scale(0.2097);
            }
        }
        .snow:nth-child(150) {
            opacity: 0.7302;
            transform: translate(66.7784vw, -10px) scale(0.2373);
            animation: fall-150 23s -11s linear infinite;
        }
        @keyframes fall-150 {
            37.844% {
                transform: translate(71.2463vw, 37.844vh) scale(0.2373);
            }
            to {
                transform: translate(69.01235vw, 100vh) scale(0.2373);
            }
        }
        .snow:nth-child(151) {
            opacity: 0.8679;
            transform: translate(82.4282vw, -10px) scale(0.1331);
            animation: fall-151 13s -9s linear infinite;
        }
        @keyframes fall-151 {
            73.71% {
                transform: translate(75.9728vw, 73.71vh) scale(0.1331);
            }
            to {
                transform: translate(79.2005vw, 100vh) scale(0.1331);
            }
        }
        .snow:nth-child(152) {
            opacity: 0.2696;
            transform: translate(18.724vw, -10px) scale(0.9737);
            animation: fall-152 12s -16s linear infinite;
        }
        @keyframes fall-152 {
            63.31% {
                transform: translate(17.2592vw, 63.31vh) scale(0.9737);
            }
            to {
                transform: translate(17.9916vw, 100vh) scale(0.9737);
            }
        }
        .snow:nth-child(153) {
            opacity: 0.979;
            transform: translate(34.1614vw, -10px) scale(0.3561);
            animation: fall-153 22s -23s linear infinite;
        }
        @keyframes fall-153 {
            43.519% {
                transform: translate(43.4485vw, 43.519vh) scale(0.3561);
            }
            to {
                transform: translate(38.80495vw, 100vh) scale(0.3561);
            }
        }
        .snow:nth-child(154) {
            opacity: 0.5657;
            transform: translate(90.5533vw, -10px) scale(0.3882);
            animation: fall-154 15s -1s linear infinite;
        }
        @keyframes fall-154 {
            51.429% {
                transform: translate(96.3765vw, 51.429vh) scale(0.3882);
            }
            to {
                transform: translate(93.4649vw, 100vh) scale(0.3882);
            }
        }
        .snow:nth-child(155) {
            opacity: 0.734;
            transform: translate(72.4581vw, -10px) scale(0.2584);
            animation: fall-155 19s -26s linear infinite;
        }
        @keyframes fall-155 {
            70.925% {
                transform: translate(80.4537vw, 70.925vh) scale(0.2584);
            }
            to {
                transform: translate(76.4559vw, 100vh) scale(0.2584);
            }
        }
        .snow:nth-child(156) {
            opacity: 0.7945;
            transform: translate(55.753vw, -10px) scale(0.4017);
            animation: fall-156 19s -26s linear infinite;
        }
        @keyframes fall-156 {
            67.514% {
                transform: translate(58.6444vw, 67.514vh) scale(0.4017);
            }
            to {
                transform: translate(57.1987vw, 100vh) scale(0.4017);
            }
        }
        .snow:nth-child(157) {
            opacity: 0.6608;
            transform: translate(33.8196vw, -10px) scale(0.6111);
            animation: fall-157 10s -15s linear infinite;
        }
        @keyframes fall-157 {
            37.504% {
                transform: translate(30.7807vw, 37.504vh) scale(0.6111);
            }
            to {
                transform: translate(32.30015vw, 100vh) scale(0.6111);
            }
        }
        .snow:nth-child(158) {
            opacity: 0.2664;
            transform: translate(60.5551vw, -10px) scale(0.8887);
            animation: fall-158 23s -1s linear infinite;
        }
        @keyframes fall-158 {
            74.036% {
                transform: translate(70.488vw, 74.036vh) scale(0.8887);
            }
            to {
                transform: translate(65.52155vw, 100vh) scale(0.8887);
            }
        }
        .snow:nth-child(159) {
            opacity: 0.4709;
            transform: translate(52.1217vw, -10px) scale(0.1093);
            animation: fall-159 14s -29s linear infinite;
        }
        @keyframes fall-159 {
            42.599% {
                transform: translate(44.7136vw, 42.599vh) scale(0.1093);
            }
            to {
                transform: translate(48.41765vw, 100vh) scale(0.1093);
            }
        }
        .snow:nth-child(160) {
            opacity: 0.8487;
            transform: translate(30.9722vw, -10px) scale(0.2595);
            animation: fall-160 13s -15s linear infinite;
        }
        @keyframes fall-160 {
            32.45% {
                transform: translate(37.1204vw, 32.45vh) scale(0.2595);
            }
            to {
                transform: translate(34.0463vw, 100vh) scale(0.2595);
            }
        }
        .snow:nth-child(161) {
            opacity: 0.9767;
            transform: translate(35.4677vw, -10px) scale(1);
            animation: fall-161 27s -24s linear infinite;
        }
        @keyframes fall-161 {
            68.9% {
                transform: translate(27.3284vw, 68.9vh) scale(1);
            }
            to {
                transform: translate(31.39805vw, 100vh) scale(1);
            }
        }
        .snow:nth-child(162) {
            opacity: 0.6147;
            transform: translate(30.4936vw, -10px) scale(0.5464);
            animation: fall-162 14s -2s linear infinite;
        }
        @keyframes fall-162 {
            38.551% {
                transform: translate(32.0401vw, 38.551vh) scale(0.5464);
            }
            to {
                transform: translate(31.26685vw, 100vh) scale(0.5464);
            }
        }
        .snow:nth-child(163) {
            opacity: 0.9789;
            transform: translate(61.7753vw, -10px) scale(0.7202);
            animation: fall-163 14s -27s linear infinite;
        }
        @keyframes fall-163 {
            62% {
                transform: translate(52.7346vw, 62vh) scale(0.7202);
            }
            to {
                transform: translate(57.25495vw, 100vh) scale(0.7202);
            }
        }
        .snow:nth-child(164) {
            opacity: 0.8119;
            transform: translate(2.9054vw, -10px) scale(0.3495);
            animation: fall-164 14s -23s linear infinite;
        }
        @keyframes fall-164 {
            74.444% {
                transform: translate(8.0367vw, 74.444vh) scale(0.3495);
            }
            to {
                transform: translate(5.47105vw, 100vh) scale(0.3495);
            }
        }
        .snow:nth-child(165) {
            opacity: 0.423;
            transform: translate(40.7368vw, -10px) scale(0.2254);
            animation: fall-165 17s -21s linear infinite;
        }
        @keyframes fall-165 {
            59.048% {
                transform: translate(31.3864vw, 59.048vh) scale(0.2254);
            }
            to {
                transform: translate(36.0616vw, 100vh) scale(0.2254);
            }
        }
        .snow:nth-child(166) {
            opacity: 0.3962;
            transform: translate(62.2556vw, -10px) scale(0.2784);
            animation: fall-166 11s -12s linear infinite;
        }
        @keyframes fall-166 {
            41.765% {
                transform: translate(61.7109vw, 41.765vh) scale(0.2784);
            }
            to {
                transform: translate(61.98325vw, 100vh) scale(0.2784);
            }
        }
        .snow:nth-child(167) {
            opacity: 0.9046;
            transform: translate(52.3865vw, -10px) scale(0.8627);
            animation: fall-167 24s -19s linear infinite;
        }
        @keyframes fall-167 {
            43.534% {
                transform: translate(45.4196vw, 43.534vh) scale(0.8627);
            }
            to {
                transform: translate(48.90305vw, 100vh) scale(0.8627);
            }
        }
        .snow:nth-child(168) {
            opacity: 0.5894;
            transform: translate(6.3018vw, -10px) scale(0.0859);
            animation: fall-168 13s -10s linear infinite;
        }
        @keyframes fall-168 {
            61.024% {
                transform: translate(13.4763vw, 61.024vh) scale(0.0859);
            }
            to {
                transform: translate(9.88905vw, 100vh) scale(0.0859);
            }
        }
        .snow:nth-child(169) {
            opacity: 0.7111;
            transform: translate(42.8931vw, -10px) scale(0.8028);
            animation: fall-169 15s -6s linear infinite;
        }
        @keyframes fall-169 {
            50.203% {
                transform: translate(47.6678vw, 50.203vh) scale(0.8028);
            }
            to {
                transform: translate(45.28045vw, 100vh) scale(0.8028);
            }
        }
        .snow:nth-child(170) {
            opacity: 0.4868;
            transform: translate(80.9989vw, -10px) scale(0.6646);
            animation: fall-170 24s -6s linear infinite;
        }
        @keyframes fall-170 {
            53.132% {
                transform: translate(86.949vw, 53.132vh) scale(0.6646);
            }
            to {
                transform: translate(83.97395vw, 100vh) scale(0.6646);
            }
        }
        .snow:nth-child(171) {
            opacity: 0.5737;
            transform: translate(53.0703vw, -10px) scale(0.0974);
            animation: fall-171 17s -8s linear infinite;
        }
        @keyframes fall-171 {
            51.156% {
                transform: translate(53.6536vw, 51.156vh) scale(0.0974);
            }
            to {
                transform: translate(53.36195vw, 100vh) scale(0.0974);
            }
        }
        .snow:nth-child(172) {
            opacity: 0.1467;
            transform: translate(64.1882vw, -10px) scale(0.9945);
            animation: fall-172 16s -19s linear infinite;
        }
        @keyframes fall-172 {
            52.711% {
                transform: translate(73.3244vw, 52.711vh) scale(0.9945);
            }
            to {
                transform: translate(68.7563vw, 100vh) scale(0.9945);
            }
        }
        .snow:nth-child(173) {
            opacity: 0.1335;
            transform: translate(47.1437vw, -10px) scale(0.9406);
            animation: fall-173 11s -8s linear infinite;
        }
        @keyframes fall-173 {
            39.249% {
                transform: translate(48.7772vw, 39.249vh) scale(0.9406);
            }
            to {
                transform: translate(47.96045vw, 100vh) scale(0.9406);
            }
        }
        .snow:nth-child(174) {
            opacity: 0.6981;
            transform: translate(65.2573vw, -10px) scale(0.256);
            animation: fall-174 11s -26s linear infinite;
        }
        @keyframes fall-174 {
            33.292% {
                transform: translate(61.5217vw, 33.292vh) scale(0.256);
            }
            to {
                transform: translate(63.3895vw, 100vh) scale(0.256);
            }
        }
        .snow:nth-child(175) {
            opacity: 0.8978;
            transform: translate(81.3644vw, -10px) scale(0.8807);
            animation: fall-175 24s -22s linear infinite;
        }
        @keyframes fall-175 {
            45.638% {
                transform: translate(75.9995vw, 45.638vh) scale(0.8807);
            }
            to {
                transform: translate(78.68195vw, 100vh) scale(0.8807);
            }
        }
        .snow:nth-child(176) {
            opacity: 0.8434;
            transform: translate(71.0238vw, -10px) scale(0.4663);
            animation: fall-176 28s -28s linear infinite;
        }
        @keyframes fall-176 {
            41.783% {
                transform: translate(69.0421vw, 41.783vh) scale(0.4663);
            }
            to {
                transform: translate(70.03295vw, 100vh) scale(0.4663);
            }
        }
        .snow:nth-child(177) {
            opacity: 0.7994;
            transform: translate(67.9097vw, -10px) scale(0.6632);
            animation: fall-177 12s -8s linear infinite;
        }
        @keyframes fall-177 {
            42.313% {
                transform: translate(66.6744vw, 42.313vh) scale(0.6632);
            }
            to {
                transform: translate(67.29205vw, 100vh) scale(0.6632);
            }
        }
        .snow:nth-child(178) {
            opacity: 0.7299;
            transform: translate(53.8021vw, -10px) scale(0.9484);
            animation: fall-178 11s -11s linear infinite;
        }
        @keyframes fall-178 {
            54.99% {
                transform: translate(48.7899vw, 54.99vh) scale(0.9484);
            }
            to {
                transform: translate(51.296vw, 100vh) scale(0.9484);
            }
        }
        .snow:nth-child(179) {
            opacity: 0.233;
            transform: translate(72.0972vw, -10px) scale(0.3435);
            animation: fall-179 20s -29s linear infinite;
        }
        @keyframes fall-179 {
            67.103% {
                transform: translate(63.8374vw, 67.103vh) scale(0.3435);
            }
            to {
                transform: translate(67.9673vw, 100vh) scale(0.3435);
            }
        }
        .snow:nth-child(180) {
            opacity: 0.2382;
            transform: translate(41.2534vw, -10px) scale(0.8107);
            animation: fall-180 13s -15s linear infinite;
        }
        @keyframes fall-180 {
            69.514% {
                transform: translate(37.2664vw, 69.514vh) scale(0.8107);
            }
            to {
                transform: translate(39.2599vw, 100vh) scale(0.8107);
            }
        }
        .snow:nth-child(181) {
            opacity: 0.8337;
            transform: translate(38.0424vw, -10px) scale(0.0895);
            animation: fall-181 26s -12s linear infinite;
        }
        @keyframes fall-181 {
            43.13% {
                transform: translate(39.9028vw, 43.13vh) scale(0.0895);
            }
            to {
                transform: translate(38.9726vw, 100vh) scale(0.0895);
            }
        }
        .snow:nth-child(182) {
            opacity: 0.7876;
            transform: translate(38.955vw, -10px) scale(0.3506);
            animation: fall-182 24s -2s linear infinite;
        }
        @keyframes fall-182 {
            39.432% {
                transform: translate(45.7272vw, 39.432vh) scale(0.3506);
            }
            to {
                transform: translate(42.3411vw, 100vh) scale(0.3506);
            }
        }
        .snow:nth-child(183) {
            opacity: 0.0338;
            transform: translate(30.9924vw, -10px) scale(0.0662);
            animation: fall-183 12s -18s linear infinite;
        }
        @keyframes fall-183 {
            34.567% {
                transform: translate(29.9839vw, 34.567vh) scale(0.0662);
            }
            to {
                transform: translate(30.48815vw, 100vh) scale(0.0662);
            }
        }
        .snow:nth-child(184) {
            opacity: 0.3203;
            transform: translate(32.3858vw, -10px) scale(0.2498);
            animation: fall-184 15s -12s linear infinite;
        }
        @keyframes fall-184 {
            40.811% {
                transform: translate(30.0859vw, 40.811vh) scale(0.2498);
            }
            to {
                transform: translate(31.23585vw, 100vh) scale(0.2498);
            }
        }
        .snow:nth-child(185) {
            opacity: 0.7547;
            transform: translate(71.8772vw, -10px) scale(0.6204);
            animation: fall-185 21s -27s linear infinite;
        }
        @keyframes fall-185 {
            56.99% {
                transform: translate(69.5694vw, 56.99vh) scale(0.6204);
            }
            to {
                transform: translate(70.7233vw, 100vh) scale(0.6204);
            }
        }
        .snow:nth-child(186) {
            opacity: 0.2523;
            transform: translate(98.0509vw, -10px) scale(0.6495);
            animation: fall-186 21s -23s linear infinite;
        }
        @keyframes fall-186 {
            70.116% {
                transform: translate(103.2636vw, 70.116vh) scale(0.6495);
            }
            to {
                transform: translate(100.65725vw, 100vh) scale(0.6495);
            }
        }
        .snow:nth-child(187) {
            opacity: 0.402;
            transform: translate(94.9128vw, -10px) scale(0.0546);
            animation: fall-187 19s -18s linear infinite;
        }
        @keyframes fall-187 {
            50.075% {
                transform: translate(92.4283vw, 50.075vh) scale(0.0546);
            }
            to {
                transform: translate(93.67055vw, 100vh) scale(0.0546);
            }
        }
        .snow:nth-child(188) {
            opacity: 0.2718;
            transform: translate(55.5798vw, -10px) scale(0.8622);
            animation: fall-188 22s -19s linear infinite;
        }
        @keyframes fall-188 {
            53.812% {
                transform: translate(45.899vw, 53.812vh) scale(0.8622);
            }
            to {
                transform: translate(50.7394vw, 100vh) scale(0.8622);
            }
        }
        .snow:nth-child(189) {
            opacity: 0.7307;
            transform: translate(45.5016vw, -10px) scale(0.5263);
            animation: fall-189 22s -13s linear infinite;
        }
        @keyframes fall-189 {
            47.572% {
                transform: translate(38.1396vw, 47.572vh) scale(0.5263);
            }
            to {
                transform: translate(41.8206vw, 100vh) scale(0.5263);
            }
        }
        .snow:nth-child(190) {
            opacity: 0.9826;
            transform: translate(48.0557vw, -10px) scale(0.7815);
            animation: fall-190 27s -22s linear infinite;
        }
        @keyframes fall-190 {
            66.425% {
                transform: translate(48.9171vw, 66.425vh) scale(0.7815);
            }
            to {
                transform: translate(48.4864vw, 100vh) scale(0.7815);
            }
        }
        .snow:nth-child(191) {
            opacity: 0.1575;
            transform: translate(31.5853vw, -10px) scale(0.9775);
            animation: fall-191 13s -19s linear infinite;
        }
        @keyframes fall-191 {
            78.544% {
                transform: translate(30.7129vw, 78.544vh) scale(0.9775);
            }
            to {
                transform: translate(31.1491vw, 100vh) scale(0.9775);
            }
        }
        .snow:nth-child(192) {
            opacity: 0.5732;
            transform: translate(68.0794vw, -10px) scale(0.0597);
            animation: fall-192 28s -5s linear infinite;
        }
        @keyframes fall-192 {
            47.019% {
                transform: translate(66.1226vw, 47.019vh) scale(0.0597);
            }
            to {
                transform: translate(67.101vw, 100vh) scale(0.0597);
            }
        }
        .snow:nth-child(193) {
            opacity: 0.0421;
            transform: translate(30.9775vw, -10px) scale(0.218);
            animation: fall-193 19s -2s linear infinite;
        }
        @keyframes fall-193 {
            34.886% {
                transform: translate(33.2978vw, 34.886vh) scale(0.218);
            }
            to {
                transform: translate(32.13765vw, 100vh) scale(0.218);
            }
        }
        .snow:nth-child(194) {
            opacity: 0.0523;
            transform: translate(50.6648vw, -10px) scale(0.7635);
            animation: fall-194 18s -18s linear infinite;
        }
        @keyframes fall-194 {
            52.364% {
                transform: translate(50.2501vw, 52.364vh) scale(0.7635);
            }
            to {
                transform: translate(50.45745vw, 100vh) scale(0.7635);
            }
        }
        .snow:nth-child(195) {
            opacity: 0.4315;
            transform: translate(77.0377vw, -10px) scale(0.0925);
            animation: fall-195 18s -24s linear infinite;
        }
        @keyframes fall-195 {
            78.301% {
                transform: translate(71.7594vw, 78.301vh) scale(0.0925);
            }
            to {
                transform: translate(74.39855vw, 100vh) scale(0.0925);
            }
        }
        .snow:nth-child(196) {
            opacity: 0.4778;
            transform: translate(14.8287vw, -10px) scale(0.9639);
            animation: fall-196 20s -15s linear infinite;
        }
        @keyframes fall-196 {
            52.449% {
                transform: translate(19.3849vw, 52.449vh) scale(0.9639);
            }
            to {
                transform: translate(17.1068vw, 100vh) scale(0.9639);
            }
        }
        .snow:nth-child(197) {
            opacity: 0.2307;
            transform: translate(72.9474vw, -10px) scale(0.9737);
            animation: fall-197 19s -22s linear infinite;
        }
        @keyframes fall-197 {
            63.678% {
                transform: translate(74.9718vw, 63.678vh) scale(0.9737);
            }
            to {
                transform: translate(73.9596vw, 100vh) scale(0.9737);
            }
        }
        .snow:nth-child(198) {
            opacity: 0.7973;
            transform: translate(88.0049vw, -10px) scale(0.7779);
            animation: fall-198 23s -23s linear infinite;
        }
        @keyframes fall-198 {
            64.593% {
                transform: translate(88.8545vw, 64.593vh) scale(0.7779);
            }
            to {
                transform: translate(88.4297vw, 100vh) scale(0.7779);
            }
        }
        .snow:nth-child(199) {
            opacity: 0.72;
            transform: translate(49.1443vw, -10px) scale(0.2771);
            animation: fall-199 27s -4s linear infinite;
        }
        @keyframes fall-199 {
            40.204% {
                transform: translate(39.5127vw, 40.204vh) scale(0.2771);
            }
            to {
                transform: translate(44.3285vw, 100vh) scale(0.2771);
            }
        }
        .snow:nth-child(200) {
            opacity: 0.5409;
            transform: translate(76.8649vw, -10px) scale(0.8432);
            animation: fall-200 23s -5s linear infinite;
        }
        @keyframes fall-200 {
            70.457% {
                transform: translate(81.563vw, 70.457vh) scale(0.8432);
            }
            to {
                transform: translate(79.21395vw, 100vh) scale(0.8432);
            }
        }
    </style>

<div class="snow-wrap">
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
    <div class="snow"></div>
</div>

