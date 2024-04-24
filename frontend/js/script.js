console.log('OK, montres-nous Jamy !');

fetchPosts = async function () {
    try {
        // Récupérer les data
        const response = await fetch("localhost:8080/api/tasks");
        if(response.ok) {
            const dataPosts = await response.json();
            console.log(dataPosts);
            // Traiter les data
            for(const dataPost of dataPosts) {
                createCard(dataPost.title, dataPost.body)
            }
        }
    } catch(error) {
        console.log(error);
    }
}

function createCard(pTitle, pContent) {
    // je clone le contenu du template pour créer directement une card
    const templateCardElement = document.getElementById('tasklist');
    const cloneCard = document.importNode(templateCardElement.content, true);
    console.log(cloneCard);

   const li =  document.createElement('li')

}