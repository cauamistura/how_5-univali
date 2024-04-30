<template>
  <div class="card">
      <div class="card-image">
          <figure class="image is-4by3">
              <img src="https://bulma.io/assets/images/placeholders/1280x960.png" alt="Placeholder image" />
          </figure>
      </div>
      <div class="card-content">
          <div class="media">
              <div class="media-left">
                  <figure class="image is-48x48">
                      <img src="../assets/foto_vini.jpeg" alt="Placeholder image" />
                  </figure>
              </div>
              <div class="media-content">
                  <p class="title is-4">Vinicius Soares</p>
                  <p class="subtitle is-6">GitHub: <a href="https://github.com/SoaresVini">@SoaresVini</a></p>
              </div>
          </div>

          <div class="content">
              <p>Estudante do segundo semestre de ADS - Univali Campus Itajai </p>
              <p>Sou formado no curso técnico integrado em Informática no IFSC campus Gaspar.</p>
              <p>Atualmente, estou focado no estudo de Ruby on Rails, pois estou atuando como desenvolvedor Back-end. Anteriormente, tive experiência como desenvolvedor Front-end com Angular na empresa onde atuo atualmente.</p>
              <p>Durante meu curso técnico, tive a oportunidade de estudar com algumas linguagens como Java, PHP, JavaScript, C e C++, mas meu maior interesse sempre foi o desenvolvimento web.</p>
              <time datetime="28-04-2024">20:40 PM - 28 abril 2024</time>
          </div>
      </div>
  </div>

  <div class="card">
      <div class="card-image">
          <figure class="image is-4by3">
              <img src="https://bulma.io/assets/images/placeholders/1280x960.png" alt="Placeholder image" />
          </figure>
      </div>
      <div class="card-content">
          <div class="media">
              <div class="media-left">
                  <figure class="image is-48x48">
                      <img src="" alt="Placeholder image" />
                  </figure>
              </div>
              <div class="media-content">
                  <p class="title is-4">Cauã Mistura</p>
                  <p class="subtitle is-6">GitHub: <a href="#">@</a></p>
              </div>
          </div>

          <div class="content">
              <p>Estudante do segundo semestre de ADS - Univali Campus Itajai </p>
              <p>Escreva sobre vc ..............</p>
              <time datetime="28-04-2024">20:40 PM - 28 abril 2024</time>
          </div>
      </div>
  </div>
</template>


<script>
export default {

}
</script>

<style>
/* MODAL */

.modal::before {
    content: "";
    position: fixed;
    top: 0px;
    left: 0px;
    width: 100%;
    height: 100vh;
    background: rgba(0, 0, 0, .5);
}

.modal {
    display: flex;
    flex-direction: column;
    align-items: center;
    position: absolute;
    top: 0px;
    left: 0px;
    width: 100%;
    padding: 80px;
}

.modal_container {
    position: relative;
    background: linear-gradient(to right, transparent 250px, white 250px);
    z-index: 1;
    display: grid;
    align-items: end;
    grid-gap: 50px;
    padding: 50px 50px 50px 0;
    animation: fadeIn .3s forwards;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translate3d(50px, 0, 0);
    }

    to {
        opacity: 1;
        transform: translate3d(0px, 0, 0);
    }
}

.modal_fechar {
    border-radius: 50%;
    border: 2px solid #000;
    width: 40px;
    height: 40px;
    position: absolute;
    top: -10px;
    right: -10px;
    font-size: 1rem;
    box-shadow: 0px 3px 4px rgba(0, 0, 0, .1), 0px 4px 10px rgba(0, 0, 0, .2);
    cursor: pointer;
}

.modal_img {
    grid-column: 1;
    box-shadow: 0px 3px 4px rgba(0, 0, 0, .1), 0px 4px 10px rgba(0, 0, 0, .2);
}

.modal_img img {
    max-width: 300px;
    display: block;
}

.modal_dados {
    grid-column: 2;
    max-width: 600px;
}

.modal_titulo {
    font-size: 3rem;
}

.modal_btn {
    margin-top: 80px;
    background: #000;
    cursor: pointer;
    color: #ffffff;
    border: none;
    font-size: 1rem;
    padding: 10px 25px;
    font-family: "Noto Serif";
}

.modal_btn.esgotado {
    background: #808080;
}

.modal_btn:active {
    background: #808080;
}

    .card-content {
        border-radius: 2px 2px black;
        background-color: rgb(255, 255, 255);
    }

    a {
        color: black;
        
    }

    p,time {
        color: black;
    }

/* MODAL */

.modal::before {
    content: "";
    position: fixed;
    top: 0px;
    left: 0px;
    width: 100%;
    height: 100vh;
    background: rgba(0, 0, 0, .5);
}

.modal {
    display: flex;
    flex-direction: column;
    align-items: center;
    position: absolute;
    top: 0px;
    left: 0px;
    width: 100%;
    padding: 80px;
}

.modal_container {
    position: relative;
    background: linear-gradient(to right, transparent 250px, white 250px);
    z-index: 1;
    display: grid;
    align-items: end;
    grid-gap: 50px;
    padding: 50px 50px 50px 0;
    animation: fadeIn .3s forwards;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translate3d(50px, 0, 0);
    }

    to {
        opacity: 1;
        transform: translate3d(0px, 0, 0);
    }
}

.modal_fechar {
    border-radius: 50%;
    border: 2px solid #000;
    width: 40px;
    height: 40px;
    position: absolute;
    top: -10px;
    right: -10px;
    font-size: 1rem;
    box-shadow: 0px 3px 4px rgba(0, 0, 0, .1), 0px 4px 10px rgba(0, 0, 0, .2);
    cursor: pointer;
}

.modal_img {
    grid-column: 1;
    box-shadow: 0px 3px 4px rgba(0, 0, 0, .1), 0px 4px 10px rgba(0, 0, 0, .2);
}

.modal_img img {
    max-width: 300px;
    display: block;
}

.modal_dados {
    grid-column: 2;
    max-width: 600px;
}

.modal_titulo {
    font-size: 3rem;
}

.modal_btn {
    margin-top: 80px;
    background: #000;
    cursor: pointer;
    color: #ffffff;
    border: none;
    font-size: 1rem;
    padding: 10px 25px;
    font-family: "Noto Serif";
}

.modal_btn.esgotado {
    background: #808080;
}

.modal_btn:active {
    background: #808080;
}
</style>