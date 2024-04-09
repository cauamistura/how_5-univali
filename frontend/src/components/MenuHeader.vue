<template>
    <header>
        <nav>
            <div class="sidebar-container">
                <label for="check">
                    <i class="fas fa-bars" id="btn" @click="AbrirMenu"></i>
                </label>
                <div class="sidebar" v-if="SideBarVisible">
                    <div class="logo">
                        <i class="fa fa-shopping-cart"></i>
                        Feirinha
                    </div>
                    <a href="/Home" class="active" style="margin-top: 20px">
                        <i class="fas fa-home"></i>
                        <span>Início</span>
                    </a>
                    <a href="/MinhaConta">
                        <i class="fa fa-user"></i>
                        <span>Minha conta</span>
                    </a>
                    <a href="/Balanco">
                        <i class="fas fa-stream"></i>
                        <span>Balanço</span>
                    </a>
                    <a href="/Produtos">
                        <i class="fa fa-th"></i>
                        <span>Meus produtos</span>
                    </a>
                    <a href="/Sobre">
                        <i class="far fa-question-circle"></i>
                        <span>Sobre</span>
                    </a>
                    <a href="/Login">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Sair</span>
                    </a>
                </div>
            </div>
            <div class="person">
                <a href="/MinhaConta">
                    <span>{{ user.name }}</span>
                    <i class="fa fa-user"></i>
                </a>
            </div>
        </nav>
    </header>
</template>

<script>
export default {
    data() {
        return {
            user: {
                name: 'Fulano de tal',
            },
            SideBarVisible: false,
        }
    },
    methods: {
        AbrirMenu() {
            this.SideBarVisible = !this.SideBarVisible;
        },
        checkScreenSize() {
            this.SideBarVisible = window.innerWidth >= 768 && this.SideBarVisible;
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
header {
    width: 100%;
    height: 60px;
    padding-top: 15px;
    background: #F6F8F9;
}

nav {
    display: flex;
    justify-content: space-between;
}

.sidebar {
    position: fixed;
    width: 240px;
    height: 100%;
    background: #F6F8F9;
    display: flex;
    flex-direction: column;
    align-items: center;
}

.logo {
    font-size: 18px;
    color: #252C32;
    background: #F6F8F9;
    cursor: pointer;
}

.logo>i {
    height: auto;
    color: #84919A;
    font-size: 17px;
    margin-right: 2px;
}

.sidebar a,
.person a {
    height: 36px;
    width: 90%;
    color: black;
    border-radius: 5px;
    font-size: 14px;
    display: flex;
    justify-content: left;
    align-items: center;
    margin-top: -4px;
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

#check {
    display: none;
}

label #btn {
    position: absolute;
    cursor: pointer;
    color: black;
    border-radius: 5px;
    margin: v-bind("SideBarVisible ? '15px 250px' : '15px 20px'");
    font-size: 20px;
    background: #F6F8F9;
    width: 30px;
    text-align: center;
    top: 6px;
    color: #84919A;
}

.person a {
    margin-right: 20px;
    width: 150px;
    justify-content: center;
}

.person a>i {
    margin-left: 10px;
    font-size: 20px;
}

@media(max-width : 768px) {
    .sidebar {
        width: 170px;
    }

    label #btn {
        margin: v-bind("SideBarVisible ? '15px 170px' : '15px 20px'");
    }

    .person a {
        margin-right: 2px;
    }
}
</style>