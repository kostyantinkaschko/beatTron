let currentSong = null,
    progressTracked = {}

function audio(id) {
    let audioPlayer = document.querySelector("#player" + id),
        audioPlayers = document.querySelectorAll(".audio-player")

    if (id !== currentSong) {
        audioPlayers.forEach(player => {
            player.classList.add("none")
            player.pause()
            player.currentTime = 0
        })
        currentSong = id
        progressTracked[id] = false
    } else {
        if (audioPlayer.paused) {
            return audioPlayer.play()
        } else {
            return audioPlayer.pause()
        }
    }

    audioPlayer.classList.remove("none")
    audioPlayer.play()

    if (!audioPlayer._trackingAttached) {
        audioPlayer.addEventListener("timeupdate", function () {
            let percentage = (audioPlayer.currentTime / audioPlayer.duration) * 100

            if (percentage >= 70 && !progressTracked[id]) {
                progressTracked[id] = true

                fetch(`songs/${id}/listen`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                })
            }
        })

        audioPlayer.addEventListener("ended", function () {
            let allPlayers = Array.from(document.querySelectorAll(".audio-player")),
                currentIndex = allPlayers.findIndex(p => p.id === "player" + id),
                nextPlayer = allPlayers[currentIndex + 1]

            if (nextPlayer) {
                let nextId = nextPlayer.id.replace("player", "")
                audio(nextId)
            }
        })

        audioPlayer._trackingAttached = true
    }

    return audioPlayer
}
