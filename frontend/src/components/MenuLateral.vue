<template>
    <input type="checkbox" id="check">
    <label for="check">
        <i class="fas fa-bars" id="btn" @click="AbrirMenu"></i>
    </label>
    <div class="sidebar">
        <header>
            <i class="fa fa-shopping-cart"></i>
            Feirinha
        </header>
        <a href="#" class="active">
            <i class="fas fa-home"></i>
            <span>Início</span>
        </a>
        <a href="#">
            <i class="fa fa-user"></i>
            <span>Minha conta</span>
        </a>
        <a href="#">
            <i class="fas fa-stream"></i>
            <span>Balanço</span>
        </a>
        <a href="#">
            <i class="fa fa-th"></i>
            <span>Meus produtos</span>
        </a>
        <a href="#">
            <i class="far fa-question-circle"></i>
            <span>Sobre</span>
        </a>
    </div>
</template>

<script>
export default {
    data() {
        return {
            SideBarVisible: false,
        }
    },
    methods: {
        AbrirMenu() {
            this.SideBarVisible = !this.SideBarVisible;
        },
        checkScreenSize() {
            this.SideBarVisible = window.innerWidth >= 768; 
        }
    },
    created() {
        window.addEventListener('resize', this.checkScreenSize);
        this.checkScreenSize();
    },
    beforeUnmount() {
        window.removeEventListener('resize', this.checkScreenSize);
    },
}
</script>

<style>
* {
    margin: 0;
    padding: 0;
    text-decoration: none;
}

.sidebar {
    position: fixed;
    width: 240px;
    left: -240px;
    height: 100%;
    background: #F6F8F9;
    transition: all .5s ease;
    display: flex;
    flex-direction: column;
    align-items: center;
    left: 0;
    visibility: v-bind("SideBarVisible ? 'visible' : 'hidden'");
}


.sidebar header {
    font-size: 18px;
    color: #252C32;
    line-height: 50px;
    background: #F6F8F9;
}

.sidebar header>i {
    height: auto;
    color: #84919A;
    font-size: 17px;
    margin-right: 2px;
}

.sidebar a {
    height: 36px;
    width: 90%;
    color: black;
    transition: all .5s ease;
    border-radius: 5px;
    font-size: 14px;
    display: flex;
    justify-content: left;
    align-items: center;
    margin-top: -4px;
    visibility: v-bind("SideBarVisible ? 'visible' : 'hidden'");
}

.sidebar a>i {
    margin-left: 6%;
    height: auto;
    color: #84919A;
    font-size: 15px;
    margin-right: 16px;
}

a:hover {
    background-color: #D7EDFF;
    color: #252C32;
    box-shadow: 0px 3px 5px rgba(0, 0, 0, 0.2);
}

.sidebar a span {
    font-size: 14px;
    font-weight: 500;
}

#check {
    display: none;
}

label #btn {
    position: absolute;
    cursor: pointer;
    color: black;
    border-radius: 5px;
    margin: v-bind("SideBarVisible ? '15px 250px' : '15px 20px'");
    ;
    font-size: 15px;
    background: #F6F8F9;
    height: 25px;
    width: 30px;
    text-align: center;
    line-height: 25px;
    transition: all .5s ease;
}
</style>