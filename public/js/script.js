document.addEventListener("DOMContentLoaded", function () {
    let currentQuestion = 0;
    const questions = document.querySelectorAll(".question");
    const totalQuestions = questions.length;

    // Timer Variables
    let timeLeft = 300; // 5 minutes in seconds
    const timerElement = document.getElementById("timer");

    // Function to update timer
    function updateTimer() {
        const minutes = Math.floor(timeLeft / 60);
        const seconds = timeLeft % 60;
        timerElement.innerHTML = `<i class="fas fa-clock"></i> Waktu Tersisa: ${minutes
            .toString()
            .padStart(2, "0")}:${seconds.toString().padStart(2, "0")}`;

        if (timeLeft > 0) {
            timeLeft--;
        } else {
            clearInterval(timerInterval);
            alert("Waktu habis! Jawaban akan disubmit.");
            document.getElementById("psikotesForm").submit();
        }
    }

    // Start the timer
    let timerInterval = setInterval(updateTimer, 1000);
    updateTimer(); // Initial call to display starting time

    function showQuestion(index) {
        questions.forEach((question, i) => {
            question.style.display = i === index ? "block" : "none";
        });
        document.getElementById("progress").innerText = `Soal ${
            index + 1
        } dari ${totalQuestions}`;
    }

    function showNextQuestion() {
        if (currentQuestion < totalQuestions - 1) {
            currentQuestion++;
            showQuestion(currentQuestion);
            document.getElementById("prevButton").style.display = "inline";
            if (currentQuestion === totalQuestions - 1) {
                document.getElementById("nextButton").style.display = "none";
                document.getElementById("submitButton").style.display =
                    "inline";
            }
        }
    }

    function showPreviousQuestion() {
        if (currentQuestion > 0) {
            currentQuestion--;
            showQuestion(currentQuestion);
            document.getElementById("nextButton").style.display = "inline";
            if (currentQuestion === 0) {
                document.getElementById("prevButton").style.display = "none";
            }
            document.getElementById("submitButton").style.display = "none";
        }
    }

    async function handleSubmit(event) {
        // Hentikan timer saat form disubmit
        clearInterval(timerInterval);
    
        // Hanya gunakan preventDefault jika mengirimkan dengan AJAX
        event.preventDefault();
    
        const form = event.target;
        const formData = new FormData(form);
    
        try {
            const response = await fetch(form.action, {
                method: "POST",
                body: formData,
                headers: {
                    "X-Requested-With": "XMLHttpRequest",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
                },
            });

            const data = await response.json();
            console.log("Response from server:", data); // Log response JSON
            document.getElementById("resultText").innerText = `Skor Anda: ${data.score} dari ${totalQuestions}`;
            document.getElementById("result").style.display = "block";
            document.getElementById("psikotesForm").style.display = "none";
        } catch (error) {
            console.error("Error:", error);
            alert("Terjadi kesalahan saat mengirim data.");
        }
    }

    function restartTest() {
        currentQuestion = 0;
        timeLeft = 300; // Reset time to 5 minutes
        showQuestion(currentQuestion);
        document.getElementById("result").style.display = "none";
        document.getElementById("psikotesForm").style.display = "block";
        document.getElementById("submitButton").style.display = "none";
        clearInterval(timerInterval);
        updateTimer();
        timerInterval = setInterval(updateTimer, 1000); // Restart the timer
    }

    showQuestion(currentQuestion);

    // Event listeners for buttons
    document.getElementById("nextButton").addEventListener("click", showNextQuestion);
    document.getElementById("prevButton").addEventListener("click", showPreviousQuestion);
    document.getElementById("psikotesForm").addEventListener("submit", handleSubmit);
    document.getElementById("restartButton").addEventListener("click", restartTest);
});
