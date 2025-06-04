document.querySelectorAll('.edit-button').forEach(button => {
    button.addEventListener('click', async function () {
        let playlistId = this.dataset.id,
            input = document.getElementById(`edit-input-${playlistId}`),
            display = document.getElementById(`name-display-${playlistId}`)

        if (!input || !display) {
            fetch('/beatTron/public/playlistError', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                })
                .then(response => {
                    if (response.redirected) {
                        window.location.href = response.url
                    }
                })

            return
        }

        if (this.innerText === 'Edit') {
            this.innerText = 'Save'
            display.style.display = 'none'
            input.style.display = 'inline-block'
            input.focus()
        } else {
            let newName = input.value.trim()

            try {
                let response = await fetch(`/beatTron/public/playlists/${playlistId}/update-name`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        name: newName
                    })
                })

                if (!response.ok) {
                    await fetch('/beatTron/public/playlistError', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        }
                    })
                    return
                }

                display.querySelector('a').innerText = newName
                input.style.display = 'none'
                display.style.display = 'block'
                this.innerText = 'Edit'

            } catch (error) {
                console.error(error)
                await fetch('/beatTron/public/playlistError', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                })
            }
        }
    })
})