<template>
    <div class="card" id="card">
        <div class="card-image">
            <figure class="image is-4by3">
                <img src="https://bulma.io/assets/images/placeholders/1280x960.png" alt="Placeholder image" />
            </figure>
        </div>
        <div class="card-content" id="card-content">
            <div class="media">
                <div class="media-content">
                    <p class="title is-4">Nosso projeto</p>
                </div>
            </div>

            <div class="content">
                <p>O projeto consiste em desenvolver uma plataforma digital para uma vendinha solitária, voltada para
                    vendedores autônomos que desejam comercializar seus produtos de forma simples e eficiente. O
                    público-alvo são vendedores individuais que possuem produtos diversos para oferecer aos consumidores
                    locais. A plataforma visa proporcionar uma experiência de compra conveniente e acessível aos
                    clientes, permitindo-lhes selecionar os produtos desejados, realizar a compra e retirar os itens no
                    local da vendinha.</p>
            </div>
        </div>
    </div>
    <div class="card" id="card">
        <div class="card-image">
            <figure class="image is-4by3">
                <img src="https://bulma.io/assets/images/placeholders/1280x960.png" alt="Placeholder image" />
            </figure>
        </div>
        <div class="card-content" id="card-content">
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
                <p>Atualmente, estou focado no estudo de Ruby on Rails, pois estou atuando como desenvolvedor Back-end.
                    Anteriormente, tive experiência como desenvolvedor Front-end com Angular na empresa onde atuo
                    atualmente.</p>
                <p>Durante meu curso técnico, tive a oportunidade de estudar com algumas linguagens como Java, PHP,
                    JavaScript, C e C++, mas meu maior interesse sempre foi o desenvolvimento web.</p>
                <time datetime="28-04-2024">20:40 PM - 28 abril 2024</time>
            </div>
        </div>
    </div>
        
    <div class="card" id="card">
        <div class="card-image" id="card-content">
            <figure class="image is-4by3">
                <img src="https://bulma.io/assets/images/placeholders/1280x960.png" alt="Placeholder image" />
            </figure>
        </div>
        <div class="card-content" id="card-content">
            <div class="media">
                <div class="media-left">
                    <figure class="image is-48x48">
                        <img src="../assets/foto_caua.jpg" alt="Placeholder image" />
                    </figure>
                </div>
                <div class="media-content">
                    <p class="title is-4">Cauã Mistura</p>
                    <p class="subtitle is-6">GitHub: <a href="https://github.com/cauamistura">@Cauã Mistura</a></p>
                </div>
            </div>

            <div class="content">
                <p>Sou formado em Informática pelo IFSC e curso superior em analise e desenvolvimento de sistemas pela
                    UNIVALI em quanto trabalho com programação desktop/web, especialmente utilizando c# e .Net,
                    juntamente com Delphi. Em paralelo a isso estou me especializando no desenvolvimento fullstack
                    aprimorando meus conhecimentos em diversas áreas do desenvolvimento</p>

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
#card {
    background-color: white;
    margin: 20px;
}

#card-content {
    background-color: rgb(111, 155, 226);
}
</style>