@extends('../layouts.master1')
@section('content')

<body>

    <x-nav />

    <div id="popup">
        <div class="content">
            <h3>Arahan Pengerjaan Tes Minat Bakat</h3>
            <p>
                Anda akan diberikan sejumlah pertanyaan. Setiap pertanyaan dilengkapi dengan pilihan jawaban.
                Kemudian Anda memilih salah satu dari pilihan yang tersedia sesuai dengan kepribadian Anda.
            </p>
            <p>
                Dalam tes ini tidak ada jawaban benar ataupun salah. Jawablah sesuai dengan gambaran diri Anda sendiri.
            </p>
            <div class="buttons">
                <a href="#" onclick="cancelQuiz()">Lain Kali</a>
                <button id="start" onclick="startQuiz()">Mulai</button>
            </div>
        </div>
    </div>

    <div id="quiz-container" style="display: none;">
        <div class="container" id="question1">
            <h2>Apa hobi Anda?</h2>
            <div class="hobi-container">
                <div class="hobi-container">
                    <button onclick="selectAnswerAndNext('hobi', 'Menulis')">Menulis</button>
                    <button onclick="selectAnswerAndNext('hobi', 'Membaca')">Membaca</button>
                    <button onclick="selectAnswerAndNext('hobi', 'Melukis')">Melukis</button>
                    <button onclick="selectAnswerAndNext('hobi', 'Memasak')">Memasak</button>
                    <button onclick="selectAnswerAndNext('hobi', 'Menyanyi')">Menyanyi</button>
                    <button onclick="selectAnswerAndNext('hobi', 'Menari')">Menari</button>
                    <button onclick="selectAnswerAndNext('hobi', 'Traveling')">Traveling</button>
                    <button onclick="selectAnswerAndNext('hobi', 'Musik')">Musik</button>
                    <button onclick="selectAnswerAndNext('hobi', 'Olahraga')">Olahraga</button>
                    <button onclick="selectAnswerAndNext('hobi', 'Fotografi')">Fotografi</button>
                    <button onclick="selectAnswerAndNext('hobi', 'Bermain_Game')">Bermain Game</button>
                    <button onclick="selectAnswerAndNext('hobi', 'Bersepeda')">Bersepeda</button>
                    <!-- Tambahkan opsi lainnya -->
                </div>

                <!-- Tambahkan opsi lainnya -->
            </div>
        </div>
        <div class="container" id="question2" style="display: none;">
            <h2>Training atau Pelatihan apa yang pernah Anda ikuti?</h2>
            <div class="training-container2">
                <div class="hobi-container">
                    <button onclick="selectAnswerAndNext('hobi', 'Menulis')">Menulis</button>
                    <button onclick="selectAnswerAndNext('hobi', 'Membaca')">Membaca</button>
                    <button onclick="selectAnswerAndNext('hobi', 'Melukis')">Melukis</button>
                    <button onclick="selectAnswerAndNext('hobi', 'Memasak')">Memasak</button>
                    <button onclick="selectAnswerAndNext('hobi', 'Menyanyi')">Menyanyi</button>
                    <button onclick="selectAnswerAndNext('hobi', 'Menari')">Menari</button>
                    <button onclick="selectAnswerAndNext('hobi', 'Traveling')">Traveling</button>
                    <button onclick="selectAnswerAndNext('hobi', 'Musik')">Musik</button>
                    <button onclick="selectAnswerAndNext('hobi', 'Olahraga')">Olahraga</button>
                    <button onclick="selectAnswerAndNext('hobi', 'Fotografi')">Fotografi</button>
                    <button onclick="selectAnswerAndNext('hobi', 'Bermain_Game')">Bermain Game</button>
                    <button onclick="selectAnswerAndNext('hobi', 'Bersepeda')">Bersepeda</button>
                    <!-- Tambahkan opsi lainnya -->
                </div>

                <!-- Tambahkan opsi lainnya -->
            </div>
            <div class="navigation-buttons">
                <button id="prevButton" onclick="prevQuestion()">Sebelumnya</button>
            </div>
        </div>
        <div class="container" id="question3" style="display: none;">
            <h2>Prestasi dalam bidang apa yang Anda miliki?</h2>
            <div class="prestasi-container3">
                <div class="hobi-container">
                    <button onclick="selectAnswerAndNext('hobi', 'Menulis')">Menulis</button>
                    <button onclick="selectAnswerAndNext('hobi', 'Membaca')">Membaca</button>
                    <button onclick="selectAnswerAndNext('hobi', 'Melukis')">Melukis</button>
                    <button onclick="selectAnswerAndNext('hobi', 'Memasak')">Memasak</button>
                    <button onclick="selectAnswerAndNext('hobi', 'Menyanyi')">Menyanyi</button>
                    <button onclick="selectAnswerAndNext('hobi', 'Menari')">Menari</button>
                    <button onclick="selectAnswerAndNext('hobi', 'Traveling')">Traveling</button>
                    <button onclick="selectAnswerAndNext('hobi', 'Musik')">Musik</button>
                    <button onclick="selectAnswerAndNext('hobi', 'Olahraga')">Olahraga</button>
                    <button onclick="selectAnswerAndNext('hobi', 'Fotografi')">Fotografi</button>
                    <button onclick="selectAnswerAndNext('hobi', 'Bermain_Game')">Bermain Game</button>
                    <button onclick="selectAnswerAndNext('hobi', 'Bersepeda')">Bersepeda</button>
                    <!-- Tambahkan opsi lainnya -->
                </div>

                <!-- Tambahkan opsi lainnya -->
            </div>
            <div class="navigation-buttons">
                <button id="prevButton" onclick="prevQuestion()">Sebelumnya</button>
            </div>
        </div>
        <div class="container" id="question4" style="display: none;">
            <h2>Komunitas dalam bidang apa yang Anda miliki?</h2>
            <div class="prestasi-container4">
                <div class="hobi-container">
                    <button id="finishButton" onclick="finishQuiz() ('hobi', 'Menulis')">Menulis</button>
                    <button id="finishButton" onclick="finishQuiz() ('hobi', 'Membaca')">Membaca</button>
                    <button id="finishButton" onclick="finishQuiz() ('hobi', 'Melukis')">Melukis</button>
                    <button id="finishButton" onclick="finishQuiz() ('hobi', 'Memasak')">Memasak</button>
                    <button id="finishButton" onclick="finishQuiz() ('hobi', 'Menyanyi')">Menyanyi</button>
                    <button id="finishButton" onclick="finishQuiz() ('hobi', 'Menari')">Menari</button>
                    <button id="finishButton" onclick="finishQuiz() ('hobi', 'Traveling')">Traveling</button>
                    <button id="finishButton" onclick="finishQuiz() ('hobi', 'Musik')">Musik</button>
                    <button id="finishButton" onclick="finishQuiz() ('hobi', 'Olahraga')">Olahraga</button>
                    <button id="finishButton" onclick="finishQuiz() ('hobi', 'Fotografi')">Fotografi</button>
                    <button id="finishButton" onclick="finishQuiz() ('hobi', 'Bermain_Game')">Bermain Game</button>
                    <button id="finishButton" onclick="finishQuiz() ('hobi', 'Bersepeda')">Bersepeda</button>
                    <!-- Tambahkan opsi lainnya -->
                </div>
                <!-- Tambahkan opsi lainnya -->
            </div>
        </div>
    </div>

    <!-- Tambahkan overlay dan popup untuk hasil -->
    <div id="overlay"></div>
    <div id="result-popup">
        <h2>Hasil Tes Minat Bakat</h2>
        <p id="result-text"></p>
        <button onclick="closeResultPopup()">Tutup</button>
    </div>

    <script>
        let currentQuestion = 1;
        const totalQuestions = 4;
        const answers = {
            hobi: '',
            training: '',
            prestasi: '',
            komunitas: ''
        };
        const scores = {
            hobi: 50,
            training: 30,
            prestasi: 20,
            komunitas: 10
        };

        const careerRecommendations = {
            Menulis: "Penulis, Editor, Content Creator",
            Membaca: "Pustakawan, Editor, Akademisi",
            Melukis: "Pelukis, Desainer Grafis, Seniman",
            Memasak: "Chef, Food Blogger, Pengusaha Kuliner",
            Menyanyi: "Penyanyi, Musisi, Guru Musik",
            Menari: "Penari, Koreografer, Pelatih Tari",
            Traveling: "Pemandu Wisata, Travel Blogger, Fotografer",
            Musik: "Musisi, Produser Musik, Sound Engineer",
            Olahraga: "Pelatih, Atlet, Fisioterapis",
            Fotografi: "Fotografer, Videografer, Jurnalis Foto",
            Bermain_Game: "Game Developer, Streamer, Game Tester",
            Bersepeda: "Instruktur Sepeda, Atlet Sepeda, Teknisi Sepeda"
        };

        function quitTest() {
            alert("Quitting the test!"); // Tambahkan fungsionalitas di sini
        }

        window.onload = function() {
            document.getElementById('popup').style.display = 'flex';
        }

        function startQuiz() {
            document.getElementById('popup').style.display = 'none';
            showQuestion(currentQuestion);
        }

        function selectAnswer(category, answer) {
            answers[category] = answer;
        }

        function showQuestion(number) {
            for (let i = 1; i <= totalQuestions; i++) {
                document.getElementById(`question${i}`).style.display = i === number ? 'block' : 'none';
            }
            document.getElementById('quiz-container').style.display = 'block';
        }

        function selectAnswerAndNext(category, answer) {
            selectAnswer(category, answer);
            nextQuestion();
        }

        function nextQuestion() {
            if (currentQuestion < totalQuestions) {
                currentQuestion++;
                showQuestion(currentQuestion);
            }
        }


        function prevQuestion() {
            if (currentQuestion > 1) {
                currentQuestion--;
                showQuestion(currentQuestion);
            }
        }

        function finishQuiz() {
            let highestScore = 0;
            let bestCareer = '';

            for (let key in answers) {
                if (careerRecommendations[answers[key]]) {
                    let score = scores[key];
                    if (score > highestScore) {
                        highestScore = score;
                        bestCareer = careerRecommendations[answers[key]];
                    }
                }
            }
            const name = '{{ Auth::user()->name }}'; // Mengambil nama user yang sedang login

            document.getElementById('result-text').innerText =
                `Hai ${name},Berdasarkan jawaban Anda, pekerjaan yang paling cocok untuk Anda adalah: ${bestCareer}.`;

            // Tampilkan hasil dalam bentuk popup
            document.getElementById('overlay').style.display = 'block';
            document.getElementById('result-popup').style.display = 'block';
        }

        function cancelQuiz() {
            window.history.back();
        }

        function closeResultPopup() {
            document.getElementById('overlay').style.display = 'none';
            document.getElementById('result-popup').style.display = 'none';
            window.location.href = ''; // Contoh URL
        }

        document.querySelectorAll('.hobi-container button, .training-container2 button, .prestasi-container3 button, .prestasi-container4 button').forEach(button => {
            button.addEventListener('click', function() {
                this.parentElement.querySelectorAll('button').forEach(btn => btn.classList.remove('selected'));
                this.classList.add('selected');
            });
        });
    </script>
</body>

@endsection


@push('after-scripts')
<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="lib/wow/wow.min.js"></script>
<script src="lib/easing/easing.min.js"></script>
<script src="lib/waypoints/waypoints.min.js"></script>
<script src="lib/owlcarousel/owl.carousel.min.js"></script>

<!-- Template Javascript -->
<script src="js/main.js"></script>
@endpush