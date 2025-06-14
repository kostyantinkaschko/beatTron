let currentAudio = null,
    currentButton = null,
    currentSongId = null,
    progressTracked = {}

function audio(id) {
    let audioPlayer = document.querySelector(`#player${id}`),
        buttonElement = document.querySelector(`.play-button[data-id="${id}"]`),
        audioContainer = buttonElement.closest("tr").querySelector(".audio-player"),
        songRow = buttonElement.closest("tr"),
        url = songRow?.dataset.listenUrl

    if (!audioPlayer || !buttonElement || !audioContainer || !url) return

    document.querySelectorAll(".audio-player").forEach(container => container.classList.add("none"))
    document.querySelectorAll(".play-button").forEach(btn => btn.classList.remove("playing"))

    if (currentAudio && currentAudio !== audioPlayer) {
        currentAudio.pause()
        currentAudio.currentTime = 0
    }

    if (audioPlayer.paused || currentSongId !== id) {
        audioContainer.classList.remove("none")
        audioPlayer.play()
        buttonElement.classList.add("playing")
        currentSongId = id
    } else {
        audioPlayer.pause()
        audioContainer.classList.add("none")
        buttonElement.classList.remove("playing")
        return
    }

    audioPlayer.addEventListener("pause", () => {
        buttonElement.classList.remove("playing")
    })

    currentAudio = audioPlayer
    currentButton = buttonElement
    console.log("Перевірка _trackingAttached для ID:", id, audioPlayer._trackingAttached)

    if (!audioPlayer._trackingAttached) {
        audioPlayer.addEventListener("timeupdate", () => {
            const percent = (audioPlayer.currentTime / audioPlayer.duration) * 100
            if (percent >= 70 && !progressTracked[id]) {
                progressTracked[id] = true

                fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                }).then(response => {
                    console.log("Відповідь сервера:", response)
                    return response.json()
                }).then(data => {
                    console.log("Дані з сервера:", data)
                }).catch(error => {
                    console.error("Помилка при fetch:", error)
                })
            }
        })

        audioPlayer.addEventListener("ended", () => {
            buttonElement.classList.remove("playing")
            audioContainer.classList.add("none")

            let allPlayers = Array.from(document.querySelectorAll("audio")),
                currentIndex = allPlayers.findIndex(p => p.id === `player${id}`),
                nextPlayer = allPlayers[currentIndex + 1]

            if (nextPlayer) {
                let nextId = nextPlayer.id.replace("player", "")
                audio(nextId)
            }
        })

        audioPlayer._trackingAttached = true
    }
}
