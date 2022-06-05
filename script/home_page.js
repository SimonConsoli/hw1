

function sezionepost(event){
const sezioneform=document.querySelector(".withpost");

   
    sezioneform.classList.remove("hidden");
  

}






function scriviPost(event){
    
    const titolo=document.querySelector("#titolo");
    const opinion=document.querySelector("#opinion");
    if(titolo.value==0 || opinion.value==0){
        event.preventDefault();
        const errore=document.createElement("span");
        errore.classList.add("errore");
        errore.textContent="è necessario compilare tutti i campi predisposti"
        mypost.appendChild(errore);
        titolo.classList.add("errorinput");
        opinion.classList.add("errorinput");
    }
    else if(titolo.value.length>80 || opinion.value.length>4000){
        event.preventDefault();
        const errore=document.createElement("span");
        errore.classList.add("errore");
        errore.textContent="I testi sono troppo lunghi";
        mypost.appendChild(errore);
        titolo.classList.add("errorinput");
        opinion.classList.add("errorinput");
    }
    }


function onJsonresearch(json){
    const canzone=document.querySelector("#canzone");
    canzone.innerHTML='';
     const risults = json.tracks.items;
    let num_risult = risults.length;
    if (num_risult > 3)
        num_risult = 3;
    for (let i = 0; i < num_risult; i++) {
        const dati = risults[i]
        const titolo = dati.name;
        const url = dati.uri;
        var site = document.createElement('a');
        site.setAttribute('href', url);
        site.textContent = 'Ascolta su Spotify';
        const selected_image = dati.album.images[1].url;
        const album = document.createElement('div');
        album.classList.add("album");
        const img = document.createElement('img');
        img.src = selected_image;
        const caption = document.createElement('span');
        caption.textContent = "Titolo:" + titolo;
        const artista = dati.artists[0].name;
        const nome_artista = document.createElement('span');
        nome_artista.textContent = "Artista:" + artista;
        album.appendChild(img);
        album.appendChild(caption);
        album.appendChild(nome_artista);
        album.appendChild(site);
        canzone.appendChild(album);
}
}

function onResponse(response) {
    return response.json();
}
function onError(error) {
    console.log('Error' + error);
}

function ricerca_contenuto(event){
    event.preventDefault();
    const song=document.querySelector('#takeasong');
    const ricercato=encodeURIComponent(song.value);
    console.log("Eseguo la ricerca del brano:" + ricercato);
    fetch("ricerca_contenuto.php?" + "&q=" + ricercato).then(onResponse,onError).then(onJsonresearch)
}


function Oncontroljson(json){
    let nFetchedPosts = json.length;
    for(let i=0; i<nFetchedPosts; i++){       
        const elemento = document.createElement('section');
        elemento.classList.add('oggetto');
        const z = document.createElement('div');
        z.classList.add("x");
        z.classList.add("hidden");
        const contenuto = document.createElement('div');
        contenuto.classList.add('contenuto');
        const titolo = document.createElement('div');
        titolo.classList.add('titolo');
        const nickname = document.createElement('span');
        nickname.classList.add('nick');
        const orario = document.createElement('span');
        orario.classList.add('orario');
        const titoletto = document.createElement('p');
        titoletto.classList.add("titoletto");
        const eliminazione = document.createElement('div');
        eliminazione.classList.add('deletecontent');
        const elimina = document.createElement('button');
        elimina.classList.add('elimina');
        elimina.textContent = "Cancella post";
        
        

        z.textContent = json[i].IDpost;
        titolo.textContent = json[i].titolo;
        nickname.textContent = "Owner-> " + json[i].username;
        titoletto.textContent = json[i].opinion;
        orario.textContent = "Pubblicato alle ore: " + json[i].time;
        elimina.dataset.IDpost = json[i].IDpost;
        elemento.appendChild(z);
        elemento.appendChild(contenuto);
        contenuto.appendChild(titolo);
        contenuto.appendChild(nickname);
        contenuto.appendChild(orario);
        contenuto.appendChild(titoletto);
        contenuto.appendChild(eliminazione);
    }
    if(nFetchedPosts ==0){
        const listavuota = document.createElement('div');
        listavuota.textContent = "Nessun post trovato!"
        
    }
}

function guardaPost(event){

    const withpost = document.querySelector(".withpost");
    withpost.classList.add("hidden");
    nPosts = 10;
    fetch("ricerca.php?q=" + nPosts).then(onResponse).then(Oncontroljson);
    event.currentTarget.textContent = "Aggiorna i post";
}



var button = document.getElementById("showpost");
button.addEventListener("click",guardaPost);
const query1=document.forms["spotify"];
query1.addEventListener("submit", ricerca_contenuto)

const form_dati = document.forms['form_post'];
document.querySelector("button[data-button='writeit']").addEventListener("click",sezionepost)
document.querySelector(".withpost").addEventListener('submit',scriviPost)
