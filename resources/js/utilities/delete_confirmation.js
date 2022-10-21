const deleteForm = document.querySelectorAll('.delete-form');

deleteForm.forEach(form => {
    form.addEventListener('submit', event => {
        event.preventDefault();

        const hasConfirmed = confirm("Vuoi davvero eliminare questo elemento?");
        if(hasConfirmed) form.submit();
    })
})
