let currentSong = null

function audio(id) {
    let audioPlayer = document.querySelector("#player" + id),
        audioPlayers = document.querySelectorAll(".audio-player")

    console.log(audioPlayers)
    if (id !== currentSong) {
        audioPlayers.forEach(player => {
            player.classList.add("none")
            player.pause()
            player.currentTime = 0;
        })
        currentSong = id;
    } else {
        if (audioPlayer.paused) {
            return audioPlayer.play()
        } else {
            return audioPlayer.pause()
        }
    }

    audioPlayer.classList.remove("none")
    return audioPlayer.play()
}


