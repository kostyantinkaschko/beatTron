document.addEventListener('DOMContentLoaded', () => {
    let searchInput = document.getElementById('searchInput')

    searchInput.addEventListener('input', () => {
        let searchTerm = searchInput.value.toLowerCase()

        document.querySelectorAll('.song').forEach(row => {
            let nameEl = row.querySelector('.text-blue-200'),
                performerEl = row.querySelector('.performer_name'),
                audio = row.querySelector('audio'),
                name = nameEl ? nameEl.textContent.toLowerCase() : '',
                performer = performerEl ? performerEl.textContent.toLowerCase() : '',
                matchesSearch = name.includes(searchTerm) || performer.includes(searchTerm),
                isPlaying = audio && !audio.paused

            if (matchesSearch) {
                row.classList.remove('currentSongWithSearch')
                row.style.display = ''
            } else if (isPlaying) {
                row.classList.add('currentSongWithSearch')
                row.style.display = ''
            } else {
                row.classList.remove('currentSongWithSearch')
                row.style.display = 'none'
            }
        })
    })
})
